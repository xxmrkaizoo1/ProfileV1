<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function edit(): View
    {
        $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

        return view('admin.profile', [
            'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
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
}
