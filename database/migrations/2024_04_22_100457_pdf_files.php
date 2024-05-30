<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PdfFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('documents', function (Blueprint $table) {
            $table->id();
	    $table->string('filename');
            $table->string('file_path'); // Ruta del archivo PDF
	    $table->string('user_name');
            $table->string('document_type'); // Tipo de documento (KYC, Estado de cuenta, etc.)
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
        Schema::dropIfExists('documents');
    }
}
