<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function edit(): View
    {
        $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

        return view('admin.profile', [
            'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
            'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
            'serviceIcons' => Service::ICON_OPTIONS,
        ]);
    }

    public function updateHeroImage(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $imagePath = $request->file('hero_image')->store('hero', 'public');

        if (! $imagePath) {
            return back()->withErrors(['hero_image' => 'The image could not be saved. Please try again.']);
        }

        $previousPath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

        DB::table('site_settings')->updateOrInsert(
            ['key' => 'hero_image'],
            ['value' => $imagePath, 'updated_at' => now(), 'created_at' => now()],
        );

        if ($previousPath && $previousPath !== $imagePath) {
            Storage::disk('public')->delete($previousPath);
        }

        return back()->with('status', 'Hero image updated successfully.');
    }

    public function storeService(Request $request): RedirectResponse
    {
        Service::create($this->validatedService($request) + [
            'sort_order' => (int) Service::max('sort_order') + 1,
        ]);

        return back()->with('status', 'Service card added successfully.');
    }

    public function updateService(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->validatedService($request));

        return back()->with('status', 'Service card updated successfully.');
    }

    public function destroyService(Service $service): RedirectResponse
    {
        $service->delete();

        return back()->with('status', 'Service card removed successfully.');
    }

    /**
     * @return array{title: string, description: string, icon: string, cta_label: string, cta_url: string}
     */
    private function validatedService(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['required', Rule::in(array_keys(Service::ICON_OPTIONS))],
            'cta_label' => ['required', 'string', 'max:80'],
            'cta_url' => ['required', 'string', 'max:2048', 'regex:/^(#[\w-]+|https?:\/\/\S+)$/i'],
        ]);
    }
}
