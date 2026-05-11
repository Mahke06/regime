<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Gestion des Activités</h1>
            <p class="text-muted mb-0">Administrez les activités sportives proposées aux utilisateurs.</p>
        </div>
        <a href="/activites/create" class="btn btn-primary">Ajouter une Activité</a>
    </div>

    <div class="suggestion-card p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Calories Brûlées</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activites as $activite): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= $activite['id'] ?></td>
                            <td><?= $activite['nom'] ?></td>
                            <td><?= $activite['types'] ?></td>
                            <td><?= $activite['calories_brulees'] ?></td>
                            <td class="pe-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="/activites/edit/<?= $activite['id'] ?>" class="btn btn-warning btn-sm">Éditer</a>
                                    <a href="/activites/delete/<?= $activite['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
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
