<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    

<div class="container suggestions-page">

    <!-- HEADER -->
    <div class="suggestions-header">
        <div>
            <h1 class="page-title">Suggestions Personnalisées</h1>
            <p class="suggestions-subtitle">
                Activités et régimes adaptés à votre profil
            </p>
        </div>

        <?php if ($user['gold']): ?>
            <div class="gold-badge">
                Gold Actif
            </div>
        <?php endif; ?>
    </div>

    <!-- PROFIL -->
    <div class="profile-summary-card">

        <div class="summary-item">
            <span>Nom</span>
            <strong><?= esc($user['nom']) ?></strong>
        </div>

        <div class="summary-item">
            <span>IMC</span>
            <strong><?= esc($user['imc']) ?></strong>
        </div>

        <div class="summary-item">
            <span>Solde</span>
            <strong><?= number_format($user['solde'], 2) ?> AR</strong>
        </div>

        <?php if ($user['gold']): ?>
            <div class="summary-item gold-info">
                <span>Avantage Gold</span>
                <strong>-15% sur les régimes</strong>
            </div>
        <?php endif; ?>

    </div>

    <!-- ACTIVITES -->
    <section class="suggestion-section">

        <div class="section-header">
            <h2>Activités recommandées</h2>
        </div>

        <?php if (!empty($suggestedActivites)): ?>

            <div class="suggestion-grid">

                <?php foreach ($suggestedActivites as $activite): ?>

                    <div class="suggestion-card">

                        <div class="card-top">
                            <h3><?= esc($activite['nom']) ?></h3>

                            <span class="type-badge">
                                <?= ucfirst(str_replace('_', ' ', $activite['types'])) ?>
                            </span>
                        </div>

                        <div class="activity-stats">
                             <?= $activite['calories_brulees'] ?> calories brûlées
                        </div>

                        <a href="/suggestions/activite/<?= $activite['id'] ?>"
                           class="btn btn-primary card-btn">
                            Voir détails
                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-box">
                Aucune activité recommandée.
            </div>

        <?php endif; ?>

    </section>

    <!-- REGIMES -->
    <section class="suggestion-section">

        <div class="section-header">
            <h2>Régimes disponibles</h2>
        </div>

        <?php if (!empty($suggestedRegimes)): ?>

            <div class="suggestion-grid">

                <?php foreach ($suggestedRegimes as $regime): ?>

                    <div class="suggestion-card regime-card">

                        <div class="card-top">
                            <h3><?= esc($regime['nom']) ?></h3>
                        </div>

                        <div class="nutrition-box">

                            <div>
                                Viande :
                                <strong><?= $regime['pourcentage_viande'] ?>%</strong>
                            </div>

                            <div>
                                Poisson :
                                <strong><?= $regime['pourcentage_poisson'] ?>%</strong>
                            </div>

                            <div>
                                Volaille :
                                <strong><?= $regime['pourcentage_volaille'] ?>%</strong>
                            </div>

                        </div>

                        <?php if (!empty($regime['prix'])): ?>

                            <div class="price-list">

                                <?php foreach ($regime['prix'] as $p): ?>

                                    <div class="price-item">

                                        <div>
                                            <strong><?= $p['duree'] ?> jours</strong>
                                            <small>
                                                Variation :
                                                <?= $p['variation_poids'] ?> kg
                                            </small>
                                        </div>

                                        <div class="price-value">
                                            <?= number_format($p['prix'] * $goldDiscount, 2) ?> AR
                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php endif; ?>

                        <a href="/suggestions/purchase/<?= $regime['id'] ?>"
                           class="btn btn-success card-btn">
                            Acheter
                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-box">
                Aucun régime disponible.
            </div>

        <?php endif; ?>

    </section>

    <!-- FOOTER -->
    <div class="suggestions-footer">
        <a href="/profile" class="btn btn-secondary">
            Retour au profil
        </a>
    </div>

</div>
</body>
</html>
<?= $this->endSection() ?>