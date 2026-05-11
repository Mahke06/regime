<?php

namespace App\Controllers;

use App\Models\ActiviteModel;

class Activite extends BaseController
{
    protected $activiteModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteModel();
    }

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $data = [
            'activites' => $this->activiteModel->findAll()
        ];
        return view('activites/index', $data);
    }

    public function create()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('activites/create');
    }

    public function store()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'types' => 'required|in_list[perte_poids,prise_poids,maintien]',
            'calories_brulees' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->activiteModel->save([
            'nom' => $this->request->getPost('nom'),
            'types' => $this->request->getPost('types'),
            'calories_brulees' => $this->request->getPost('calories_brulees'),
        ]);

        return redirect()->to('/activites')->with('success', 'Activité créée avec succès');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $activite = $this->activiteModel->find($id);
        if (!$activite) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Activité non trouvée');
        }

        $data = ['activite' => $activite];
        return view('activites/edit', $data);
    }

    public function update($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'types' => 'required|in_list[perte_poids,prise_poids,maintien]',
            'calories_brulees' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->activiteModel->update($id, [
            'nom' => $this->request->getPost('nom'),
            'types' => $this->request->getPost('types'),
            'calories_brulees' => $this->request->getPost('calories_brulees'),
        ]);

        return redirect()->to('/activites')->with('success', 'Activité mise à jour avec succès');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $this->activiteModel->delete($id);
        return redirect()->to('/activites')->with('success', 'Activité supprimée avec succès');
    }
}