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
        Schema::create('article_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("article_id");
            $table->string("type");
            $table->string("title")->nullable();
            $table->unsignedBigInteger("priority")->default(1);

            $table->text("description")->nullable();
            $table->unsignedBigInteger("image_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_blocks');
    }
};
