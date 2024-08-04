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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('adopter_name');
            $table->string('adopter_phone');
            $table->string('adopter_address');
            $table->string('adopter_city_state');
            $table->string('name');
            $table->string('type');
            $table->string('mobile');
            $table->string('email');
            $table->string('mailing_name');
            $table->string('mailing_street_address');
            $table->string('mailing_city_state_zip');
            $table->string('mailing_note');
            $table->string('order_status');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
