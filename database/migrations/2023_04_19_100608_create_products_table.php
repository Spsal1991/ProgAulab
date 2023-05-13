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
            $table->string("name");
            $table->text("description");
            $table->float("price");
            $table->bigInteger('is_in_promotion')->nullable();
            $table->unsignedBigInteger("user_id")->nullable()
                  ->foreign("user_id")
                  ->references("id")
                  ->on("users")->onDelete('cascade');

        $table->unsignedBigInteger("category_id")->nullable()->foreign("categories_id")->references("id")->on("categories")->onDelete("cascade");

        $table->unsignedBigInteger("region_id")->nullable()->foreign("regions_id")->references("id")->on("regions")->onDelete("cascade");

            $table->timestamps();
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