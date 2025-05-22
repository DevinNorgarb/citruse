<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('address');
            $table->string('country');
            $table->string('vat_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('sales_contact_name');
            $table->string('sales_contact_email');
            $table->string('sales_contact_phone');
            $table->string('logistics_contact_name')->nullable();
            $table->string('logistics_contact_email')->nullable();
            $table->string('logistics_contact_phone')->nullable();
            $table->text('payment_terms')->nullable();
            $table->string('currency')->default('USD');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};