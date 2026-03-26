<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company', function (Blueprint $table) {
            if (!Schema::hasColumn('company', 'logo_path')) {
                $table->string('logo_path', 500)->nullable()->after('logo_url');
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'logo_path')) {
                $table->string('logo_path', 500)->nullable()->after('logo_url');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'main_image_path')) {
                $table->string('main_image_path', 500)->nullable()->after('main_image_url');
            }
        });

        Schema::table('project_images', function (Blueprint $table) {
            if (!Schema::hasColumn('project_images', 'image_path')) {
                $table->string('image_path', 500)->nullable()->after('image_url');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'image_path')) {
                $table->string('image_path', 500)->nullable()->after('image_url');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'avatar_path')) {
                $table->string('avatar_path', 500)->nullable()->after('avatar_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            if (Schema::hasColumn('company', 'logo_path')) {
                $table->dropColumn('logo_path');
            }
        });

        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'logo_path')) {
                $table->dropColumn('logo_path');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'main_image_path')) {
                $table->dropColumn('main_image_path');
            }
        });

        Schema::table('project_images', function (Blueprint $table) {
            if (Schema::hasColumn('project_images', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'avatar_path')) {
                $table->dropColumn('avatar_path');
            }
        });
    }
};
