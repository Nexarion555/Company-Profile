<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 180);
            $table->string('issuer', 180)->nullable();
            $table->string('certificate_number', 180)->nullable();
            $table->unsignedSmallInteger('issued_year')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0)->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
