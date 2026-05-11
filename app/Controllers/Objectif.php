<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\UserObjectifModel;

class Objectif extends BaseController
{
    protected $objectifModel;
    protected $userObjectifModel;

    protected const MAX_OBJECTIFS_PER_USER = 3;

    public function __construct()
    {
        $this->objectifModel = new ObjectifModel();
        $this->userObjectifModel = new UserObjectifModel();
    }

    /**
     * Liste tous les objectifs (Back Office)
     */
    public function index()
    {
        $data = [
            'objectifs' => $this->objectifModel->findAll()
        ];
        return view('objectifs/index', $data);
    }

    /**
     * Affiche le formulaire de création (Back Office)
     */
    public function create()
    {
        return view('objectifs/create');
    }

    /**
     * Enregistre un nouvel objectif (Back Office)
     */
    public function store()
    {
        if (!$this->validate([
            'nom_objectif' => 'required|min_length[3]|is_unique[objectif.nom_objectif]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->objectifModel->save([
            'nom_objectif' => $this->request->getPost('nom_objectif'),
        ]);

        return redirect()->to('/objectifs')->with('success', 'Objectif créé avec succès');
    }

    /**
     * Affiche le formulaire d'édition (Back Office)
     */
    public function edit($id)
    {
        $objectif = $this->objectifModel->find($id);
        if (!$objectif) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Objectif non trouvé');
        }

        $data = ['objectif' => $objectif];
        return view('objectifs/edit', $data);
    }

    /**
     * Met à jour un objectif (Back Office)
     */
    public function update($id)
    {
        if (!$this->validate([
            'nom_objectif' => 'required|min_length[3]|is_unique[objectif.nom_objectif,id,{id}]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->objectifModel->update($id, [
            'nom_objectif' => $this->request->getPost('nom_objectif'),
        ]);

        return redirect()->to('/objectifs')->with('success', 'Objectif mis à jour avec succès');
    }

    /**
     * Supprime un objectif (Back Office)
     */
    public function delete($id)
    {
        $this->objectifModel->delete($id);
        return redirect()->to('/objectifs')->with('success', 'Objectif supprimé avec succès');
    }

    /**
     * Affiche les objectifs disponibles pour la sélection (Front Office)
     */
    public function chooseObjectifs()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userObjectifs = $this->userObjectifModel->getUserObjectifs($userId);
        $allObjectifs = $this->objectifModel->findAll();

        $data = [
            'allObjectifs' => $allObjectifs,
            'userObjectifs' => $userObjectifs,
            'maxObjectifs' => self::MAX_OBJECTIFS_PER_USER
        ];

        return view('objectifs/choose', $data);
    }

    /**
     * Ajoute un objectif à l'utilisateur (Front Office)
     */
    public function addObjectif()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'id_objectif' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->with('error', 'Objectif invalide');
        }

        $idObjectif = $this->request->getPost('id_objectif');
        $countObjectifs = $this->userObjectifModel->countUserObjectifs($userId);

        if ($countObjectifs >= self::MAX_OBJECTIFS_PER_USER) {
            return redirect()->back()->with('error', 'Vous ne pouvez avoir que ' . self::MAX_OBJECTIFS_PER_USER . ' objectifs');
        }

        // Vérifier si l'objectif n'est pas déjà choisi
        $existing = $this->userObjectifModel
            ->where('id_user', $userId)
            ->where('id_objectif', $idObjectif)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Vous avez déjà choisi cet objectif');
        }

        $this->userObjectifModel->save([
            'id_user' => $userId,
            'id_objectif' => $idObjectif,
        ]);

        return redirect()->back()->with('success', 'Objectif ajouté avec succès');
    }

    /**
     * Supprime un objectif de l'utilisateur (Front Office)
     */
    public function removeObjectif($id)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userObjectif = $this->userObjectifModel->find($id);
        
        if (!$userObjectif || $userObjectif['id_user'] != $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Objectif non trouvé');
        }

        $this->userObjectifModel->delete($id);

        return redirect()->back()->with('success', 'Objectif supprimé');
    }
}