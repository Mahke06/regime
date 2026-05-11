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

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $data = [
            'codes' => $this->codeModel->findAll()
        ];
        return view('codes/index', $data);
    }

    public function create()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('codes/create');
    }

    public function store()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

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

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $code = $this->codeModel->find($id);
        if (!$code) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Code non trouvé');
        }

        $data = ['code' => $code];
        return view('codes/edit', $data);
    }

    public function update($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (!$this->validate([
            'code' => 'required|is_natural_no_zero|is_unique[code.code,id,' . $id . ']',
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

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $this->codeModel->delete($id);
        return redirect()->to('/codes')->with('success', 'Code supprimé avec succès');
    }

    public function redeem()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
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

        $this->codeModel->update($codeData['id'], ['utilise' => true]);

        $user = $this->userModel->find($userId);
        $newSolde = $user['solde'] + $codeData['montant'];
        $this->userModel->update($userId, ['solde' => $newSolde]);

        $session->set('solde', $newSolde);

        return redirect()->to('/profile')->with('success', 'Code rédemption valide! ' . $codeData['montant'] . '€ ajoutés à votre portefeuille');
    }
}
