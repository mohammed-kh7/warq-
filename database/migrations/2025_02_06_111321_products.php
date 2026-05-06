<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments(column: 'id');
            $table->string('slug');
            $table->string(column: 'name');
            $table->enum('category', ['دواء', 'ملابس', 'أغذية']);
            $table->longText('description');
            $table->integer('quantity');
            $table->string('location');
            $table->bigInteger('whatsapp');
            $table->string(column: 'image_path');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
