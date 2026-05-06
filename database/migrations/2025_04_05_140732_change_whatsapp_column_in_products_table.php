<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWhatsappColumnInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // تغيير العمود من bigInteger إلى string
            $table->string('whatsapp', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // في حالة التراجع عن التعديل، يمكنك إرجاعه إلى bigInteger
            $table->bigInteger('whatsapp')->change();
        });
    }
}
