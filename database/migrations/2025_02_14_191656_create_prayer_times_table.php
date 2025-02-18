<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->date('date');
            $table->time('sehri_time');
            $table->time('iftar_time');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('prayer_times');
    }
};
