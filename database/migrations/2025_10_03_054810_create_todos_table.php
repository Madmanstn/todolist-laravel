<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::create('todos', function (Blueprint $table) {
        $table->id();
        $table->string('text', 500);
        $table->boolean('completed')->default(false);
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('todos');
    }
};