<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('status')->default('completed')->comment('reading, completed, borrowed');
            $table->integer('progress')->default(0)->comment('Reading progress percentage');
            $table->text('last_page')->nullable();
            $table->json('bookmarks')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_books');
    }
};