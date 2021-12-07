<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('serialNumber',20)->unique;
            $table->integer('type')->default(0);
            $table->date('publicationDate');
            $table->integer('style')->default(0);
            $table->text('commentary')->nullable();
            $table->string('imageFile')->default(0);
            
            //relaciones
            $table->unsignedBigInteger('user_id'); //a table_id //tabla en singular
            $table->foreign('user_id')
                            ->references('id')
                            ->on('users')
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
                        
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
        Schema::dropIfExists('states');
    }
}
