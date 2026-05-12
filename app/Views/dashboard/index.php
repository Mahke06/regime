<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="dashboard-panel mb-4">
        <div class="p-4 rounded-4" style="background: linear-gradient(90deg, rgba(16,185,129,0.08), rgba(5,150,105,0.04));">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge" style="background:var(--brand-1); color:#fff;">Administration</span>
                    <h2 class="fw-bold mb-1" style="color:var(--ink-1);">Tableau de bord</h2>
                    <p class="text-muted mb-0">Vue globale de la plateforme et indicateurs clés.</p>
                </div>
                <a href="/dashboard/stats" class="btn btn-outline-secondary">Voir statistiques</a>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100" style="border-top:4px solid var(--brand-1)">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted small fw-bold">UTILISATEURS</span>
                        <i class="bi bi-people" style="color:var(--brand-1)"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $totalUsers ?></div>
                    <p class="text-muted small mt-2 mb-0">Membres actifs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100" style="border-top:4px solid var(--brand-2)">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted small fw-bold">REVENUS GOLD</span>
                        <i class="bi bi-gem" style="color:var(--brand-2)"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= number_format($totalGoldRevenue, 2) ?> €</div>
                    <p class="text-muted small mt-2 mb-0">Abonnements premium</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100" style="border-top:4px solid var(--accent)">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted small fw-bold">CODES PROMOS</span>
                        <i class="bi bi-ticket-perforated" style="color:var(--accent)"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $availableCodes ?></div>
                    <p class="text-muted small mt-2 mb-0">Codes disponibles</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 rounded-4 bg-white shadow-sm h-100" style="border-top:4px solid #fbbf24">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted small fw-bold">GOLD USERS</span>
                        <i class="bi bi-star-fill" style="color:#fbbf24"></i>
                    </div>
                    <div class="display-6 fw-bold"><?= $totalGoldUsers ?></div>
                    <p class="text-muted small mt-2 mb-0">Utilisateurs premium</p>
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
