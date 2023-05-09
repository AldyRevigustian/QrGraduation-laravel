<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('registrant_name');
            $table->enum('status', ['Hadir', '-'])->default('-');
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
        Schema::dropIfExists('detail_statuses');
    }
};
