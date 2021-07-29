<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('profile_photo_path')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->string('phone')->nullable()->index();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('otp')->nullable()->index();
            $table->timestamp('otp_expired_at')->nullable();
            $table->integer('otp_fail_times')->nullable()->default(0);
            $table->tinyInteger('is_verify_otp')->nullable()->default(0);
            $table->integer('password_fail_times')->nullable()->default(0);
            $table->timestamp('unlock_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
