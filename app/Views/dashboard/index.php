<?php echo view('layout'); ?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Tableau de Bord Admin</h1>
            <p class="text-muted">Bienvenue dans l'administration de la plateforme Régime</p>
        </div>
    </div>

    <!-- Statistiques Principales -->
    <div class="row mb-4">
        <!-- Utilisateurs Totaux -->
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs Totaux</h5>
                    <h2><?php echo $totalUsers; ?></h2>
                </div>
            </div>
        </div>

        <!-- Utilisateurs Gold -->
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs Gold</h5>
                    <h2><?php echo $totalGoldUsers; ?></h2>
                    <small><?php echo $totalRegularUsers; ?> réguliers</small>
                </div>
            </div>
        </div>

        <!-- Codes Disponibles -->
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Codes Promo</h5>
                    <h2><?php echo $availableCodes; ?>/<?php echo $totalCodes; ?></h2>
                    <small><?php echo $usedCodes; ?> utilisés</small>
                </div>
            </div>
        </div>

        <!-- Revenus Gold -->
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Revenus Gold</h5>
                    <h2><?php echo number_format($totalGoldRevenue, 2); ?> €</h2>
                    <small><?php echo $totalGoldTransactions; ?> transactions</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Solde Total -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Solde Total</h5>
                    <h2><?php echo number_format($totalSolde, 2); ?> €</h2>
                    <small class="text-muted">En circulation</small>
                </div>
            </div>
        </div>

        <!-- Montant Codes -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Montant Codes</h5>
                    <h2><?php echo number_format($totalCodesAmount, 2); ?> €</h2>
                    <small class="text-muted">Valeur générée</small>
                </div>
            </div>
        </div>

        <!-- Régimes -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Régimes</h5>
                    <h2><?php echo $totalRegimes; ?></h2>
                    <small class="text-muted">Régimes disponibles</small>
                </div>
            </div>
        </div>

        <!-- Activités -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Activités</h5>
                    <h2><?php echo $totalActivites; ?></h2>
                    <small class="text-muted">Sports proposés</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Genre & Activités -->
    <div class="row mb-4">
        <!-- Genre Distribution -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribution Genre</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Hommes</td>
                            <td><strong><?php echo $maleUsers; ?></strong></td>
                            <td><?php echo round(($maleUsers / $totalUsers) * 100, 1); ?>%</td>
                        </tr>
                        <tr>
                            <td>Femmes</td>
                            <td><strong><?php echo $femaleUsers; ?></strong></td>
                            <td><?php echo round(($femaleUsers / $totalUsers) * 100, 1); ?>%</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activités Distribution -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribution Activités</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Perte de Poids</td>
                            <td><strong><?php echo $activitiesPerte; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Prise de Poids</td>
                            <td><strong><?php echo $activitiesPrise; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Maintien</td>
                            <td><strong><?php echo $activitesMaintien; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Utilisateurs Récents & Gold -->
    <div class="row mb-4">
        <!-- Utilisateurs Récents -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Utilisateurs Récents</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($user['date_inscription'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Utilisateurs Gold -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Utilisateurs Gold</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Solde</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($goldUsers as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo number_format($user['solde'], 2); ?> €</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liens de Gestion -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Gestion</h5>
                </div>
                <div class="card-body">
                    <div class="btn-group" role="group">
                        <a href="/users" class="btn btn-outline-primary">Gérer Utilisateurs</a>
                        <a href="/codes" class="btn btn-outline-success">Gérer Codes</a>
                        <a href="/regimes" class="btn btn-outline-info">Gérer Régimes</a>
                        <a href="/activites" class="btn btn-outline-warning">Gérer Activités</a>
                        <a href="/objectifs" class="btn btn-outline-danger">Gérer Objectifs</a>
                        <a href="/parametres" class="btn btn-outline-dark">Paramètres</a>
                        <a href="/dashboard/stats" class="btn btn-outline-secondary">Statistiques Détaillées</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Graphiques rapides</h5>
                    <div class="d-flex gap-2">
                        <a href="/dashboard/export-pdf" class="btn btn-sm btn-outline-dark">Exporter PDF</a>
                        <button type="button" id="refresh-dashboard" class="btn btn-sm btn-primary">Actualiser</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h6>Genre</h6>
                            <div class="d-flex justify-content-between">
                                <span>Hommes</span>
                                <span id="male-count"><?php echo $maleUsers; ?></span>
                            </div>
                            <div class="progress mb-2" style="height: 18px;">
                                <div id="male-bar" class="progress-bar bg-primary" style="width: <?php echo $totalUsers > 0 ? round(($maleUsers / $totalUsers) * 100) : 0; ?>%;"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Femmes</span>
                                <span id="female-count"><?php echo $femaleUsers; ?></span>
                            </div>
                            <div class="progress" style="height: 18px;">
                                <div id="female-bar" class="progress-bar bg-danger" style="width: <?php echo $totalUsers > 0 ? round(($femaleUsers / $totalUsers) * 100) : 0; ?>%;"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Activités</h6>
                            <div class="d-flex justify-content-between">
                                <span>Perte</span>
                                <span id="activity-loss-count"><?php echo $activitiesPerte; ?></span>
                            </div>
                            <div class="progress mb-2" style="height: 18px;">
                                <div id="activity-loss-bar" class="progress-bar bg-success" style="width: <?php echo $totalActivites > 0 ? round(($activitiesPerte / $totalActivites) * 100) : 0; ?>%;"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Prise</span>
                                <span id="activity-gain-count"><?php echo $activitiesPrise; ?></span>
                            </div>
                            <div class="progress mb-2" style="height: 18px;">
                                <div id="activity-gain-bar" class="progress-bar bg-warning" style="width: <?php echo $totalActivites > 0 ? round(($activitiesPrise / $totalActivites) * 100) : 0; ?>%;"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Maintien</span>
                                <span id="activity-maintain-count"><?php echo $activitesMaintien; ?></span>
                            </div>
                            <div class="progress" style="height: 18px;">
                                <div id="activity-maintain-bar" class="progress-bar bg-info" style="width: <?php echo $totalActivites > 0 ? round(($activitesMaintien / $totalActivites) * 100) : 0; ?>%;"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>IMC</h6>
                            <div class="d-flex justify-content-between">
                                <span>Normal</span>
                                <span id="imc-normal-count"><?php echo $imcStats['normal'] ?? 0; ?></span>
                            </div>
                            <div class="progress mb-2" style="height: 18px;">
                                <div id="imc-normal-bar" class="progress-bar bg-success" style="width: <?php echo $totalUsers > 0 ? round((($imcStats['normal'] ?? 0) / $totalUsers) * 100) : 0; ?>%;"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Surpoids</span>
                                <span id="imc-overweight-count"><?php echo $imcStats['overweight'] ?? 0; ?></span>
                            </div>
                            <div class="progress mb-2" style="height: 18px;">
                                <div id="imc-overweight-bar" class="progress-bar bg-warning" style="width: <?php echo $totalUsers > 0 ? round((($imcStats['overweight'] ?? 0) / $totalUsers) * 100) : 0; ?>%;"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Obésité</span>
                                <span id="imc-obese-count"><?php echo $imcStats['obese'] ?? 0; ?></span>
                            </div>
                            <div class="progress" style="height: 18px;">
                                <div id="imc-obese-bar" class="progress-bar bg-danger" style="width: <?php echo $totalUsers > 0 ? round((($imcStats['obese'] ?? 0) / $totalUsers) * 100) : 0; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var button = document.getElementById('refresh-dashboard');

    if (!button) {
        return;
    }

    function setBar(barId, value, total) {
        var element = document.getElementById(barId);

        if (!element) {
            return;
        }

        var percent = total > 0 ? Math.round((value / total) * 100) : 0;
        element.style.width = percent + '%';
    }

    function setText(id, value) {
        var element = document.getElementById(id);

        if (element) {
            element.textContent = value;
        }
    }

    function refreshStats() {
        fetch('/dashboard/ajax-stats')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                var totalUsers = data.totalUsers || 0;
                var totalActivites = data.totalActivites || 0;

                setText('male-count', data.maleUsers || 0);
                setText('female-count', data.femaleUsers || 0);
                setText('activity-loss-count', data.activitiesPerte || 0);
                setText('activity-gain-count', data.activitiesPrise || 0);
                setText('activity-maintain-count', data.activitesMaintien || 0);
                setText('imc-normal-count', data.imcStats ? data.imcStats.normal : 0);
                setText('imc-overweight-count', data.imcStats ? data.imcStats.overweight : 0);
                setText('imc-obese-count', data.imcStats ? data.imcStats.obese : 0);

                setBar('male-bar', data.maleUsers || 0, totalUsers);
                setBar('female-bar', data.femaleUsers || 0, totalUsers);
                setBar('activity-loss-bar', data.activitiesPerte || 0, totalActivites);
                setBar('activity-gain-bar', data.activitiesPrise || 0, totalActivites);
                setBar('activity-maintain-bar', data.activitesMaintien || 0, totalActivites);
                setBar('imc-normal-bar', data.imcStats ? data.imcStats.normal : 0, totalUsers);
                setBar('imc-overweight-bar', data.imcStats ? data.imcStats.overweight : 0, totalUsers);
                setBar('imc-obese-bar', data.imcStats ? data.imcStats.obese : 0, totalUsers);
            });
    }

    button.addEventListener('click', refreshStats);
    refreshStats();
});
</script>
