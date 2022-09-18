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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('subject',555);
            $table->date('issue_date');
            $table->date('due_date');
            $table->float('subtotal',16,2);
            $table->float('tax',16,2);
            $table->integer('taxCal',10)->unsigned();
            $table->float('total_order',16,2);
            $table->float('payment',16,2);
            $table->enum('status',['PAID','UNPAID']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
