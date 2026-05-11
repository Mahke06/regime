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

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $data = [
            'objectifs' => $this->objectifModel->findAll()
        ];
        return view('objectifs/index', $data);
    }

    public function create()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('objectifs/create');
    }

    public function store()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

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

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $objectif = $this->objectifModel->find($id);
        if (!$objectif) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Objectif non trouvé');
        }

        $data = ['objectif' => $objectif];
        return view('objectifs/edit', $data);
    }

    public function update($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (!$this->validate([
            'nom_objectif' => 'required|min_length[3]|is_unique[objectif.nom_objectif,id,' . $id . ']',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->objectifModel->update($id, [
            'nom_objectif' => $this->request->getPost('nom_objectif'),
        ]);

        return redirect()->to('/objectifs')->with('success', 'Objectif mis à jour avec succès');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $this->objectifModel->delete($id);
        return redirect()->to('/objectifs')->with('success', 'Objectif supprimé avec succès');
    }

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

    public function removeObjectif($idObjectif)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userObjectif = $this->userObjectifModel
            ->where('id_user', $userId)
            ->where('id_objectif', $idObjectif)
            ->first();

        if (!$userObjectif) {
            return redirect()->back()->with('error', 'Objectif non trouvé');
        }

        $this->userObjectifModel->delete($userObjectif['id']);

        return redirect()->back()->with('success', 'Objectif supprimé');
    }
}