<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Entries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idUser');
            $table->string('title');
            $table->text('content');
            $table->timestamp('creation_date')->useCurrent = true;
            $table->foreign('idUser')->references('id')->on('users');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('entries')->insert([
            'idUser' => "1",
            'title' => "Entry Jose 1",
            'content' => "this is a cntent ",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
