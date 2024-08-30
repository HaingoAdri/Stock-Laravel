<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokenuser', function (Blueprint $table) {
            $table->id();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->unsignedBigInteger('iduser')->nullable();
            
            // Ajouter la contrainte de clé étrangère
            $table->foreign('iduser')->references('id')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokenuser');
    }
};
