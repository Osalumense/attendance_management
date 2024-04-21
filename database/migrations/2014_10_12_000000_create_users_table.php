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
            $table->bigIncrements('id');
            $table->string('surname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tagNumber')->nullable();
            $table->enum('group', ['A', 'B', 'C'])->default('A');
            $table->string('unit')->nullable();
            $table->string('image')->nullable();
            $table->string('password');            
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->enum('status', ['1', '0'])->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
