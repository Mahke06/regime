```php
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<style>

.stats-card{
    border:none;
    border-radius:18px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.chart-box{
    height:350px;
}

</style>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                Statistiques Détaillées
            </h2>

            <p class="text-muted">
                Analyse avancée des utilisateurs
            </p>

        </div>

        <a href="/dashboard"
           class="btn btn-dark">

            Retour Dashboard

        </a>

    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">

        <div class="col-md-6">

            <div class="card stats-card">

                <div class="card-header bg-white border-0">
                    Distribution IMC
                </div>

                <div class="card-body">

                    <div class="chart-box">
                        <canvas id="imcPie"></canvas>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card stats-card">

                <div class="card-header bg-white border-0">
                    Distribution Poids
                </div>

                <div class="card-body">

                    <div class="chart-box">
                        <canvas id="weightChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Tableau croisé -->
    <div class="card stats-card">

        <div class="card-header bg-white border-0">
            Objectifs Utilisateurs
        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>Objectif</th>
                        <th>Nombre</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($objectifsData as $objectif): ?>

                    <tr>

                        <td>
                            <?= $objectif['nom'] ?>
                        </td>

                        <td>
                            <?= $objectif['count'] ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

new Chart(document.getElementById('imcPie'), {

    type: 'pie',

    data: {

        labels: [
            'Insuffisant',
            'Normal',
            'Surpoids',
            'Obèse'
        ],

        datasets: [{

            data: [

                <?= $imcStats['underweight'] ?>,
                <?= $imcStats['normal'] ?>,
                <?= $imcStats['overweight'] ?>,
                <?= $imcStats['obese'] ?>

            ],

            backgroundColor: [
                '#36b9cc',
                '#1cc88a',
                '#f6c23e',
                '#e74a3b'
            ]

        }]
    }

});

new Chart(document.getElementById('weightChart'), {

    type: 'bar',

    data: {

        labels: [
            'Léger',
            'Normal',
            'Lourd',
            'Très lourd'
        ],

        datasets: [{

            data: [

                <?= $weightsStats['light'] ?>,
                <?= $weightsStats['normal'] ?>,
                <?= $weightsStats['heavy'] ?>,
                <?= $weightsStats['veryHeavy'] ?>

            ],

            backgroundColor: [
                '#36b9cc',
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
