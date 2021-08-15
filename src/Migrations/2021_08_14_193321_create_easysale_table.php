<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEasysaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('easysale_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('image')->nullable();
            $table->boolean('status')->default(true)->index();
            $table->integer('sort_by')->default(1);
            $table->timestamps();
        });

        Schema::create('easysale_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name', 191);
            $table->string('image')->nullable();
            $table->decimal('base_price')->default(0.00);
            $table->decimal('minimum_price')->default(0.00);
            $table->boolean('status')->default(true)->index();
            $table->integer('sort_by')->default(1);
            $table->index(['category_id', 'status']);
            $table->foreign('category_id')->references('id')->on('easysale_categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('easysale_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->integer('sort_by')->default(1);
            $table->timestamps();
        });

        Schema::create('easysale_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('option_id')->index();
            $table->string('name', 191);
            $table->integer('sort_by')->default(1);
            $table->foreign('option_id')->references('id')->on('easysale_options')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('easysale_product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('variant_id');
            $table->decimal('price')->default(0.00);
            $table->enum('price_type', ['price', 'percent'])->default('price');
            $table->foreign('product_id')->references('id')->on('easysale_products')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('easysale_variants')->onDelete('cascade');
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
        Schema::dropIfExists('easysale_product_variants');
        Schema::dropIfExists('easysale_variants');
        Schema::dropIfExists('easysale_options');
        Schema::dropIfExists('easysale_products');
        Schema::dropIfExists('easysale_categories');
    }
}
