<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Transactions Gold</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Email</th>
            <th>Montant (€)</th>
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

<?= $this->endSection() ?>
