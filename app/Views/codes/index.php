<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Gestion des Codes</h1>
            <p class="text-muted mb-0">Créez et gérez les codes de recharge portefeuille.</p>
        </div>
        <a href="/codes/create" class="btn btn-primary">Ajouter un Code</a>
    </div>

    <div class="suggestion-card p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Code</th>
                        <th>Montant (€)</th>
                        <th>Utilisé</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($codes as $code): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= $code['id'] ?></td>
                            <td><span class="badge bg-dark rounded-pill"><?= $code['code'] ?></span></td>
                            <td><?= number_format($code['montant'], 2) ?></td>
                            <td><?= $code['utilise'] ? 'Oui' : 'Non' ?></td>
                            <td class="pe-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="/codes/edit/<?= $code['id'] ?>" class="btn btn-warning btn-sm">Éditer</a>
                                    <a href="/codes/delete/<?= $code['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
