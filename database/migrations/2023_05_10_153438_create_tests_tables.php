<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTables extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            $table->integer('position')->unsigned()->nullable();
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('test_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'test');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('test_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'test');
        });

        Schema::create('test_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'test');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_revisions');
        Schema::dropIfExists('test_translations');
        Schema::dropIfExists('test_slugs');
        Schema::dropIfExists('tests');
    }
}
