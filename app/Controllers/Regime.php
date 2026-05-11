<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\RegimePrixModel;

class Regime extends BaseController
{
    protected $regimeModel;
    protected $regimePrixModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->regimePrixModel = new RegimePrixModel();
    }

    /**
     * Liste tous les régimes
     */
    public function index()
    {
        $regimes = $this->regimeModel->findAll();
        
        // Ajouter les prix pour chaque régime
        foreach ($regimes as &$regime) {
            $regime['prix'] = $this->regimePrixModel->getRegimePrix($regime['id']);
        }

        $data = ['regimes' => $regimes];
        return view('regimes/index', $data);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('regimes/create');
    }

    /**
     * Enregistre un nouveau régime
     */
    public function store()
    {
        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'pourcentage_viande' => 'required|is_natural|less_than_equal_to[100]',
            'pourcentage_poisson' => 'required|is_natural|less_than_equal_to[100]',
            'pourcentage_volaille' => 'required|is_natural|less_than_equal_to[100]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->regimeModel->save([
            'nom' => $this->request->getPost('nom'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
        ]);

        return redirect()->to('/regimes')->with('success', 'Régime créé avec succès');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Régime non trouvé');
        }

        $data = ['regime' => $regime];
        return view('regimes/edit', $data);
    }

    /**
     * Met à jour un régime
     */
    public function update($id)
    {
        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'pourcentage_viande' => 'required|is_natural|less_than_equal_to[100]',
            'pourcentage_poisson' => 'required|is_natural|less_than_equal_to[100]',
            'pourcentage_volaille' => 'required|is_natural|less_than_equal_to[100]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->regimeModel->update($id, [
            'nom' => $this->request->getPost('nom'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
        ]);

        return redirect()->to('/regimes')->with('success', 'Régime mis à jour avec succès');
    }

    /**
     * Supprime un régime
     */
    public function delete($id)
    {
        $this->regimeModel->delete($id);
        return redirect()->to('/regimes')->with('success', 'Régime supprimé avec succès');
    }

    /**
     * Gère les prix d'un régime
     */
    public function managePrices($id)
    {
        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Régime non trouvé');
        }

        $data = [
            'regime' => $regime,
            'prix' => $this->regimePrixModel->getRegimePrix($id)
        ];
        return view('regimes/manage_prices', $data);
    }

    /**
     * Ajoute un prix à un régime
     */
    public function addPrice($id)
    {
        if (!$this->validate([
            'duree' => 'required|is_natural_no_zero',
            'prix' => 'required|is_natural_no_zero',
            'variation_poids' => 'required|is_natural',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->regimePrixModel->save([
            'id_regime' => $id,
            'duree' => $this->request->getPost('duree'),
            'prix' => $this->request->getPost('prix'),
            'variation_poids' => $this->request->getPost('variation_poids'),
        ]);

        return redirect()->to('/regimes/manage-prices/' . $id)->with('success', 'Prix ajouté avec succès');
    }
}
