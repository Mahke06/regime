<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Gestion des Régimes</h1>
            <p class="text-muted mb-0">Gérez les compositions nutritionnelles et les actions associées.</p>
        </div>
        <a href="/regimes/create" class="btn btn-primary">Ajouter un Régime</a>
    </div>

    <div class="suggestion-card p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nom</th>
                        <th>% Viande</th>
                        <th>% Poisson</th>
                        <th>% Volaille</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($regimes as $regime): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= $regime['id'] ?></td>
                            <td><?= $regime['nom'] ?></td>
                            <td><?= $regime['pourcentage_viande'] ?>%</td>
                            <td><?= $regime['pourcentage_poisson'] ?>%</td>
                            <td><?= $regime['pourcentage_volaille'] ?>%</td>
                            <td class="pe-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="/regimes/edit/<?= $regime['id'] ?>" class="btn btn-warning btn-sm">Éditer</a>
                                    <a href="/regimes/manage-prices/<?= $regime['id'] ?>" class="btn btn-info btn-sm">Gérer Prix</a>
                                    <a href="/regimes/delete/<?= $regime['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
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
