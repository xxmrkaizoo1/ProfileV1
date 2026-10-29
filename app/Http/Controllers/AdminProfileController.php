<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function edit(): View
    {
        $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');
        $projectsBackgroundPath = DB::table('site_settings')->where('key', 'projects_background')->value('value');

        return view('admin.profile', [
            'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
            'projectsBackgroundImage' => $projectsBackgroundPath ? Storage::disk('public')->url($projectsBackgroundPath) : null,
            'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
            'serviceIcons' => Service::ICON_OPTIONS,
            'projects' => Project::query()->orderBy('sort_order')->orderBy('id')->get(),
            'portfolios' => Portfolio::query()->orderBy('sort_order')->orderBy('id')->get(),
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

    public function destroyHeroImage(): RedirectResponse
    {
        $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

        DB::table('site_settings')->where('key', 'hero_image')->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return back()->with('status', 'Hero image removed successfully.');
    }

    public function updateProjectsBackground(Request $request): RedirectResponse
    {
        $request->validate([
            'projects_background' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ]);

        $imagePath = $request->file('projects_background')->store('projects/background', 'public');

        if (! $imagePath) {
            return back()->withErrors(['projects_background' => 'The image could not be saved. Please try again.']);
        }

        $previousPath = DB::table('site_settings')->where('key', 'projects_background')->value('value');

        DB::table('site_settings')->updateOrInsert(
            ['key' => 'projects_background'],
            ['value' => $imagePath, 'updated_at' => now(), 'created_at' => now()],
        );

        if ($previousPath && $previousPath !== $imagePath) {
            Storage::disk('public')->delete($previousPath);
        }

        return back()->with('status', 'Projects background updated successfully.');
    }

    public function storeProject(Request $request): RedirectResponse
    {
        $validated = $this->validatedProject($request, true);
        $imagePath = $request->file('image')->store('projects', 'public');

        if (! $imagePath) {
            return back()->withErrors(['image' => 'The project image could not be saved. Please try again.']);
        }

        unset($validated['image']);

        Project::create([
            ...$validated,
            'image_path' => $imagePath,
            'sort_order' => (int) Project::max('sort_order') + 1,
        ]);

        return back()->with('status', 'Project added successfully.');
    }

    public function updateProject(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validatedProject($request, false);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');

            if (! $imagePath) {
                return back()->withErrors(['image' => 'The project image could not be saved. Please try again.']);
            }

            $previousPath = $project->image_path;
            $validated['image_path'] = $imagePath;
        }

        unset($validated['image']);

        $project->update($validated);

        if (isset($previousPath)) {
            Storage::disk('public')->delete($previousPath);
        }

        return back()->with('status', 'Project updated successfully.');
    }

    public function destroyProject(Project $project): RedirectResponse
    {
        $imagePath = $project->image_path;
        $project->delete();
        Storage::disk('public')->delete($imagePath);

        return back()->with('status', 'Project removed successfully.');
    }

    public function storePortfolio(Request $request): RedirectResponse
    {
        $validated = $this->validatedPortfolio($request, true);
        $imagePath = $request->file('image')->store('portfolios', 'public');

        if (! $imagePath) {
            return back()->withErrors(['image' => 'The portfolio image could not be saved. Please try again.']);
        }

        unset($validated['image']);

        Portfolio::create([
            ...$validated,
            'image_path' => $imagePath,
            'sort_order' => (int) Portfolio::max('sort_order') + 1,
        ]);

        return back()->with('status', 'Portfolio card added successfully.');
    }

    public function updatePortfolio(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $this->validatedPortfolio($request, false);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios', 'public');

            if (! $imagePath) {
                return back()->withErrors(['image' => 'The portfolio image could not be saved. Please try again.']);
            }

            $previousPath = $portfolio->image_path;
            $validated['image_path'] = $imagePath;
        }

        unset($validated['image']);

        $portfolio->update($validated);

        if (isset($previousPath)) {
            Storage::disk('public')->delete($previousPath);
        }

        return back()->with('status', 'Portfolio card updated successfully.');
    }

    public function destroyPortfolio(Portfolio $portfolio): RedirectResponse
    {
        $imagePath = $portfolio->image_path;
        $portfolio->delete();
        Storage::disk('public')->delete($imagePath);

        return back()->with('status', 'Portfolio card removed successfully.');
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

    /**
     * @return array{title: string, category: string, url: ?string, image?: UploadedFile}
     */
    private function validatedProject(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'url' => ['nullable', 'url', 'regex:/^https?:\/\//i', 'max:2048'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }

    /**
     * @return array{title: string, category: string, description: string, tools: string, url: ?string, image?: UploadedFile}
     */
    private function validatedPortfolio(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'description' => ['required', 'string', 'max:1000'],
            'tools' => ['required', 'string', 'max:1000'],
            'url' => ['nullable', 'url', 'regex:/^https?:\/\//i', 'max:2048'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }
}
