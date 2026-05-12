<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1" style="color:var(--ink-1);">Gestion des Utilisateurs</h1>
        <p class="text-muted mb-0">Consultez les profils, soldes et statuts de vos utilisateurs.</p>
    </div>

    <div class="card p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Genre</th>
                        <th>IMC</th>
                        <th>Gold</th>
                        <th>Solde</th>
                        <th>Rôle</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= $user['id'] ?></td>
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= ucfirst($user['genre']) ?></td>
                            <td><?= $user['imc'] ?></td>
                            <td><?= $user['gold'] ? 'Actif' : 'Inactif' ?></td>
                            <td><?= number_format($user['solde'], 2) ?> €</td>
                            <td><?= ucfirst($user['roles']) ?></td>
                            <td class="pe-4">
                                <a href="/users/view/<?= $user['id'] ?>" class="btn btn-info btn-sm">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
