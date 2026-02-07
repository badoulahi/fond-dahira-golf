<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Membre;
use App\Models\Mensualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public const TABLEAU_ANNEE = [
        "2025",
        "2026",
        "2027",
        "2028",
        "2029",
        "2030",
        "2031",
        "2032",
        "2033",
        "2034",
        "2035",
    ];

    public const TABLEAU_MOIS = [
        "Jan" => "Janvier",
        "Feb" => "Févrie",
        "Mar" => "Mars",
        "Apr" => "Avril",
        "May" => "Mai",
        "Jun" => "Juin",
        "Jul" => "Juillet",
        "Aug" => "Aout",
        "Sep" => "Septembre",
        "Oct" => "Octobre",
        "Nov" => "Novemvre",
        "Dec" => "Décembre"
    ];

    public function accueil()
    {
        $annee = now()->format('Y');
        $mois = now()->format('M');
        $membres = Membre::all();
        $totalMembre = $membres->count();

        $totalEngagement = 0;
        $totalAnnuel = 0;
        $totalMensuel = 0;
        $mensualites = Mensualite::all();

        foreach ($mensualites as $mensualite) {
            if ($mensualite->annee == $annee) {
                $totalAnnuel += $mensualite->total();
            }
            $totalMensuel += $mensualite->mensuel($mois);
        }


        $repartitionCotisation = [
            'cinqmille' => [
                'nombre' => 0,
                'pourcentage' => 0,
                'total' => 0
            ],
            'dixmille' => [
                'nombre' => 0,
                'pourcentage' => 0,
                'total' => 0
            ],
            'vinghtmille' => [
                'nombre' => 0,
                'pourcentage' => 0,
                'total' => 0
            ],
            'plus' => [
                'nombre' => 0,
                'pourcentage' => 0,
                'total' => 0
            ]
        ];

        foreach ($membres as $membre) {
            $totalEngagement += $membre->engagement;
            if ($membre->engagement == 5000) {
                $repartitionCotisation['cinqmille']['nombre']++;
                $repartitionCotisation['cinqmille']['total'] += $membre->engagement;
            } else if ($membre->engagement <= 10000) {
                $repartitionCotisation['dixmille']['nombre']++;
                $repartitionCotisation['dixmille']['total'] += $membre->engagement;
            } else if ($membre->engagement <= 20000) {
                $repartitionCotisation['vinghtmille']['nombre']++;
                $repartitionCotisation['vinghtmille']['total'] += $membre->engagement;
            } else if ($membre->engagement > 20000) {
                $repartitionCotisation['plus']['nombre']++;
                $repartitionCotisation['plus']['total'] += $membre->engagement;
            }
        }

        // dd($totalEngagement,$repartitionCotisation);
        foreach ($repartitionCotisation as $key => $value) {
            $repartitionCotisation[$key]['pourcentage'] = round((($repartitionCotisation[$key]['total'] * 100) / $totalEngagement));
        }




        $statistics_annuel = [
            'totalMembre' => $totalMembre,
            'totalAnnuel' => $totalAnnuel,
            'totalMensuel' => $totalMensuel,
            'repartitionCotisation' => $repartitionCotisation
        ];
        // dd($statistics_annuel);

        return view('manager_view.pages.dashboard', [
            'periode' => [
                'annees' => self::TABLEAU_ANNEE,
                'mois' => self::TABLEAU_MOIS
            ],
            'statistics_annuel' => $statistics_annuel
        ]);
    }
}
