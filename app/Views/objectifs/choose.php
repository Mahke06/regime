<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container objectifs-page">

        <div class="objectifs-header">
            <div>
                <h1 class="page-title">Choisir mes objectifs</h1>
                <p class="objectifs-subtitle">
                    Sélectionnez jusqu'à 
                    <strong><?= $maxObjectifs ?></strong> objectifs
                </p>
            </div>

            <div class="objectif-counter">
                <?= count($userObjectifs) ?>/<?= $maxObjectifs ?>
            </div>
        </div>

        <!-- LISTE DES OBJECTIFS -->
        <div class="objectifs-grid">

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

                <div class="objectif-card <?= $isSelected ? 'selected' : '' ?>">

                    <div class="objectif-top">
                        <h3><?= esc($objectif['nom_objectif']) ?></h3>

                        <?php if ($isSelected): ?>
                            <span class="objectif-badge active">
                                ✓ Sélectionné
                            </span>
                        <?php else: ?>
                            <span class="objectif-badge">
                                Disponible
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="objectif-actions">

                        <?php if ($isSelected): ?>

                            <a href="/objectifs/remove/<?= $objectif['id'] ?>"
                            class="btn btn-danger objectif-btn">
                                Supprimer
                            </a>
                            

                        <?php else: ?>

                            <form method="POST" action="/objectifs/add">
                                <?= csrf_field() ?>

                                <input type="hidden"
                                    name="id_objectif"
                                    value="<?= $objectif['id'] ?>">

                                <button type="submit"
                                        class="btn btn-success objectif-btn">
                                    Ajouter
                                </button>
                            </form>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- OBJECTIFS SELECTIONNES -->
        <div class="profile-card objectifs-selected">

            <div class="selected-header">
                <h3 class="section-title">
                    Mes objectifs sélectionnés
                </h3>

                <span class="selected-count">
                    <?= count($userObjectifs) ?>/<?= $maxObjectifs ?>
                </span>
            </div>

            <?php if (!empty($userObjectifs)): ?>

                <div class="selected-list">

                    <?php foreach ($userObjectifs as $objectif): ?>

                        <div class="selected-item">
                            <?= esc($objectif['nom_objectif']) ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="empty-objectifs">
                    <p>Aucun objectif sélectionné pour le moment.</p>
                </div>

            <?php endif; ?>

        </div>

        <!-- RETOUR -->
        <div class="objectifs-footer">
            <a href="/profile" class="btn btn-secondary">
                Retour au profil
            </a>
        </div>

    </div>
</body>
</html>
<?= $this->endSection() ?>