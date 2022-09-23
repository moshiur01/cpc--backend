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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id()->random_bytes();
            $table->string('certificate_id')->nullable();
            $table->string('stu_id')->nullable();
            $table->string('stu_name')->nullable();
            $table->string('stu_email')->nullable();
            $table->string('program_name')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('certificate_image')->nullable();
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
        Schema::dropIfExists('certificates');
    }
};
