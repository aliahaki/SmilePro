
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Algemene informatie over de praktijk.
        Schema::create('homepagina_gegevens', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('slogan');
            $table->text('introductie');
            $table->text('over_ons');
            $table->string('adres');
            $table->string('postcode_stad');
            $table->string('telefoon');
            $table->string('email');
            $table->timestamps();
        });

        // Behandelingen en teamleden op de homepagina.
        Schema::create('homepagina_onderdelen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('homepagina_id')
                ->constrained('homepagina_gegevens')
                ->cascadeOnDelete();

            $table->string('soort', 30);
            $table->string('naam');
            $table->text('beschrijving')->nullable();
            $table->string('functie')->nullable();
            $table->string('icoon')->nullable();
            $table->text('afbeelding_url')->nullable();
            $table->unsignedSmallInteger('volgorde')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepagina_onderdelen');
        Schema::dropIfExists('homepagina_gegevens');
    }
};
