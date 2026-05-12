<?php
// Générer un fichier Excel (CSV format Excel)
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="TODO_Projet_Regime_' . date('Y-m-d') . '.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

// BOM pour UTF-8 dans Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// En-têtes
$headers = ['Ligne', 'Catégorie', 'Module', 'Nom page', 'Description', 'Type', 'Estimation', 'Temps passé', 'Reste à faire', 'Avancement', 'Qui', 'Status'];
fputcsv($output, $headers, ';');

// Données du tableau
$data = [
    [1, 'Base', 'SQL', 'base_regime.sql', 'Codes)', 'Base', 50, 20, 30, '40,00 %', 'Kenny', '✓'],
    [2, 'Base', 'SQL', 'test_data.sql', 'régimes)', 'Base', 30, 0, 30, '0,00 %', 'Kenny', ''],
    [3, 'Web', 'Auth', 'p2.php', 'Genre)', 'Affichage', 15, 10, 5, '66,67 %', 'Kenny', '✓'],
    [4, 'Web', 'Auth', 'p2.php', 'Formulaire Infos santé (Taille, Poids)', 'Affichage', 10, 0, 10, '0,00 %', 'Kenny', ''],
    [5, 'Web', 'Santé', 'Calcul_IMC.php', 'Calcul et affichage de l\'IMC automatique', 'Fonction', 20, 0, 10, '0,00 %', 'Étudiant 1', ''],
    [6, 'Web', 'Objectifs', 'Choix_Objectif.php', 'Sélection (Prendre/Perdre/IMC Idéal)', 'Code', 30, 0, 30, '0,00 %', 'Kenny', ''],
    [7, 'Web', 'Régimes', 'Suggestion.php', 'selon durée', 'Fonction', 180, 0, 180, '0,00 %', 'Kenny', ''],
    [8, 'Web', 'Paiement', 'Portefeuille.php', 'Gold', 'Code', 181, 0, 181, '0,00 %', 'Kenny', ''],
    [9, 'Web', 'Gold', 'Remise.php', 'Application de la remise 15% sur les prix', 'Fonction', 182, 0, 182, '0,00 %', 'Kenny', ''],
    [10, 'Web', 'Export', 'Export_PDF.php', 'PDF', 'Code', 183, 0, 183, '0,00 %', 'Étudiant 2', ''],
    [11, 'Admin', 'Dashboard', 'Admin_Dash.php', 'Tableau de bord (Statistiques + Graphes)', 'Affichage', 184, 0, 184, '0,00 %', 'Étudiant 2', ''],
    [12, 'Admin', 'CRUD', 'p', 'Volatille)', 'Code', 185, 0, 185, '0,00 %', 'Kenny', ''],
    [13, 'Admin', 'CRUD', 'Gestion_Sports.php', 'CRUD des activités sportives', 'Code', 186, 0, 186, '0,00 %', 'Kenny', ''],
    [14, 'Admin', 'Codes', 'Validation_Code.php', 'portefeuille', 'Code', 187, 0, 187, '0,00 %', 'Étudiant 3', ''],
    [15, 'Admin', 'Paramètres', 'Parametres.php', 'CRUD des paramètres nécessaires', 'Code', 188, 0, 188, '0,00 %', 'Étudiant 3', ''],
    [16, 'Git', 'Livraison', 'Merge Main', 'Fusion des branches et nettoyage final', 'Intégration', 189, 0, 189, '0,00 %', 'Kenny', ''],
];

foreach ($data as $row) {
    fputcsv($output, $row, ';');
}

// Section Équipe
fputcsv($output, [], ';');
fputcsv($output, ['ÉQUIPE DU PROJET'], ';');
fputcsv($output, ['Nom', 'Pourcentage de travail'], ';');
fputcsv($output, ['Kenny', '80%'], ';');
fputcsv($output, ['Ny AINA', '10%'], ';');
fputcsv($output, ['Étudiant 3', '10%'], ';');

// Résumé
fputcsv($output, [], ';');
fputcsv($output, ['RÉSUMÉ'], ';');
fputcsv($output, ['Total tâches', count($data)], ';');
fputcsv($output, ['Estimation totale', array_sum(array_column($data, 5)), 'heures'], ';');
fputcsv($output, ['Temps passé total', array_sum(array_column($data, 6)), 'heures'], ';');
fputcsv($output, ['Reste à faire', array_sum(array_column($data, 7)), 'heures'], ';');

fclose($output);
exit;
