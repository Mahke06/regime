<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserObjectifModel;

class User extends BaseController
{
    protected $userModel;
    protected $userObjectifModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userObjectifModel = new UserObjectifModel();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        if (!$this->validate([
            'email' => 'required|valid_email',
            'mot_de_passe' => 'required|min_length[6]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('mot_de_passe');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || $password != $user['mot_de_passe']) {
           return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }

        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'roles' => $user['roles'],
            'gold' => $user['gold'],
            'solde' => $user['solde'],
            'imc' => $user['imc'],
        ]);

        if ($user['roles'] === 'admin') {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/profile');
    }

    public function registerStep1()
    {
        return view('auth/register_step1');
    }

    public function registerStep2()
    {
        if (!$this->validate([
            'nom' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[user.email]|max_length[100]',
            'mot_de_passe' => 'required|min_length[6]|max_length[100]',
            'genre' => 'required|in_list[homme,femme]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $session = session();
        $session->set('temp_registration', [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'mot_de_passe' => $this->request->getPost('mot_de_passe'),
            'genre' => $this->request->getPost('genre'),
        ]);

        return view('auth/register_step2');
    }

    public function register()
    {
        if (!$this->validate([
            'taille' => 'required|decimal|greater_than[0]',
            'poids' => 'required|decimal|greater_than[0]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $session = session();
        $tempData = $session->get('temp_registration');

        if (!$tempData) {
            return redirect()->to('/register')->with('error', 'Session expirée, veuillez recommencer');
        }

        $taille = $this->request->getPost('taille');
        $poids = $this->request->getPost('poids');

        $tailleEnMetre = $taille / 100;
        $imc = $poids / ($tailleEnMetre ** 2);

        $this->userModel->save([
            'nom' => $tempData['nom'],
            'email' => $tempData['email'],
            'mot_de_passe' => $tempData['mot_de_passe'],
            'genre' => $tempData['genre'],
            'taille' => $taille,
            'poids' => $poids,
            'imc' => round($imc, 2),
            'roles' => 'user',
            'solde' => 0,
            'gold' => 0,
        ]);

        $session->remove('temp_registration');

        return redirect()->to('/login')->with('success', 'Inscription réussie! Veuillez vous connecter');
    }

    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);
        $objectifs = $this->userObjectifModel->getUserObjectifs($userId);

        $data = [
            'user' => $user,
            'objectifs' => $objectifs,
        ];

        return view('profile', $data);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'nom' => 'required|min_length[3]|max_length[100]',
            'taille' => 'required|decimal|greater_than[0]',
            'poids' => 'required|decimal|greater_than[0]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taille = $this->request->getPost('taille');
        $poids = $this->request->getPost('poids');

        $tailleEnMetre = $taille / 100;
        $imc = $poids / ($tailleEnMetre ** 2);

        $this->userModel->update($userId, [
            'nom' => $this->request->getPost('nom'),
            'taille' => $taille,
            'poids' => $poids,
            'imc' => round($imc, 2),
        ]);

        $session->set('imc', round($imc, 2));

        return redirect()->to('/profile')->with('success', 'Profil mis à jour avec succès');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Déconnexion réussie');
    }

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $data = [
            'users' => $this->userModel->findAll()
        ];
        return view('users/index', $data);
    }

    public function view($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé');
        }

        $data = ['user' => $user];
        return view('users/view', $data);
    }
}
