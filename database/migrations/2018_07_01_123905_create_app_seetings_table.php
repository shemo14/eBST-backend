<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('smtp_type')->nullable();
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

        $setting = new \App\Models\AppSetting();
        $setting->site_name = 'اوامر الشبكة';
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_seetings');
    }
}
