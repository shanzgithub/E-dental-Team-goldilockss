<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('dentistID');
            $table->integer('patientID');
            $table->integer('type');
            $table->string('name');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE digital_documents ADD file LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_documents');
    }
};
