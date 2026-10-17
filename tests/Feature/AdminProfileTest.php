<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_admin_login_and_is_redirected_from_dashboard(): void
    {
        $this->get(route('login'))->assertOk();
        $this->get(route('admin.profile.edit'))
            ->assertRedirect(route('login'));
    }

    public function test_regular_user_cannot_sign_in_to_the_admin_area(): void
    {
        $user = User::factory()->create();

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_sign_in_and_upload_the_homepage_hero_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.profile.edit'));

        $this->assertAuthenticatedAs($admin);
        $this->get(route('admin.profile.edit'))->assertOk();

        $this->put(route('admin.profile.hero-image.update'), [
            'hero_image' => UploadedFile::fake()->image('portrait.jpg'),
        ])->assertSessionHas('status');

        $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');
        $this->assertNotNull($imagePath);
        Storage::disk('public')->assertExists($imagePath);
        $this->get('/')->assertOk()->assertSee(Storage::disk('public')->url($imagePath));
    }

    public function test_admin_image_upload_rejects_non_image_files(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->put(route('admin.profile.hero-image.update'), [
                'hero_image' => UploadedFile::fake()->create('not-an-image.txt', 10, 'text/plain'),
            ])
            ->assertSessionHasErrors('hero_image');
    }

    public function test_admin_can_add_edit_and_delete_service_cards(): void
    {
        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->post(route('admin.services.store'), [
                'title' => 'Brand strategy',
                'description' => 'Build a memorable brand.',
                'icon' => 'palette',
                'cta_label' => 'Get in touch',
                'cta_url' => '#contact',
            ])
            ->assertRedirect()
            ->assertSessionHas('status');

        $service = Service::query()->where('title', 'Brand strategy')->firstOrFail();
        $this->assertSame('palette', $service->icon);
        $this->get('/')->assertOk()->assertSee('Brand strategy')->assertSee('Build a memorable brand.');

        $this->put(route('admin.services.update', $service), [
            'title' => 'Updated strategy',
            'description' => 'Updated description.',
            'icon' => 'megaphone',
            'cta_label' => 'Contact me',
            'cta_url' => 'https://example.com/contact',
        ])->assertRedirect()->assertSessionHas('status');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Updated strategy',
            'icon' => 'megaphone',
        ]);

        $this->delete(route('admin.services.destroy', $service))
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    public function test_service_cards_are_admin_only_and_icon_must_be_from_the_allowed_set(): void
    {
        $payload = [
            'title' => 'Brand strategy',
            'description' => 'Build a memorable brand.',
            'icon' => 'arbitrary-html',
            'cta_label' => 'Get in touch',
            'cta_url' => '#contact',
        ];

        $this->post(route('admin.services.store'), $payload)
            ->assertRedirect(route('login'));
        $this->assertDatabaseCount('services', 3);

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->post(route('admin.services.store'), $payload)
            ->assertSessionHasErrors('icon');

        $this->assertDatabaseCount('services', 3);
    }
}
