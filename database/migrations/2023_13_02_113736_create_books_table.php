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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title_book",100);
            $table->string("photo",200);
            $table->foreignId("author_id")->constrained("authors");
            $table->foreignId("publication_id")->constrained("publications");
            $table->integer("year_publication");
            $table->text("description");
            $table->integer("auditorium");
            $table->integer("pages");
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
        Schema::dropIfExists('books');
    }
};
