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
        if (!Schema::hasTable('doorplates')) {
            Schema::create('doorplates', function (Blueprint $table) {
                $table->id();
                $table->string('doorplate')->comment('門牌號碼');
                $table->string('floor')->comment('樓層');
                $table->string('household')->comment('戶別/戶號');
                $table->string('code')->comment('代碼');
                $table->string('square_meters')->comment('面積');
                $table->string('status')->comment('狀態');
                $table->string('memo')->comment('備註');
                $table->timestamps();

                // 表註解
                $table->comment('門牌');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('doorplates')) {
            Schema::dropIfExists('doorplates');
        }
    }
};
