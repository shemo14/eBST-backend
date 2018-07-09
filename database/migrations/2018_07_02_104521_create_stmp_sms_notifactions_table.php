<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStmpSmsNotifactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stmp_sms_notifactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('smtp_type');
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_sender_email')->nullable();
            $table->string('smtp_sender_name')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_encryption')->nullable();
            $table->string('sms_number')->nullable();
            $table->string('sms_password')->nullable();
            $table->string('sms_sender_name')->nullable();
            $table->string('oneSignal_application_id')->nullable();
            $table->string('oneSignal_authorization')->nullable();
            $table->string('fcm_server_key')->nullable();
            $table->string('fcm_sender_id')->nullable();
            $table->timestamps();
        });

        $sms = new \App\StmpSmsNotifaction();
        $sms->smtp_type = 'stmp';
        $sms->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stmp_sms_notifactions');
    }
}
