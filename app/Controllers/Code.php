<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\UserModel;

class Code extends BaseController
{
    protected $codeModel;
    protected $userModel;

    public function __construct()
    {
        $this->codeModel = new CodeModel();
        $this->userModel = new UserModel();
    }

    /**
     * Liste tous les codes
     */
    public function index()
    {
        $data = [
            'codes' => $this->codeModel->findAll()
        ];
        return view('codes/index', $data);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('codes/create');
    }

    /**
     * Enregistre un nouveau code
     */
    public function store()
    {
        if (!$this->validate([
            'code' => 'required|is_natural_no_zero|is_unique[code.code]',
            'montant' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->codeModel->save([
            'code' => $this->request->getPost('code'),
            'montant' => $this->request->getPost('montant'),
            'utilise' => false,
        ]);

        return redirect()->to('/codes')->with('success', 'Code créé avec succès');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $code = $this->codeModel->find($id);
        if (!$code) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Code non trouvé');
        }

        $data = ['code' => $code];
        return view('codes/edit', $data);
    }

    /**
     * Met à jour un code
     */
    public function update($id)
    {
        if (!$this->validate([
            'code' => 'required|is_natural_no_zero|is_unique[code.code,id,{id}]',
            'montant' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->codeModel->update($id, [
            'code' => $this->request->getPost('code'),
            'montant' => $this->request->getPost('montant'),
        ]);

        return redirect()->to('/codes')->with('success', 'Code mis à jour avec succès');
    }

    /**
     * Supprime un code
     */
    public function delete($id)
    {
        $this->codeModel->delete($id);
        return redirect()->to('/codes')->with('success', 'Code supprimé avec succès');
    }

    /**
     * Utilise un code pour recharger le portefeuille (Front Office)
     */
    public function redeem()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            // 'code' => 'required|is_natural_no_zero',
            'code' => 'required|max_length[50]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $code = $this->request->getPost('code');
        $codeData = $this->codeModel->where('code', $code)->first();

        if (!$codeData) {
            return redirect()->back()->with('error', 'Code invalide');
        }

        if ($codeData['utilise']) {
            return redirect()->back()->with('error', 'Code déjà utilisé');
        }

        // Marquer le code comme utilisé
        $this->codeModel->update($codeData['id'], ['utilise' => true]);

        // Ajouter l'argent au solde de l'utilisateur
        $user = $this->userModel->find($userId);
        $newSolde = $user['solde'] + $codeData['montant'];
        $this->userModel->update($userId, ['solde' => $newSolde]);

        $session->set('solde', $newSolde);

        return redirect()->to('/profile')->with('success', 'Code rédemption valide! ' . $codeData['montant'] . '€ ajoutés à votre portefeuille');
    }
}
