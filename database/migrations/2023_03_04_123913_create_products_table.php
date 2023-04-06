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
            //$table->string('itemnumber');
            //$table->primary('itemnumber');
            $table->string('itemnumber')->index();
            $table->string('name');
            $table->string('description');
            $table->string('upc');
            $table->integer('pallet');                     
            $table->float('price', 8, 2)->default(0);
           // $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');

           $table->string('email'); 
           $table->foreign('email')->references('email')->on('users');
            $table->integer('prioridad')->default(5);  
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

