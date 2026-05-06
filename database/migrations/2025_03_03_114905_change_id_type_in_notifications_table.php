<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // إزالة المفتاح الأساسي الحالي (إذا كان موجودًا)
            $table->dropPrimary(['id']);

            // تغيير نوع العمود 'id' إلى UUID
            $table->uuid('id')->primary()->change();
        });
    }


    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // العودة إلى النوع السابق (إذا أردت الرجوع)
            $table->bigIncrements('id')->primary()->change();
        });
    }
};
