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
        Schema::create('uri_actives', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('uri_id');
            $table->foreign('uri_id')->references('id')->on('uris')->onDelete('cascade');
            $table->unsignedBigInteger('method_id');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uri_actives');
    }
};
