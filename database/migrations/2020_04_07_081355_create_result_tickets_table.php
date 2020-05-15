<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_id')->unique()->unsigned();
            $table->bigInteger('person_id')->unique()->unsigned();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('yes')->nullable();
            $table->bigInteger('no')->nullable();
            $table->bigInteger('other')->nullable();
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');
            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_tickets');
    }
}
