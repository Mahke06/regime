<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <h1>Choisir mes Objectifs</h1>
        <p>Selectionnez jusqu'a <?= $maxObjectifs ?> objectifs</p>

        <div class="grid-layout">
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
                <div class="card" style="<?= $isSelected ? 'border: 2px solid var(--primary); background: #f0f7ff;' : '' ?>">
                    <h3><?= esc($objectif['nom_objectif']) ?></h3>
                    
                    <?php if ($isSelected): ?>
                        <form method="GET" action="/objectifs/remove/<?= $objectif['id'] ?>">
                            <button type="submit" class="btn btn-danger" style="width: 100%;">Supprimer</button>
                        </form>
                    <?php else: ?>
                        <form method="POST" action="/objectifs/add">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_objectif" value="<?= $objectif['id'] ?>">
                            <button type="submit" class="btn btn-success" style="width: 100%;">Ajouter</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h3>Mes Objectifs Selectionnes (<?= count($userObjectifs) ?>/<?= $maxObjectifs ?>):</h3>
            <?php if (!empty($userObjectifs)): ?>
                <ul>
                    <?php foreach ($userObjectifs as $objectif): ?>
                        <li><?= esc($objectif['nom_objectif']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun objectif selectionne pour le moment.</p>
            <?php endif; ?>
        </div>

        <a href="/profile" class="btn btn-secondary">Retour au profil</a>
    </div>
</div>

<?= $this->endSection() ?>