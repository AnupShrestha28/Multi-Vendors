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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('cname')->nullable();
            $table->string('chelplineno')->nullable();
            $table->string('chelplineslogan')->nullable();
            $table->string('caddress')->nullable();
            $table->string('cnumber')->nullable();
            $table->string('cemail')->nullable();
            $table->string('cimage')->nullable();

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
        Schema::dropIfExists('companies');
    }
};
