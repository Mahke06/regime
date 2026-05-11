<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h2 fw-bold mb-2"><?= $activite['nom'] ?></h1>
        <p class="text-muted mb-0">Détails de l'activité recommandée selon votre profil.</p>
    </div>

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Détails</h2>
        <p><strong>Type:</strong> <?= str_replace('_', ' ', ucfirst($activite['types'])) ?></p>
        <p><strong>Calories Brûlées:</strong> <?= $activite['calories_brulees'] ?> calories</p>
    </div>

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Recommandé Pour</h2>
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

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Vos Objectifs</h2>
        <ul>
            <?php foreach ($userObjectifs as $objectif): ?>
                <li><?= $objectif['nom_objectif'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a href="/suggestions" class="btn btn-secondary">Retour aux Suggestions</a>
</div>

<?= $this->endSection() ?>
