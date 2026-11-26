<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePaginaSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Demo-informatie uit het Figma-ontwerp.
            DB::table('homepagina_gegevens')->updateOrInsert(
                ['id' => 1],
                [
                    'naam' => 'SmilePro',
                    'slogan' => 'Een gezonde glimlach begint bij SmilePro',
                    'introductie' => 'Moderne tandheelkunde in een rustige en vertrouwde omgeving. Ons ervaren team neemt de tijd voor u.',
                    'over_ons' => 'Bij SmilePro geloven we dat goede tandheelkunde begint met luisteren. We combineren moderne technieken met een persoonlijke, rustige benadering.',
                    'adres' => 'Maliebaan 88',
                    'postcode_stad' => '3581 CV Utrecht',
                    'telefoon' => '030 - 123 45 67',
                    'email' => 'info@smilepro.nl',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Voorkomt dubbele behandelingen en teamleden.
            DB::table('homepagina_onderdelen')
                ->where('homepagina_id', 1)
                ->delete();

            $onderdelen = [
                [
                    'soort' => 'behandeling',
                    'naam' => 'Periodieke controles',
                    'beschrijving' => 'Voorkomen is beter dan genezen. Wij houden uw gebit gezond.',
                    'icoon' => 'fa-shield-halved',
                ],
                [
                    'soort' => 'behandeling',
                    'naam' => 'Vullingen',
                    'beschrijving' => 'Duurzame en tandkleurige oplossingen met persoonlijke aandacht.',
                    'icoon' => 'fa-plus',
                ],
                [
                    'soort' => 'behandeling',
                    'naam' => 'Gebitsreiniging',
                    'beschrijving' => 'Een fris en gezond gebit door onze ervaren mondhygiënisten.',
                    'icoon' => 'fa-check',
                ],
                [
                    'soort' => 'behandeling',
                    'naam' => 'Orthodontie',
                    'beschrijving' => 'Een rechte glimlach met een behandelplan dat bij u past.',
                    'icoon' => 'fa-arrow-right',
                ],
                [
                    'soort' => 'behandeling',
                    'naam' => 'Wortelkanaalbehandeling',
                    'beschrijving' => 'Pijnvrij behandelen en uw natuurlijke tand behouden.',
                    'icoon' => 'fa-file-medical',
                ],
                [
                    'soort' => 'team',
                    'naam' => 'drs. Lotte de Vries',
                    'functie' => 'Tandarts & praktijkhouder',
                    'afbeelding_url' => 'https://images.unsplash.com/photo-1683349370055-7eba66a404c6?auto=format&fit=crop&w=800&q=85',
                ],
                [
                    'soort' => 'team',
                    'naam' => 'dr. Amir El Idrissi',
                    'functie' => 'Tandarts',
                    'afbeelding_url' => 'https://www.hrccd.com/assets/images/preventive-dentistry-3.webp',
                ],
                [
                    'soort' => 'team',
                    'naam' => 'drs. Emma Meijer',
                    'functie' => 'Tandarts',
                    'afbeelding_url' => 'https://img.osteocom.me/img/67165e2da76a8a6c5875b570',
                ],
            ];

            foreach ($onderdelen as $volgorde => $onderdeel) {
                DB::table('homepagina_onderdelen')->insert([
                    'homepagina_id' => 1,
                    'soort' => $onderdeel['soort'],
                    'naam' => $onderdeel['naam'],
                    'beschrijving' => $onderdeel['beschrijving'] ?? null,
                    'functie' => $onderdeel['functie'] ?? null,
                    'icoon' => $onderdeel['icoon'] ?? null,
                    'afbeelding_url' => $onderdeel['afbeelding_url'] ?? null,
                    'volgorde' => $volgorde + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
