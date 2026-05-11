<?php

namespace App\Controllers;

use App\Models\GoldModel;
use App\Models\UserModel;
use App\Models\ParametreModel;

class Gold extends BaseController
{
    protected $goldModel;
    protected $userModel;
    protected $parametreModel;

    protected const GOLD_PRICE = 9.99;
    protected const GOLD_DISCOUNT = 15;

    public function __construct()
    {
        $this->goldModel = new GoldModel();
        $this->userModel = new UserModel();
        $this->parametreModel = new ParametreModel();
    }

    /**
     * Affiche la page d'activation Gold
     */
    public function activate()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);

        if ($user['gold']) {
            return redirect()->to('/profile')->with('info', 'Vous avez déjà l\'abonnement Gold');
        }

        $data = [
            'user' => $user,
            'price' => $this->getGoldPrice(),
            'discount' => $this->getGoldDiscount()
        ];

        return view('gold/activate', $data);
    }

    /**
     * Traite le paiement Gold
     */
    public function purchase()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);

        // Vérifier si l'utilisateur a déjà Gold
        if ($user['gold']) {
            return redirect()->to('/profile')->with('error', 'Vous avez déjà l\'abonnement Gold');
        }

        // Vérifier le solde
        $price = $this->getGoldPrice();

        if ($user['solde'] < $price) {
            return redirect()->back()->with('error', 'Solde insuffisant. Veuillez recharger votre portefeuille');
        }

        // Enregistrer le paiement
        $this->goldModel->save([
            'id_utilisateur' => $userId,
            'montant' => $price,
        ]);

        // Déduire du solde et activer Gold
        $newSolde = $user['solde'] - $price;
        $this->userModel->update($userId, [
            'solde' => $newSolde,
            'gold' => true
        ]);

        $session->set('gold', true);
        $session->set('solde', $newSolde);

        return redirect()->to('/profile')->with('success', 'Félicitations! Vous avez activé l\'abonnement Gold. Bénéficiez de 15% de remise sur tous les régimes!');
    }

    /**
     * Liste les paiements Gold (Back Office Admin)
     */
    public function index()
    {
        $data = [
            'paiements' => $this->goldModel
                ->select('paiement_gold.*, user.nom, user.email')
                ->join('user', 'user.id = paiement_gold.id_utilisateur')
                ->findAll()
        ];
        return view('gold/index', $data);
    }

    /**
     * Retourne le prix Gold
     */
    public static function getPrice()
    {
        return self::GOLD_PRICE;
    }

    /**
     * Retourne le pourcentage de remise
     */
    public static function getDiscount()
    {
        return self::GOLD_DISCOUNT;
    }

    private function getGoldPrice()
    {
        $value = $this->parametreModel->getValue('gold_price', self::GOLD_PRICE);

        return (float) $value;
    }

    private function getGoldDiscount()
    {
        $value = $this->parametreModel->getValue('gold_discount', self::GOLD_DISCOUNT);

        return (float) $value;
    }
}
