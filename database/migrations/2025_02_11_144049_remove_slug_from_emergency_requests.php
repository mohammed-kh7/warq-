<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->dropColumn('slug'); // حذف العمود
        });
    }

    public function down()
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            $table->string('slug')->nullable(); // إضافة العمود مرة أخرى إذا أردت التراجع
        });
    }
};
