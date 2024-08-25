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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('total');
            $table->string('vat');
            $table->string('payable');
            $table->string('cus_details');
            $table->string('ship_details');
            $table->string('tran_id');
            $table->string('val_id')->default(0);
            $table->enum('delivery_status',['pending','processing','shipped','delivered','cancelled']);
            $table->string('payment_status');

            // Foreign Key
            $table->unsignedBigInteger('user_id');

            //Relationship Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
