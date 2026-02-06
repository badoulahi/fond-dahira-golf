<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Mensualite;
use Illuminate\Http\Request;

class MembreController extends Controller
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
        "Feb" => "Février",
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membres = Membre::all();
        return view('manager_view.membre.list', compact('membres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager_view.membre.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_complet' => ['required', 'string', 'min:5', 'max:100'],
            'engagement' => ['required', 'integer', 'min:5000'],
        ]);

        $membre = Membre::create($validatedData);

        $mensualite = new Mensualite([
            'engagement' => $request->engagement,
            // 'annee' => date('Y'),
            'membre_id' => $membre->id
        ]);

        $mensualite->save();

        return redirect()
            ->route('membres.index')
            ->with('success', 'Le membre a bien été ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membre $membre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membre $membre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $membre = Membre::where('slug', $request->slug)->first();
        if (!$membre) {
            return back()->withErrors(['error' => 'Membre inexistant !!!']);
        }

        $validatedData = $request->validate([
            'nom_complet' => ['required', 'string', 'min:5', 'max:100'],
            'engagement' => ['required', 'integer', 'min:5000'],
        ]);

        $membre->update([
            'nom_complet' => $request->nom_complet,
            'engagement' => $request->engagement
        ]);
        $membre->save();

        return redirect()
            ->route('membres.index')
            ->with('success', 'Le membre a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $membre = Membre::where('slug', $slug)->firstOrFail();
        // if ($membre->mensualites()->exists()) {
        //     return redirect()
        //         ->route('membres.index')
        //         ->with('error', 'Le client possède des memsualités');
        // }

        $membre->delete();

        return redirect()
            ->route('membres.index')
            ->with('success', 'Membre supprimé avec success');
    }

    public function showCotisation()
    {
        $selectedYear = date('Y'); // A recuperer dinamiquement
        $membres = Membre::all();
        $total = 0;
        foreach ($membres as $membre) {
            foreach ($membre->mensualites as $mensualite) {
                if ($mensualite->annee == $selectedYear) {
                    $total += $mensualite->total();
                }
            }
        }
        // dd($total);
        return view('manager_view.membre.show', [
            'membres' => $membres,
            'mois' => self::TABLEAU_MOIS,
            'annees' => self::TABLEAU_ANNEE,
            'selectedYear' => date('Y'),
            'total' => $total
        ]);
    }

    public function storeCotisation(Request $request)
    {
        $membre = Membre::where('id', $request->slug)->first();
        if (!$membre) {
            return back()->withErrors(['error' => 'Membre inexistant !!!']);
        }

        if (!in_array($request->year, self::TABLEAU_ANNEE)) {
            return back()->withErrors(['error' => 'Année inexistante !!!']);
        }

        $mensualite = Mensualite::where('annee', $request->year)->where('membre_id', $membre->id)->first();
        if ($mensualite) {
            foreach ($request->mensualite as $mois => $montant) {
                $mensualite->{$mois} = $montant ?? 0;
            }
        }

        $mensualite->save();

        return redirect()
            ->route('cotisation.show')
            ->with('success', 'Mensualités mises à jour avec succès');

    }
}
