<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // تعديل العمود category ليكون enum بالقيم العربية
            $table->enum('category', ['ملابس', 'أغذية', 'دواء'])->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // إذا كنت بحاجة لإرجاع التعديل
            // $table->string('category')->change();
        });
    }
};
