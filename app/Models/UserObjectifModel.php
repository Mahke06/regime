<?php

namespace App\Models;

use CodeIgniter\Model;

class UserObjectifModel extends Model
{
    protected $table = 'user_objectif';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_user', 'id_objectif'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'id_user' => 'required|is_natural_no_zero',
        'id_objectif' => 'required|is_natural_no_zero',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Récupère les objectifs d'un utilisateur
     */
    public function getUserObjectifs($idUser)
    {
        return $this->select('objectif.*')
            ->join('objectif', 'objectif.id = user_objectif.id_objectif')
            ->where('user_objectif.id_user', $idUser)
            ->findAll();
    }

    /**
     * Compte les objectifs d'un utilisateur
     */
    public function countUserObjectifs($idUser)
    {
        return $this->where('id_user', $idUser)->countAllResults();
    }
}
