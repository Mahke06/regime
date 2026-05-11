<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="activite-details-container">
    <h1><?= $activite['nom'] ?></h1>

    <div class="activite-info">
        <h2>Détails</h2>
        <p><strong>Type:</strong> <?= str_replace('_', ' ', ucfirst($activite['types'])) ?></p>
        <p><strong>Calories Brûlées:</strong> <?= $activite['calories_brulees'] ?> calories</p>
    </div>

    <div class="activite-recommendations">
        <h2>Recommandé Pour:</h2>
        <ul>
            <?php if (strpos($activite['types'], 'perte') !== false): ?>
                <li>✓ Perte de Poids</li>
            <?php endif; ?>
            <?php if (strpos($activite['types'], 'prise') !== false): ?>
                <li>✓ Prise de Poids</li>
            <?php endif; ?>
            <?php if (strpos($activite['types'], 'maintien') !== false): ?>
                <li>✓ Maintien de Poids</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="user-objectifs">
        <h2>Vos Objectifs:</h2>
        <ul>
            <?php foreach ($userObjectifs as $objectif): ?>
                <li><?= $objectif['nom_objectif'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a href="/suggestions" class="btn btn-secondary">Retour aux Suggestions</a>
</div>

<?= $this->endSection() ?>
