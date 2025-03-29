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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('uri_id');
            $table->boolean('status')->default(1);

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreign('uri_id')->references('id')->on('uris')->onDelete('cascade');
            $table->unique(['role_id','method_id','uri_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
