<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'email', 'mot_de_passe', 'genre', 'roles', 'taille', 'poids', 'imc', 'solde', 'gold'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[user.email]|max_length[100]',
        'mot_de_passe' => 'required|min_length[6]|max_length[100]',
        'genre' => 'required|in_list[homme,femme]',
        'roles' => 'in_list[admin,user]',
        'taille' => 'decimal',
        'poids' => 'decimal',
        'imc' => 'decimal',
        'solde' => 'decimal',
        'gold' => 'in_list[0,1]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email deja utilise',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}