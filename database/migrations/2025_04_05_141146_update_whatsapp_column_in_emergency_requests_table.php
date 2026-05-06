<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWhatsappColumnInEmergencyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            // تغيير نوع العمود من bigInteger إلى string
            $table->string('whatsapp', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergency_requests', function (Blueprint $table) {
            // في حالة التراجع، إعادة النوع إلى bigInteger
            $table->bigInteger('whatsapp')->change();
        });
    }
}
