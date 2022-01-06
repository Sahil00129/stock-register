<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->date('dor');
            $table->string('manufectrure');
            $table->string('batch_no');
            $table->date('dom'); 
            $table->date('doe');   
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('qty');
            $table->string('prv_blnc');
            $table->string('received');
            $table->string('sold_or_distributed');
            $table->string('returns');    
            $table->string('stock_transfer');
            $table->string('bal_stock');
            $table->string('bill_no'); 
            $table->date('bill_date'); 
            $table->string('whom_to_sold'); 
            $table->string('remarks');       
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
        Schema::dropIfExists('imports');
    }
}
