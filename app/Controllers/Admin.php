<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $session = session();

        if ($session->get('roles') === 'admin' && $session->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        $data = [];

        if ($this->request->getMethod() === 'post') {
            return $this->authenticate();
        }

        return view('admin/login', $data);
    }

    public function authenticate()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('mot_de_passe');

        if (!$this->validate([
            'email' => 'required|valid_email',
            'mot_de_passe' => 'required|min_length[6]',
        ])) {
            return redirect()->to('/admin/login')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel
            ->where('email', $email)
            ->where('roles', 'admin')
            ->first();

        if (!$user) {
            return redirect()->to('/admin/login')
                ->withInput()
                ->with('error', 'Email ou mot de passe incorrect');
        }

        if (!$user || $password != $user['mot_de_passe']) {
           return redirect()->to('/admin/login')
                ->withInput()
                ->with('error', 'Email ou mot de passe incorrect');
        }

        $session->set([
            'user_id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'roles' => $user['roles'],
            'gold' => $user['gold'],
            'solde' => $user['solde'],
        ]);

        return redirect()->to('/dashboard')
            ->with('success', 'Bienvenue ' . $user['nom'] . ' !');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/admin/login')
            ->with('success', 'Vous avez été déconnecté');
    }
}
