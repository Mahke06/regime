<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimePrixModel extends Model
{
    protected $table = 'regime_prix';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_regime', 'duree', 'prix', 'variation_poids'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'id_regime' => 'required|is_natural_no_zero',
        'duree' => 'required|is_natural_no_zero',
        'prix' => 'required|is_natural_no_zero',
        'variation_poids' => 'required|is_natural',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function getRegimePrix($idRegime)
    {
        return $this->where('id_regime', $idRegime)
            ->orderBy('duree', 'ASC')
            ->findAll();
    }

    public function getPrixByDuree($idRegime, $duree)
    {
        return $this->where('id_regime', $idRegime)
            ->where('duree', $duree)
            ->first();
    }

    public function getPrixWithGoldDiscount($prix)
    {
        return $prix * 0.85;
    }
}
