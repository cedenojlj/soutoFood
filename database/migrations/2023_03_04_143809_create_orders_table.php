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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('customerName');
            $table->unsignedBigInteger('user_id');
            $table->float('total', 14, 2)->default(0);
            $table->date('date1');
            $table->date('date2');
            $table->date('date3');   
            $table->text('comments');
            $table->string('customerEmail');
            $table->string('customerEmail2')->nullable();
            $table->string('saleRepEmail')->nullable();
            $table->string('vendorEmail')->nullable();
            $table->float('rebate', 14, 2)->nullable();
            $table->string('idRebate')->nullable();            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

