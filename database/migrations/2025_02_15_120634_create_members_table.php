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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phoneNumber')->unique();
            $table->string('coachName')->nullable();
            $table->integer('level')->nullable();
            $table->string('typeOfTrain')->default('مجموعه');
            $table->string('location')->nullable();
            
            $table->enum('state' , ['قيد المعالجه' , 'تم القبول' , 'تم الرفض'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
