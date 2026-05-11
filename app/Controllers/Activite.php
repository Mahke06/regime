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

    /**
     * Liste toutes les activités
     */
    public function index()
    {
        $data = [
            'activites' => $this->activiteModel->findAll()
        ];
        return view('activites/index', $data);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('activites/create');
    }

    /**
     * Enregistre une nouvelle activité
     */
    public function store()
    {
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

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $activite = $this->activiteModel->find($id);
        if (!$activite) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Activité non trouvée');
        }

        $data = ['activite' => $activite];
        return view('activites/edit', $data);
    }

    /**
     * Met à jour une activité
     */
    public function update($id)
    {
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

    /**
     * Supprime une activité
     */
    public function delete($id)
    {
        $this->activiteModel->delete($id);
        return redirect()->to('/activites')->with('success', 'Activité supprimée avec succès');
    }
}