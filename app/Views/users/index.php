<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gestion des Utilisateurs</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Genre</th>
            <th>IMC</th>
            <th>Gold</th>
            <th>Solde</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nom'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= ucfirst($user['genre']) ?></td>
                <td><?= $user['imc'] ?></td>
                <td><?= $user['gold'] ? '✓' : '✗' ?></td>
                <td><?= number_format($user['solde'], 2) ?>€</td>
                <td><?= ucfirst($user['roles']) ?></td>
                <td>
                    <a href="/users/view/<?= $user['id'] ?>" class="btn btn-info">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
