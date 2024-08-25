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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 150);
            $table->string('short_des', length: 500);
            $table->string('price', length: 50);
            $table->boolean('discount');
            $table->string('discount_price', length: 50);
            $table->string('image', length: 200);
            $table->boolean('stock');
            $table->float('star');

            //enum er kaj holo DB option create kora jay

            $table->enum('remark', ['popular', 'new', 'top', 'special', 'trending', 'regular']);

            //Relationship

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');


            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete()->cascadeOnUpdate();

            $table->foreign('brand_id')->references('id')->on('brands')->restrictOnDelete()->cascadeOnUpdate();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
