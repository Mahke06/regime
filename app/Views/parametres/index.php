<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1" style="color:var(--ink-1);">Paramètres</h1>
                <p class="text-muted mb-0">Gérez les valeurs dynamiques de l’application.</p>
            </div>
            <a class="btn btn-primary btn-lg" href="/parametres/create">Nouveau paramètre</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Clé</th>
                        <th>Valeur</th>
                        <th>Description</th>
                        <th class="pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parametres as $parametre): ?>
                        <tr>
                            <td class="ps-4 fw-semibold"><?= esc($parametre['id']) ?></td>
                            <td><span class="badge bg-dark rounded-pill"><?= esc($parametre['cle']) ?></span></td>
                            <td><?= esc($parametre['valeur']) ?></td>
                            <td class="text-muted"><?= esc($parametre['description'] ?? '') ?></td>
                            <td class="pe-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <a class="btn btn-sm btn-warning" href="/parametres/edit/<?= esc($parametre['id']) ?>">Modifier</a>
                                    <a class="btn btn-sm btn-outline-danger" href="/parametres/delete/<?= esc($parametre['id']) ?>" onclick="return confirm('Supprimer ce paramètre ?')">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
