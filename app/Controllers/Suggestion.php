<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\ActiviteModel;
use App\Models\RegimePrixModel;
use App\Models\UserModel;
use App\Models\UserObjectifModel;

class Suggestion extends BaseController
{
    protected $regimeModel;
    protected $activiteModel;
    protected $regimePrixModel;
    protected $userModel;
    protected $userObjectifModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->activiteModel = new ActiviteModel();
        $this->regimePrixModel = new RegimePrixModel();
        $this->userModel = new UserModel();
        $this->userObjectifModel = new UserObjectifModel();
    }

    /**
     * Affiche les suggestions de régimes et activités basées sur les objectifs de l'utilisateur
     */
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);
        $userObjectifs = $this->userObjectifModel->getUserObjectifs($userId);

        // Si l'utilisateur n'a pas d'objectif, le rediriger
        if (empty($userObjectifs)) {
            return redirect()->to('/objectifs/choose')->with('info', 'Veuillez d\'abord choisir vos objectifs');
        }

        // Déterminer le type d'activité basé sur les objectifs
        $activiteTypes = $this->getActiviteTypesByObjectifs($userObjectifs);

        // Récupérer les activités correspondantes
        $suggestedActivites = [];
        foreach ($activiteTypes as $type) {
            $activites = $this->activiteModel
                ->where('types', $type)
                ->findAll();
            $suggestedActivites = array_merge($suggestedActivites, $activites);
        }

        // Récupérer tous les régimes avec leurs prix
        $suggestedRegimes = $this->regimeModel->findAll();
        foreach ($suggestedRegimes as &$regime) {
            $regime['prix'] = $this->regimePrixModel->getRegimePrix($regime['id']);
        }

        // Appliquer la remise Gold si l'utilisateur l'a activé
        $goldDiscount = $user['gold'] ? 0.85 : 1; // 15% de remise

        $data = [
            'user' => $user,
            'userObjectifs' => $userObjectifs,
            'suggestedActivites' => $suggestedActivites,
            'suggestedRegimes' => $suggestedRegimes,
            'goldDiscount' => $goldDiscount,
        ];

        return view('suggestions/index', $data);
    }

    /**
     * Détermine les types d'activités recommandées basées sur les objectifs
     */
    private function getActiviteTypesByObjectifs($objectifs)
    {
        $types = [];

        foreach ($objectifs as $objectif) {
            $nomObjectif = strtolower($objectif['nom_objectif']);

            if (strpos($nomObjectif, 'perdre') !== false || strpos($nomObjectif, 'perte') !== false) {
                $types[] = 'perte_poids';
            } elseif (strpos($nomObjectif, 'prendre') !== false || strpos($nomObjectif, 'prise') !== false) {
                $types[] = 'prise_poids';
            } elseif (strpos($nomObjectif, 'imc') !== false || strpos($nomObjectif, 'ideal') !== false) {
                $types[] = 'maintien';
            }
        }

        // Supprimer les doublons
        return array_unique($types);
    }

    /**
     * Affiche les détails d'un régime spécifique avec ses variantes de prix
     */
    public function showRegimeDetails($id)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Régime non trouvé');
        }

        $user = $this->userModel->find($userId);
        $prices = $this->regimePrixModel->getRegimePrix($id);
        $userObjectifs = $this->userObjectifModel->getUserObjectifs($userId);

        // Appliquer la remise Gold
        $goldDiscount = $user['gold'] ? 0.85 : 1;

        $data = [
            'regime' => $regime,
            'prices' => $prices,
            'user' => $user,
            'userObjectifs' => $userObjectifs,
            'goldDiscount' => $goldDiscount,
        ];

        return view('suggestions/regime_details', $data);
    }

    /**
     * Affiche les détails d'une activité spécifique
     */
    public function showActiviteDetails($id)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $activite = $this->activiteModel->find($id);
        if (!$activite) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Activité non trouvée');
        }

        $user = $this->userModel->find($userId);
        $userObjectifs = $this->userObjectifModel->getUserObjectifs($userId);

        $data = [
            'activite' => $activite,
            'user' => $user,
            'userObjectifs' => $userObjectifs,
        ];

        return view('suggestions/activite_details', $data);
    }

    /**
     * Affiche un formulaire d'achat pour un régime + durée
     */
    public function purchaseRegime($regimeId)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $regime = $this->regimeModel->find($regimeId);
        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Régime non trouvé');
        }

        $user = $this->userModel->find($userId);
        $prices = $this->regimePrixModel->getRegimePrix($regimeId);
        $goldDiscount = $user['gold'] ? 0.85 : 1;

        $data = [
            'regime' => $regime,
            'prices' => $prices,
            'user' => $user,
            'goldDiscount' => $goldDiscount,
        ];

        return view('suggestions/purchase_regime', $data);
    }

    /**
     * Traite l'achat d'un régime
     */
    public function confirmPurchase()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'regime_id' => 'required|is_natural_no_zero',
            'price_id' => 'required|is_natural_no_zero',
        ])) {
            return redirect()->back()->with('error', 'Données invalides');
        }

        $regimeId = $this->request->getPost('regime_id');
        $priceId = $this->request->getPost('price_id');

        $regime = $this->regimeModel->find($regimeId);
        $regimePrice = $this->regimePrixModel->find($priceId);

        if (!$regime || !$regimePrice) {
            return redirect()->back()->with('error', 'Régime ou prix non trouvé');
        }

        $user = $this->userModel->find($userId);
        $finalPrice = $regimePrice['prix'];

        // Appliquer la remise Gold
        if ($user['gold']) {
            $finalPrice = $finalPrice * 0.85;
        }

        // Vérifier le solde
        if ($user['solde'] < $finalPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant. Veuillez recharger votre portefeuille');
        }

        // Déduire du solde
        $newSolde = $user['solde'] - $finalPrice;
        $this->userModel->update($userId, ['solde' => $newSolde]);
        $session->set('solde', $newSolde);

        return redirect()->to('/suggestions')->with('success', 
            'Régime "' . $regime['nom'] . '" acheté pour ' . number_format($finalPrice, 2) . '€! Durée: ' . $regimePrice['duree'] . ' jours'
        );
    }
}
