<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reported_by'); // Username of the user who reported
            $table->morphs('reportable'); // Polymorphic relationship (reportable_id and reportable_type)
            $table->timestamps(); // created_at (when the report was made) and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}