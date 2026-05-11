<?php

namespace App\Controllers;

use App\Models\ParametreModel;

class Parametre extends BaseController
{
    protected $parametreModel;

    public function __construct()
    {
        $this->parametreModel = new ParametreModel();
    }

    private function isAdmin()
    {
        if (session()->get('roles') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Accès refusé');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        $data = [
            'parametres' => $this->parametreModel->orderBy('cle', 'ASC')->findAll(),
        ];

        return view('parametres/index', $data);
    }

    public function create()
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        return view('parametres/create');
    }

    public function store()
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        if (! $this->validate([
            'cle' => 'required|min_length[2]|max_length[100]',
            'valeur' => 'required|max_length[255]',
            'description' => 'permit_empty|max_length[255]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->parametreModel->save([
            'cle' => $this->request->getPost('cle'),
            'valeur' => $this->request->getPost('valeur'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/parametres')->with('success', 'Paramètre ajouté');
    }

    public function edit($id)
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        $parametre = $this->parametreModel->find($id);

        if (! $parametre) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Paramètre non trouvé');
        }

        return view('parametres/edit', ['parametre' => $parametre]);
    }

    public function update($id)
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        if (! $this->validate([
            'cle' => 'required|min_length[2]|max_length[100]',
            'valeur' => 'required|max_length[255]',
            'description' => 'permit_empty|max_length[255]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->parametreModel->update($id, [
            'cle' => $this->request->getPost('cle'),
            'valeur' => $this->request->getPost('valeur'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/parametres')->with('success', 'Paramètre modifié');
    }

    public function delete($id)
    {
        if ($redirect = $this->isAdmin()) {
            return $redirect;
        }

        $this->parametreModel->delete($id);

        return redirect()->to('/parametres')->with('success', 'Paramètre supprimé');
    }
}
