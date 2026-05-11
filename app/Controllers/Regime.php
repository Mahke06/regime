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

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $regimes = $this->regimeModel->findAll();

        foreach ($regimes as &$regime) {
            $regime['prix'] = $this->regimePrixModel->getRegimePrix($regime['id']);
        }

        $data = ['regimes' => $regimes];
        return view('regimes/index', $data);
    }

    public function create()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('regimes/create');
    }

    public function store()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

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

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Régime non trouvé');
        }

        $data = ['regime' => $regime];
        return view('regimes/edit', $data);
    }

    public function update($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

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

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $this->regimeModel->delete($id);
        return redirect()->to('/regimes')->with('success', 'Régime supprimé avec succès');
    }

    public function managePrices($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

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

    public function addPrice($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (!$this->validate([
            'duree' => 'required|is_natural_no_zero',
            'prix' => 'required|decimal|greater_than[0]',
            'variation_poids' => 'required|decimal',
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
