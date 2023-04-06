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
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('itemnumber')->constrained('products')->onUpdate('cascade')->onDelete('cascade');          

            //$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');            
            $table->integer('numBundle')->nullable();
            $table->float('priceBundle', 8, 2)->default(0);
            
            $table->string('email'); 
            $table->foreign('email')->references('email')->on('users');
            
            $table->string('itemnumber'); 
            $table->foreign('itemnumber')->references('itemnumber')->on('products');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundles');
    }
};


