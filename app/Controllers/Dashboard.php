<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CodeModel;
use App\Models\RegimeModel;
use App\Models\ActiviteModel;
use App\Models\GoldModel;
use App\Models\ObjectifModel;
use App\Models\UserObjectifModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $codeModel;
    protected $regimeModel;
    protected $activiteModel;
    protected $goldModel;
    protected $objectifModel;
    protected $userObjectifModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->codeModel = new CodeModel();
        $this->regimeModel = new RegimeModel();
        $this->activiteModel = new ActiviteModel();
        $this->goldModel = new GoldModel();
        $this->objectifModel = new ObjectifModel();
        $this->userObjectifModel = new UserObjectifModel();
    }

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('dashboard/index', $this->buildStatsData());
    }

    public function stats()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('dashboard/stats', $this->buildStatsData());
    }

    public function ajaxStats()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return $this->response->setJSON($this->buildStatsData());
    }

    public function exportPdf()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $data = $this->buildStatsData();
        $pdf = $this->buildPdf($data);

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="dashboard.pdf"')
            ->setBody($pdf);
    }

    private function requireAdmin()
    {
        if (session()->get('roles') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Accès refusé');
        }

        return null;
    }

    private function buildStatsData(): array
    {
        $users = $this->userModel->findAll();
        $codes = $this->codeModel->findAll();
        $goldTransactions = $this->goldModel->findAll();

        $totalUsers = count($users);
        $totalGoldUsers = 0;
        $totalSolde = 0;
        $maleUsers = 0;
        $femaleUsers = 0;
        $imcStats = [
            'underweight' => 0,
            'normal' => 0,
            'overweight' => 0,
            'obese' => 0,
        ];
        $weightsStats = [
            'light' => 0,
            'normal' => 0,
            'heavy' => 0,
            'veryHeavy' => 0,
        ];
        $totalIMC = 0;

        foreach ($users as $user) {
            $totalSolde += (float) $user['solde'];

            if (! empty($user['gold'])) {
                $totalGoldUsers++;
            }

            if (($user['genre'] ?? '') === 'homme') {
                $maleUsers++;
            }

            if (($user['genre'] ?? '') === 'femme') {
                $femaleUsers++;
            }

            $imc = (float) ($user['imc'] ?? 0);
            $poids = (float) ($user['poids'] ?? 0);
            $totalIMC += $imc;

            if ($imc < 18.5) {
                $imcStats['underweight']++;
            } elseif ($imc < 25) {
                $imcStats['normal']++;
            } elseif ($imc < 30) {
                $imcStats['overweight']++;
            } else {
                $imcStats['obese']++;
            }

            if ($poids < 60) {
                $weightsStats['light']++;
            } elseif ($poids < 80) {
                $weightsStats['normal']++;
            } elseif ($poids < 100) {
                $weightsStats['heavy']++;
            } else {
                $weightsStats['veryHeavy']++;
            }
        }

        $totalCodes = count($codes);
        $usedCodes = 0;
        $totalCodesAmount = 0;

        foreach ($codes as $code) {
            $totalCodesAmount += (float) $code['montant'];

            if (! empty($code['utilise'])) {
                $usedCodes++;
            }
        }

        $objectifsData = [];
        foreach ($this->objectifModel->findAll() as $objectif) {
            $objectifsData[] = [
                'nom' => $objectif['nom_objectif'],
                'count' => $this->userObjectifModel->where('id_objectif', $objectif['id'])->countAllResults(),
            ];
        }

        $activitiesPerte = $this->activiteModel->where('types', 'perte_poids')->countAllResults();
        $activitiesPrise = $this->activiteModel->where('types', 'prise_poids')->countAllResults();
        $activitesMaintien = $this->activiteModel->where('types', 'maintien')->countAllResults();

        $totalGoldRevenue = 0;
        foreach ($goldTransactions as $transaction) {
            $totalGoldRevenue += (float) $transaction['montant'];
        }

        $recentUsers = $this->userModel->orderBy('date_inscription', 'DESC')->limit(5)->findAll();
        $goldUsers = $this->userModel->where('gold', true)->orderBy('date_inscription', 'DESC')->limit(5)->findAll();

        return [
            'totalUsers' => $totalUsers,
            'totalGoldUsers' => $totalGoldUsers,
            'totalRegularUsers' => $totalUsers - $totalGoldUsers,
            'totalSolde' => $totalSolde,
            'totalCodes' => $totalCodes,
            'usedCodes' => $usedCodes,
            'availableCodes' => $totalCodes - $usedCodes,
            'totalCodesAmount' => $totalCodesAmount,
            'totalRegimes' => $this->regimeModel->countAllResults(),
            'totalActivites' => $this->activiteModel->countAllResults(),
            'totalObjectifs' => $this->objectifModel->countAllResults(),
            'totalGoldRevenue' => $totalGoldRevenue,
            'totalGoldTransactions' => count($goldTransactions),
            'maleUsers' => $maleUsers,
            'femaleUsers' => $femaleUsers,
            'recentUsers' => $recentUsers,
            'goldUsers' => $goldUsers,
            'activitiesPerte' => $activitiesPerte,
            'activitiesPrise' => $activitiesPrise,
            'activitesMaintien' => $activitesMaintien,
            'imcStats' => $imcStats,
            'averageIMC' => $totalUsers > 0 ? round($totalIMC / $totalUsers, 2) : 0,
            'objectifsData' => $objectifsData,
            'weightsStats' => $weightsStats,
            'chartData' => [
                'gender' => [
                    'male' => $maleUsers,
                    'female' => $femaleUsers,
                ],
                'activities' => [
                    'perte' => $activitiesPerte,
                    'prise' => $activitiesPrise,
                    'maintien' => $activitesMaintien,
                ],
                'imc' => $imcStats,
            ],
        ];
    }

    private function buildPdf(array $data): string
    {
        $lines = [
            'Dashboard admin',
            'Utilisateurs: ' . $data['totalUsers'],
            'Gold: ' . $data['totalGoldUsers'],
            'Codes: ' . $data['usedCodes'] . '/' . $data['totalCodes'],
            'Revenus Gold: ' . number_format($data['totalGoldRevenue'], 2) . ' EUR',
            'Régimes: ' . $data['totalRegimes'],
            'Activites: ' . $data['totalActivites'],
            'Objectifs: ' . $data['totalObjectifs'],
            'Genre: hommes ' . $data['maleUsers'] . ' / femmes ' . $data['femaleUsers'],
            'IMC moyen: ' . number_format($data['averageIMC'], 2),
        ];

        $stream = "BT\n/F1 12 Tf\n50 800 Td\n14 TL\n";

        foreach ($lines as $line) {
            $stream .= '(' . $this->escapePdfText($line) . ") Tj\nT*\n";
        }

        $stream .= "ET";

        $objects = [];
        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[2] = '<< /Type /Pages /Kids [3 0 R] /Count 1 >>';
        $objects[3] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>';
        $objects[4] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';
        $objects[5] = '<< /Length ' . strlen($stream) . ' >>\nstream\n' . $stream . "\nendstream";

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $number => $object) {
            $offsets[$number] = strlen($pdf);
            $pdf .= $number . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xrefPosition = strlen($pdf);
        $pdf .= "xref\n0 6\n";
        $pdf .= sprintf("%010d 65535 f \n", 0);

        for ($i = 1; $i <= 5; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n" . $xrefPosition . "\n%%EOF";

        return $pdf;
    }

    private function escapePdfText(string $text): string
    {
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT', $text);

        if ($converted !== false) {
            $text = $converted;
        }

        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
