<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
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

        $this->delete(route('admin.profile.hero-image.destroy'))
            ->assertRedirect()
            ->assertSessionHas('status', 'Hero image removed successfully.');

        $this->assertDatabaseMissing('site_settings', ['key' => 'hero_image']);
        Storage::disk('public')->assertMissing($imagePath);
        $this->get('/')->assertOk()->assertSee('Your photo goes here');
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

    public function test_admin_can_upload_and_replace_the_projects_section_background(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->put(route('admin.profile.projects-background.update'), [
                'projects_background' => UploadedFile::fake()->image('projects-background.jpg'),
            ])
            ->assertRedirect()
            ->assertSessionHas('status');

        $firstImagePath = DB::table('site_settings')->where('key', 'projects_background')->value('value');
        $this->assertNotNull($firstImagePath);
        Storage::disk('public')->assertExists($firstImagePath);
        $this->get('/')->assertOk()->assertSee(Storage::disk('public')->url($firstImagePath));

        $this->put(route('admin.profile.projects-background.update'), [
            'projects_background' => UploadedFile::fake()->image('new-background.jpg'),
        ])->assertSessionHas('status');

        $secondImagePath = DB::table('site_settings')->where('key', 'projects_background')->value('value');
        $this->assertNotSame($firstImagePath, $secondImagePath);
        Storage::disk('public')->assertMissing($firstImagePath);
        Storage::disk('public')->assertExists($secondImagePath);
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

    public function test_admin_can_add_edit_and_delete_project_cards_and_their_images(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->post(route('admin.projects.store'), [
            'title' => 'Portfolio site',
            'category' => 'Web design',
            'url' => 'https://example.com/project',
            'image' => UploadedFile::fake()->image('portfolio.jpg'),
        ])->assertRedirect(route('login'));

        $this->actingAs($admin)
            ->post(route('admin.projects.store'), [
                'title' => 'Portfolio site',
                'category' => 'Web design',
                'url' => 'https://example.com/project',
                'image' => UploadedFile::fake()->image('portfolio.jpg'),
            ])
            ->assertRedirect()
            ->assertSessionHas('status');

        $project = Project::query()->where('title', 'Portfolio site')->firstOrFail();
        $originalImagePath = $project->image_path;
        Storage::disk('public')->assertExists($originalImagePath);
        $this->get('/')->assertOk()->assertSee('Portfolio site')->assertSee('Web design');

        $this->put(route('admin.projects.update', $project), [
            'title' => 'Updated portfolio',
            'category' => 'Product design',
            'url' => null,
            'image' => UploadedFile::fake()->image('updated-portfolio.png'),
        ])->assertRedirect()->assertSessionHas('status');

        $project->refresh();
        $this->assertSame('Updated portfolio', $project->title);
        $this->assertSame('Product design', $project->category);
        Storage::disk('public')->assertMissing($originalImagePath);
        Storage::disk('public')->assertExists($project->image_path);

        $updatedImagePath = $project->image_path;
        $this->delete(route('admin.projects.destroy', $project))
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        Storage::disk('public')->assertMissing($updatedImagePath);
    }

    public function test_admin_can_add_edit_and_delete_portfolio_cards_and_their_images(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->post(route('admin.portfolios.store'), [
            'title' => 'Brand refresh',
            'category' => 'Brand identity',
            'description' => 'A complete identity refresh for a growing brand.',
            'tools' => 'Figma, Illustrator',
            'url' => 'https://example.com/brand',
            'image' => UploadedFile::fake()->image('brand.jpg'),
        ])->assertRedirect(route('login'));

        $this->actingAs($admin)
            ->get(route('admin.profile.edit'))
            ->assertOk()
            ->assertSee('Portfolio cards')
            ->assertSee('Tools (comma-separated)');

        $this->post(route('admin.portfolios.store'), [
            'title' => 'Brand refresh',
            'category' => 'Brand identity',
            'description' => 'A complete identity refresh for a growing brand.',
            'tools' => 'Figma, Illustrator',
            'url' => 'https://example.com/brand',
            'image' => UploadedFile::fake()->image('brand.jpg'),
        ])->assertRedirect()->assertSessionHas('status');

        $portfolio = Portfolio::query()->where('title', 'Brand refresh')->firstOrFail();
        $originalImagePath = $portfolio->image_path;
        Storage::disk('public')->assertExists($originalImagePath);

        $this->get('/')
            ->assertOk()
            ->assertSee('Brand refresh')
            ->assertSee('Brand identity')
            ->assertSee('A complete identity refresh for a growing brand.')
            ->assertSee('Figma')
            ->assertSee('Illustrator')
            ->assertSee(Storage::disk('public')->url($originalImagePath));

        $this->put(route('admin.portfolios.update', $portfolio), [
            'title' => 'Updated identity',
            'category' => 'Digital design',
            'description' => 'Updated portfolio description.',
            'tools' => 'Figma, Tailwind CSS',
            'url' => null,
            'image' => UploadedFile::fake()->image('updated-brand.png'),
        ])->assertRedirect()->assertSessionHas('status');

        $portfolio->refresh();
        $this->assertSame('Updated identity', $portfolio->title);
        $this->assertSame('Digital design', $portfolio->category);
        $this->assertSame('Figma, Tailwind CSS', $portfolio->tools);
        $this->assertNull($portfolio->url);
        Storage::disk('public')->assertMissing($originalImagePath);
        Storage::disk('public')->assertExists($portfolio->image_path);

        $updatedImagePath = $portfolio->image_path;
        $this->delete(route('admin.portfolios.destroy', $portfolio))
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
        Storage::disk('public')->assertMissing($updatedImagePath);
    }

    public function test_portfolio_cards_reject_invalid_images_and_require_admin_access(): void
    {
        Storage::fake('public');

        $payload = [
            'title' => 'Brand refresh',
            'category' => 'Brand identity',
            'description' => 'A complete identity refresh for a growing brand.',
            'tools' => 'Figma, Illustrator',
            'image' => UploadedFile::fake()->create('not-an-image.txt', 10, 'text/plain'),
        ];

        $this->post(route('admin.portfolios.store'), $payload)
            ->assertRedirect(route('login'));

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->post(route('admin.portfolios.store'), $payload)
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('portfolios', 0);
    }
}
