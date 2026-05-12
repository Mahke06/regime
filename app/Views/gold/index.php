<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h1 class="h4 fw-bold mb-3">Transactions Gold</h1>

    <div class="card rounded-4 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Montant (AR)</th>
                            <th>Date Paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paiements as $paiement): ?>
                            <tr>
                                <td><?= $paiement['id'] ?></td>
                                <td><?= $paiement['nom'] ?></td>
                                <td><?= $paiement['email'] ?></td>
                                <td><?= number_format($paiement['montant'], 2) ?></td>
                                <td><?= $paiement['date_paiement'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
