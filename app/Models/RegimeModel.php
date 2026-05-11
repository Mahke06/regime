<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'pourcentage_viande', 'pourcentage_poisson', 'pourcentage_volaille'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'nom' => 'required|min_length[3]',
        'pourcentage_viande' => 'required|is_natural|less_than_equal_to[100]',
        'pourcentage_poisson' => 'required|is_natural|less_than_equal_to[100]',
        'pourcentage_volaille' => 'required|is_natural|less_than_equal_to[100]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
