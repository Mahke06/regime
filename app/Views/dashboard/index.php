```php
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<style>

.dashboard-card{
    border:none;
    border-radius:18px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.chart-box{
    height:300px;
}

</style>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Dashboard Admin
            </h2>

            <p class="text-muted">
                Vue globale de la plateforme
            </p>
        </div>

        <a href="/dashboard/stats"
           class="btn btn-dark">

            Voir Statistiques

        </a>

    </div>

    <!-- KPI -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">

            <div class="card dashboard-card bg-primary text-white">

                <div class="card-body">

                    <h6>Utilisateurs</h6>

                    <h2><?= $totalUsers ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card dashboard-card bg-success text-white">

                <div class="card-body">

                    <h6>Revenus Gold</h6>

                    <h2>
                        <?= number_format($totalGoldRevenue,2) ?> €
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card dashboard-card bg-warning text-white">

                <div class="card-body">

                    <h6>Codes Promo</h6>

                    <h2><?= $availableCodes ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card dashboard-card bg-danger text-white">

                <div class="card-body">

                    <h6>Utilisateurs Gold</h6>

                    <h2><?= $totalGoldUsers ?></h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Charts -->
    <div class="row g-4">

        <div class="col-md-6">

            <div class="card dashboard-card">

                <div class="card-header bg-white border-0">
                    Répartition Genre
                </div>

                <div class="card-body">

                    <div class="chart-box">
                        <canvas id="genderChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card dashboard-card">

                <div class="card-header bg-white border-0">
                    Répartition IMC
                </div>

                <div class="card-body">

                    <div class="chart-box">
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

            backgroundColor: [
                '#4e73df',
                '#e83e8c'
            ]

        }]
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

            backgroundColor: [
                '#1cc88a',
                '#f6c23e',
                '#e74a3b'
            ]

        }]
    }

});

</script>

<?= $this->endSection() ?>
```
