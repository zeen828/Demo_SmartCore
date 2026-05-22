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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('email')->unique()->comment('帳號');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密碼');
            $table->boolean('status')->default('0')->comment('狀態');
            $table->boolean('is_admin')->default('0')->comment('管理員');
            $table->boolean('is_counter')->default('0')->comment('櫃台人員');
            $table->boolean('is_web')->default('0')->comment('網站人員');
            $table->rememberToken();
            $table->timestamps();

            $table->comment('使用者');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            $table->comment('忘記密碼token');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            $table->comment('登入Session');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
