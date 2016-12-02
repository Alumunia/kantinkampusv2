<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldRegistrationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('field_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('type_question');
            $table->string('parameter_name');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('field_registration');
    }

}
