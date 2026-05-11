<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table = 'activite';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'types', 'calories_brulees'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'types' => 'required|in_list[perte_poids,prise_poids,maintien]',
        'calories_brulees' => 'required|is_natural_no_zero',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
