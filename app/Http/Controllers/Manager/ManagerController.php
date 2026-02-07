<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Connexion;
use App\Models\Manager;
use App\Services\EventService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ManagerController extends Controller
{

    protected $eventService;
    protected $imageService;

    public function __construct(EventService $eventService, ImageService $imageService)
    {
        $this->eventService = $eventService;
        $this->imageService = $imageService;
    }

    public function login()
    {
        return view('manager_view.pages.login');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ],
        );

        $info = $request->only('username', 'password');

        $user = Manager::where('username', $info['username'])->first();

        if (!$user) {
            return back()->with('error', 'Utilisateur introuvable.');
        }

        $guard = '';

        if ($user->role == 'admin') {
            $guard = 'auth-admin';
        } else if ($user->role == 'manager') {
            $guard = 'auth-manager';
        } else {
            $guard = 'auth-visitor';
        }

        if (Auth::guard($guard)->attempt($info)) {
            Connexion::create([
                'membre_id' => $user->id
            ]);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Echec Connexion !!!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('auth-manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('manager.login');
    }

    public function create(Request $request)
    {
        $manager = new Manager;
        $manager->prenom = "Dahira";
        $manager->nom = "Golf";
        $manager->username = "dahira@golf";
        $manager->password = Hash::make("12345678");
        $manager->role = "manager";

        $manager->save();

        $admin = new Manager;
        $admin->prenom = "Super";
        $admin->nom = "Admin";
        $admin->username = "lookman@rahman";
        $admin->password = Hash::make("LookmanRahman");
        $admin->role = "admin";
        $admin->save();

        $user = new Manager;
        $user->prenom = "Simple";
        $user->nom = "User";
        $user->username = "dahiragolf";
        $user->password = Hash::make("87654321");
        $user->role = "visitor";
        $user->save();
    }

    public function showProfil()
    {
        $user = $this->getCurrentUser();
        return view('manager_view.profil.show', compact('user'));
    }

    public function StoreProfil(Request $request)
    {
        $manager = Manager::findOrFail($request->id);

        $validatedData = $request->validate([
            'prenom' => ['required', 'string', 'max:40'],
            'nom' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:50', Rule::unique('managers', 'username')->ignore($request->id),],
        ]);

        $manager->prenom = $request->prenom;
        $manager->nom = $request->nom;
        $manager->username = $request->username;
        $manager->save();

        $this->eventService->eventService('EDIT-PROFIL');

        return redirect()
            ->route('profil.show')
            ->with('message', 'Modification reussie !');
    }

    public function StorePassword(Request $request)
    {
        $request->validate([
            'ancien' => ['required'],
            'nouveau' => ['required', 'min:6', 'confirmed'],  // nouveau + nouveau_confirmation
        ]);

        $user = Auth::user();

        if (!Hash::check($request->ancien, $user->password)) {
            return back()->withErrors(['ancien' => 'L\'ancien mot de passe est incorrect.']);
        }

        // Met à jour le mot de passe
        $user->password = Hash::make($request->nouveau);
        $user->save();

        return back()->with('message', 'Mot de passe modifié avec succès');

    }

    public function storeAvatar(Request $request)
    {
        $validatedData = $request->validate([
            'avatar' => ['required', 'image', 'mimes:png,jpeg', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Utiliser le service pour redimensionner et stocker l'image
            $imagePath = $this->imageService->resizeAndStore(
                $request->file('avatar'),
                'profil',
                256,
                256
            );

            if ($imagePath) {
                $user->avatar = $imagePath;
            } else {
                return back()->withErrors(['avatar' => 'Erreur lors du traitement de l\'image']);
            }
        }

        $user->save();

        $this->eventService->eventService('EDIT-AVATAR');

        return redirect()
            ->route('profil.show')
            ->with('message', 'L\'image du profil a bien été modifiée !');
    }

    private function getCurrentUser()
    {
        foreach (['auth-manager', 'auth-employer'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->user();
            }
        }
        return null;
    }
}
