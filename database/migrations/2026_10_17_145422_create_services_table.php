<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->text('description');
            $table->string('icon', 32)->default('shapes');
            $table->string('cta_label', 80)->default('Discuss for Projects');
            $table->string('cta_url', 2048)->default('#contact');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        DB::table('services')->insert([
            [
                'title' => 'Digital branding',
                'description' => 'Build a distinctive visual identity that makes your brand memorable.',
                'icon' => 'shapes',
                'cta_label' => 'Discuss for Projects',
                'cta_url' => '#contact',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Creative solutions',
                'description' => 'Turn thoughtful ideas into clear, engaging digital experiences.',
                'icon' => 'pen-tool',
                'cta_label' => 'Discuss for Projects',
                'cta_url' => '#contact',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Marketing solutions',
                'description' => 'Create consistent campaigns that help your business reach more people.',
                'icon' => 'palette',
                'cta_label' => 'Discuss for Projects',
                'cta_url' => '#contact',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
