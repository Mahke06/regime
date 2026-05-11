<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametreModel extends Model
{
    protected $table = 'parametre';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['cle', 'valeur', 'description'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'cle' => 'required|min_length[2]|max_length[100]',
        'valeur' => 'required|max_length[255]',
        'description' => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getValue(string $key, mixed $default = null): mixed
    {
        $row = $this->where('cle', $key)->first();

        return $row['valeur'] ?? $default;
    }
}
