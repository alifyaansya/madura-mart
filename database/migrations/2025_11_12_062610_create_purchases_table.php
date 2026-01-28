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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota', 15)->unique();
            $table->date('tgl_nota');
            $table->unsignedBigInteger('id_distributor');
            $table->foreign('id_distributor')->references('id')->on('distributors')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_bayar')->default(0);
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
        Schema::dropIfExists('purchases');
    }
};
