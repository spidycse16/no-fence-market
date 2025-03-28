<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
public function up()
{
    Schema::create('vendor_approvals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('full_name');
        $table->string('nid_number')->unique();
        $table->string('email')->unique();
        $table->string('personal_phone');
        $table->string('mobile_banking_no');
        $table->string('business_type');
        $table->string('nid_document_path');
        $table->string('tin_number');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('vendor_approvals');
}
};
