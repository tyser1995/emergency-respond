<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_type_id')->nullable();
            $table->unsignedBigInteger('created_by_users_id')->nullable();
            $table->longText('location')->nullable();
            $table->longText('lat')->nullable();
            $table->longText('lng')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->string('datetime_incident')->nullable();
            $table->unsignedBigInteger('deleted_flag')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('incidents');
    }
}
