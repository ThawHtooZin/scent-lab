<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scent_match_profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('daily_environment');
            $table->string('energy_style');
            $table->string('scent_impression');
            $table->string('climate_profile');
            $table->string('social_density');
            $table->string('longevity_goal');
            $table->string('profile_key');
            $table->string('profile_name');
            $table->string('headline');
            $table->text('reason');
            $table->json('recommended_products');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scent_match_profiles');
    }
};
