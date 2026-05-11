<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="badge bg-primary rounded-pill mb-3">Statistiques</span>
                <h2 class="fw-bold mb-2">Statistiques détaillées</h2>
                <p class="text-muted mb-0">Analyse avancée de la plateforme et des profils utilisateurs.</p>
            </div>
            <a href="/dashboard" class="btn btn-outline-dark btn-lg">Retour dashboard</a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h3 class="h5 fw-bold mb-1">Distribution IMC</h3>
                    <p class="text-muted mb-0">Répartition des utilisateurs par catégorie IMC.</p>
                </div>
                <div class="card-body p-4">
                    <div style="height:340px;">
                        <canvas id="imcPie"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h3 class="h5 fw-bold mb-1">Distribution du poids</h3>
                    <p class="text-muted mb-0">Vue synthétique des profils selon le poids.</p>
                </div>
                <div class="card-body p-4">
                    <div style="height:340px;">
                        <canvas id="weightChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h3 class="h5 fw-bold mb-1">Objectifs utilisateurs</h3>
            <p class="text-muted mb-0">Nombre d’utilisateurs par objectif choisi.</p>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Objectif</th>
                            <th class="pe-4">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($objectifsData as $objectif): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= esc($objectif['nom']) ?></td>
                            <td class="pe-4"><?= esc($objectif['count']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('imcPie'), {
    type: 'pie',
    data: {
        labels: ['Insuffisant', 'Normal', 'Surpoids', 'Obèse'],
        datasets: [{
            data: [
                <?= $imcStats['underweight'] ?? 0 ?>,
                <?= $imcStats['normal'] ?? 0 ?>,
                <?= $imcStats['overweight'] ?? 0 ?>,
                <?= $imcStats['obese'] ?? 0 ?>
            ],
            backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

new Chart(document.getElementById('weightChart'), {
    type: 'bar',
    data: {
        labels: ['Léger', 'Normal', 'Lourd', 'Très lourd'],
        datasets: [{
            data: [
                <?= $weightsStats['light'] ?? 0 ?>,
                <?= $weightsStats['normal'] ?? 0 ?>,
                <?= $weightsStats['heavy'] ?? 0 ?>,
                <?= $weightsStats['veryHeavy'] ?? 0 ?>
            ],
            backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});
</script>

<?= $this->endSection() ?>
