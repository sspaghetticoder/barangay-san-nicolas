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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('full_id')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->char('suffix', 100)->nullable();
            $table->string('email')->nullable();
            $table->char("contact_number", 20);
            $table->char("gender", 1);
            $table->string('house_number');
            $table->string('street');
            $table->string('area')->nullable();
            $table->string('place_of_birth');
            $table->date('birth_date');
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
        Schema::dropIfExists('residents');
    }
};
