<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestsigned', function (Blueprint $table) {
            $table->id();
            $table->longText('keterangan');
            $table->enum('status', ['Decline', 'Approved', 'Waiting'])->default('Waiting');
            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('files_id')->constrained('upload')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('signer_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('requestsigned');
    }
}
