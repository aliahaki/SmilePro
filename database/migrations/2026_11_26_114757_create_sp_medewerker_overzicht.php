
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_MedewerkerOverzicht
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_MedewerkerOverzicht()
            BEGIN
                SELECT
                    m.Id AS MedewerkerId,
                    m.Naam,
                    m.Functie,
                    m.Email,
                    m.PraktijkmanagmentId,
                    p.Beschikbaarheid,
                    m.Isactief,
                    m.Opmerkingen,
                    m.Datumaangemaakt,
                    m.Datumgewijzigd
                FROM Medewerker m
                LEFT JOIN Praktijkmanagment p
                    ON m.PraktijkmanagmentId = p.Id
                ORDER BY m.Naam ASC;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_MedewerkerOverzicht
        ");
    }
};
