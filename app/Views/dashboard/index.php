<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="dashboard-panel mb-4">
        <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="badge bg-dark rounded-pill mb-3">Administration</span>
                <h2 class="fw-bold mb-2">Dashboard admin</h2>
                <p class="text-muted mb-0">Vue globale de la plateforme et indicateurs principaux.</p>
            </div>
            <a href="/dashboard/stats" class="btn btn-primary btn-lg">Voir statistiques</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card rounded-4 bg-primary text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="opacity-75">Utilisateurs</span>
                        <i class="bi bi-people-fill fs-3 opacity-50"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $totalUsers ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-4 bg-success text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="opacity-75">Revenus Gold</span>
                        <i class="bi bi-gem fs-3 opacity-50"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= number_format($totalGoldRevenue, 2) ?> €</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-4 bg-warning text-dark h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="opacity-75">Codes Promo</span>
                        <i class="bi bi-ticket-perforated fs-3 opacity-50"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $availableCodes ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-4 bg-danger text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="opacity-75">Utilisateurs Gold</span>
                        <i class="bi bi-star-fill fs-3 opacity-50"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $totalGoldUsers ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h3 class="h5 fw-bold mb-1">Répartition par genre</h3>
                    <p class="text-muted mb-0">Vue comparative des inscriptions.</p>
                </div>
                <div class="card-body p-4">
                    <div style="height:300px;">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h3 class="h5 fw-bold mb-1">Répartition IMC</h3>
                    <p class="text-muted mb-0">Tendance globale des profils utilisateurs.</p>
                </div>
                <div class="card-body p-4">
                    <div style="height:300px;">
                        <canvas id="imcChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('genderChart'), {
    type: 'doughnut',
    data: {
        labels: ['Hommes', 'Femmes'],
        datasets: [{
            data: [
                <?= $maleUsers ?>,
                <?= $femaleUsers ?>
            ],
            backgroundColor: ['#0d6efd', '#d63384']
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

new Chart(document.getElementById('imcChart'), {
    type: 'bar',
    data: {
        labels: ['Normal', 'Surpoids', 'Obèse'],
        datasets: [{
            label: 'Utilisateurs',
            data: [
                <?= $imcStats['normal'] ?? 0 ?>,
                <?= $imcStats['overweight'] ?? 0 ?>,
                <?= $imcStats['obese'] ?? 0 ?>
            ],
            backgroundColor: ['#198754', '#ffc107', '#dc3545']
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
