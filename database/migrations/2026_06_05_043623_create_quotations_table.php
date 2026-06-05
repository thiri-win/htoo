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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->date("date")->nullable();
            $table->string("subject")->nullable();
            $table->string("to")->nullable();
            $table->json("items")->nullable();
            $table->integer("sub_total")->nullable();
            $table->integer("discount")->nullable();
            $table->integer("advance")->nullable();
            $table->integer("grand_total")->nullable();
            $table->string("remark")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
