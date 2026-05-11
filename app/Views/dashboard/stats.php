<?php echo view('layout'); ?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Statistiques Détaillées</h1>
            <a href="/dashboard" class="btn btn-secondary">Retour au Tableau de Bord</a>
            <a href="/dashboard/export-pdf" class="btn btn-dark">Télécharger PDF</a>
        </div>
    </div>

    <!-- Distribution IMC -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribution IMC</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Nombre</th>
                                <th>Pourcentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-success">Poids insuffisant</span> (IMC < 18.5)</td>
                                <td><strong><?php echo $imcStats['underweight']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($imcStats['underweight'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info">Poids normal</span> (18.5 - 24.9)</td>
                                <td><strong><?php echo $imcStats['normal']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($imcStats['normal'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning">Surpoids</span> (25 - 29.9)</td>
                                <td><strong><?php echo $imcStats['overweight']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($imcStats['overweight'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-danger">Obésité</span> (IMC ≥ 30)</td>
                                <td><strong><?php echo $imcStats['obese']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($imcStats['obese'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <p class="mb-0"><strong>IMC Moyen : </strong><?php echo $averageIMC; ?></p>
                </div>
            </div>
        </div>

        <!-- Distribution Poids -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribution Poids</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Nombre</th>
                                <th>Pourcentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Léger (&lt; 60 kg)</td>
                                <td><strong><?php echo $weightsStats['light']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($weightsStats['light'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td>Normal (60 - 80 kg)</td>
                                <td><strong><?php echo $weightsStats['normal']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($weightsStats['normal'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td>Lourd (80 - 100 kg)</td>
                                <td><strong><?php echo $weightsStats['heavy']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($weightsStats['heavy'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                            <tr>
                                <td>Très Lourd (≥ 100 kg)</td>
                                <td><strong><?php echo $weightsStats['veryHeavy']; ?></strong></td>
                                <td><?php echo $totalUsers > 0 ? round(($weightsStats['veryHeavy'] / $totalUsers) * 100, 1) : 0; ?>%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribution Objectifs -->
    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribution Objectifs</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Objectif</th>
                                    <th>Nombre d'utilisateurs</th>
                                    <th>Pourcentage</th>
                                    <th>Barre de progression</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalObjectifCounts = 0;
                                    foreach ($objectifsData as $obj) {
                                        $totalObjectifCounts += $obj['count'];
                                    }
                                ?>
                                <?php foreach ($objectifsData as $objectif): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($objectif['nom']); ?></td>
                                        <td><strong><?php echo $objectif['count']; ?></strong></td>
                                        <td><?php echo $totalObjectifCounts > 0 ? round(($objectif['count'] / $totalObjectifCounts) * 100, 1) : 0; ?>%</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: <?php echo $totalObjectifCounts > 0 ? round(($objectif['count'] / $totalObjectifCounts) * 100) : 0; ?>%"
                                                     aria-valuenow="<?php echo $totalObjectifCounts > 0 ? round(($objectif['count'] / $totalObjectifCounts) * 100) : 0; ?>" 
                                                     aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Graphique IMC</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">Poids insuffisant</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-success" style="width: <?php echo $totalUsers > 0 ? round(($imcStats['underweight'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Poids normal</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-info" style="width: <?php echo $totalUsers > 0 ? round(($imcStats['normal'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Surpoids</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo $totalUsers > 0 ? round(($imcStats['overweight'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Obésité</div>
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar bg-danger" style="width: <?php echo $totalUsers > 0 ? round(($imcStats['obese'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Graphique Poids</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">Léger</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-success" style="width: <?php echo $totalUsers > 0 ? round(($weightsStats['light'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Normal</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-info" style="width: <?php echo $totalUsers > 0 ? round(($weightsStats['normal'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Lourd</div>
                    <div class="progress mb-3" style="height: 18px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo $totalUsers > 0 ? round(($weightsStats['heavy'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                    <div class="mb-2">Très lourd</div>
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar bg-danger" style="width: <?php echo $totalUsers > 0 ? round(($weightsStats['veryHeavy'] / $totalUsers) * 100) : 0; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques Supplémentaires -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Résumé Utilisateurs</h5>
                </div>
                <div class="card-body">
                    <p><strong>Total Utilisateurs : </strong> <?php echo $totalUsers; ?></p>
                    <p><strong>Utilisateurs avec objectifs : </strong> 
                        <?php 
                            $usersWithObjectifs = 0;
                            foreach ($objectifsData as $obj) {
                                $usersWithObjectifs += $obj['count'];
                            }
                            // Approx (peut avoir des utilisateurs avec plusieurs objectifs)
                            echo floor($usersWithObjectifs / 3);
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recommandations</h5>
                </div>
                <div class="card-body">
                    <?php if ($imcStats['obese'] > $totalUsers * 0.2): ?>
                        <div class="alert alert-warning mb-2">
                            <strong>⚠️ Attention :</strong> Plus de 20% des utilisateurs sont obèses
                        </div>
                    <?php endif; ?>
                    <?php if ($imcStats['underweight'] > $totalUsers * 0.15): ?>
                        <div class="alert alert-info mb-2">
                            <strong>ℹ️ Info :</strong> Plus de 15% des utilisateurs sont en poids insuffisant
                        </div>
                    <?php endif; ?>
                    <?php if ($imcStats['normal'] < $totalUsers * 0.4): ?>
                        <div class="alert alert-info">
                            <strong>ℹ️ Info :</strong> Moins de 40% des utilisateurs ont un poids normal
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
