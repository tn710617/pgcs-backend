<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_rooms', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('room_name')->comment('房間名稱')->unique();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新時間');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_rooms');
    }
};
