<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add roles flags to users table
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('image');
            $table->boolean('is_moderator')->default(false)->after('is_admin');
            $table->boolean('is_author')->default(false)->after('is_moderator');
            $table->boolean('is_teacher')->default(false)->after('is_author');
            $table->string('bio', 500)->nullable()->after('is_teacher');
        });

        // 2. Role Applications (SSO-08 & SSO-09)
        Schema::create('role_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role_requested')->comment('author, teacher, moderator');
            $table->text('bio')->nullable();
            $table->text('experience')->nullable();
            $table->string('status')->default('pending')->comment('pending, approved, rejected');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // 3. Community Posts & Discussions (المجتمع التعليمي ومجتمع القراء)
        Schema::create('community_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('category')->default('مناقشات عامة');
            $table->integer('likes_count')->default(0);
            $table->timestamps();
        });

        // 4. Content Requests (طلبات الكتب والمحتوى غير المتوفر)
        Schema::create('content_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('type')->default('كتاب');
            $table->text('description')->nullable();
            $table->integer('votes_count')->default(1);
            $table->string('status')->default('open')->comment('open, in_progress, fulfilled, closed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_requests');
        Schema::dropIfExists('community_posts');
        Schema::dropIfExists('role_applications');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'is_moderator', 'is_author', 'is_teacher', 'bio']);
        });
    }
};
