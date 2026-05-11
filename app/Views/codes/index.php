<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gestion des Codes</h1>

<a href="/codes/create" class="btn btn-primary">Ajouter un Code</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Montant (€)</th>
            <th>Utilisé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($codes as $code): ?>
            <tr>
                <td><?= $code['id'] ?></td>
                <td><?= $code['code'] ?></td>
                <td><?= number_format($code['montant'], 2) ?></td>
                <td><?= $code['utilise'] ? '✓ Oui' : '✗ Non' ?></td>
                <td>
                    <a href="/codes/edit/<?= $code['id'] ?>" class="btn btn-warning">Éditer</a>
                    <a href="/codes/delete/<?= $code['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
