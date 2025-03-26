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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('address_line1');            
            $table->string('address_line2');
            $table->string('place');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('pincode');
            $table->string('mobile_no');
            $table->string('alternative_mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
