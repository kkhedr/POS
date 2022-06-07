<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneySupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_sups', function (Blueprint $table) {
            $table->id();
            $table->double('money')->unsigned();
            $table->bigInteger('sup_id')->unsigned();
            $table->foreign('sup_id')->references('id')->on('suplliers')->onDelete('cascade');
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
        Schema::dropIfExists('money_sups');
    }
}
