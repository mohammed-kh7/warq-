<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // إضافة العمود 'id' كـ AUTO_INCREMENT
            $table->bigIncrements('id')->first();  // 'first()' لوضعه في بداية الجدول
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // حذف العمود 'id' في حالة الرجوع
            $table->dropColumn('id');
        });
    }
};
