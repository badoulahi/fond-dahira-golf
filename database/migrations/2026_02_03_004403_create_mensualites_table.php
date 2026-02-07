<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensualites', function (Blueprint $table) {
            $table->id();
            $table->string('annee')->default(date('Y'));
            $table->integer("jan")->default(0);
            $table->integer("feb")->default(0);
            $table->integer("mar")->default(0);
            $table->integer("apr")->default(0);
            $table->integer("may")->default(0);
            $table->integer("jun")->default(0);
            $table->integer("jul")->default(0);
            $table->integer("aug")->default(0);
            $table->integer("sep")->default(0);
            $table->integer("oct")->default(0);
            $table->integer("nov")->default(0);
            $table->integer("dec")->default(0);
            $table->foreignId('membre_id')->constrained('membres')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensualites');
    }
};
