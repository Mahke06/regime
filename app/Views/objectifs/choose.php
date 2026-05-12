<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4 objectifs-page">
    <div class="row g-4 align-items-start">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background:transparent">
                <div>
                    <h1 class="h2 fw-bold mb-1" style="color:var(--ink-1);">Choisir mes objectifs</h1>
                    <p class="text-muted mb-0">Sélectionnez jusqu’à <strong><?= $maxObjectifs ?></strong> objectifs.</p>
                </div>
                <div class="badge" style="background:var(--brand-1); color:#fff; border-radius:999px; padding:6px 12px; font-weight:600;">
                    <?= count($userObjectifs) ?>/<?= $maxObjectifs ?> choisis
                </div>
            </div>

                    <div class="row g-3">
                <?php foreach ($allObjectifs as $objectif): ?>
                    <?php
                    $isSelected = false;

                    foreach ($userObjectifs as $userObj) {
                        if ($userObj['id'] === $objectif['id']) {
                            $isSelected = true;
                            break;
                        }
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="card rounded-4 bg-white shadow-sm h-100 <?= $isSelected ? 'border border-success' : '' ?>">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1"><?= esc($objectif['nom_objectif']) ?></h3>
                                        <p class="text-muted mb-0">Objectif personnel pour votre parcours.</p>
                                    </div>
                                    <?php if ($isSelected): ?>
                                        <span class="badge" style="background:var(--brand-2); color:#fff; border-radius:999px; padding:6px 10px">Sélectionné</span>
                                    <?php else: ?>
                                        <span class="badge" style="background:#94a3b8; color:#fff; border-radius:999px; padding:6px 10px">Disponible</span>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-auto">
                                    <?php if ($isSelected): ?>
                                        <a href="/objectifs/remove/<?= $objectif['id'] ?>" class="btn btn-outline-danger w-100">Supprimer</a>
                                    <?php else: ?>
                                        <form method="POST" action="/objectifs/add">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id_objectif" value="<?= $objectif['id'] ?>">
                                            <button type="submit" class="btn btn-success w-100">Ajouter</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top rounded-4" style="top:1rem;">
                <div class="card-body p-4">
                    <h3 class="h5 fw-bold mb-3">Mes objectifs sélectionnés</h3>

                    <?php if (!empty($userObjectifs)): ?>
                        <div class="d-flex flex-column gap-2 mb-4">
                            <?php foreach ($userObjectifs as $objectif): ?>
                                <div class="p-3 rounded-3 bg-light fw-medium">
                                    <?= esc($objectif['nom_objectif']) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-light border mb-4">
                            Aucun objectif sélectionné pour le moment.
                        </div>
                    <?php endif; ?>

                    <a href="/profile" class="btn btn-outline-secondary w-100">Retour au profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>