<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h1>Suggestions Personnalisees</h1>
    
    <div class="card">
        <h2>Votre Profil</h2>
        <p><strong>Nom:</strong> <?= esc($user['nom']) ?></p>
        <p><strong>IMC:</strong> <?= esc($user['imc']) ?></p>
        <p><strong>Solde:</strong> <?= number_format($user['solde'], 2) ?> AR</p>
        <?php if ($user['gold']): ?>
            <p style="color: var(--warning); font-weight: bold;">Compte Gold Actif - Remise de 15% incluse</p>
        <?php endif; ?>
    </div>

    <section>
        <h2>Activites Recommandees</h2>
        <div class="grid-layout">
            <?php if (!empty($suggestedActivites)): ?>
                <?php foreach ($suggestedActivites as $activite): ?>
                    <div class="card">
                        <h3><?= esc($activite['nom']) ?></h3>
                        <p>Type: <?= ucfirst(str_replace('_', ' ', $activite['types'])) ?></p>
                        <p>Calories: <?= $activite['calories_brulees'] ?> cal</p>
                        <a href="/suggestions/activite/<?= $activite['id'] ?>" class="btn btn-primary" style="width: 100%;">Voir Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune activite recommandee.</p>
            <?php endif; ?>
        </div>
    </section>

    <section style="margin-top: 30px;">
        <h2>Regimes Disponibles</h2>
        <div class="grid-layout">
            <?php if (!empty($suggestedRegimes)): ?>
                <?php foreach ($suggestedRegimes as $regime): ?>
                    <div class="card">
                        <h3><?= esc($regime['nom']) ?></h3>
                        <div style="background: #f8fafc; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
                            <p>Viande: <?= $regime['pourcentage_viande'] ?>% | Poisson: <?= $regime['pourcentage_poisson'] ?>% | Volaille: <?= $regime['pourcentage_volaille'] ?>%</p>
                        </div>
                        
                        <?php if (!empty($regime['prix'])): ?>
                            <ul style="padding-left: 20px;">
                                <?php foreach ($regime['prix'] as $p): ?>
                                    <li>
                                        <?= $p['duree'] ?> jours: 
                                        <strong><?= number_format($p['prix'] * $goldDiscount, 2) ?> AR</strong>
                                        (<?= $p['variation_poids'] ?> kg)
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div style="margin-top: 15px;">
                            <a href="/suggestions/purchase/<?= $regime['id'] ?>" class="btn btn-success" style="width: 100%;">Acheter</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun regime disponible.</p>
            <?php endif; ?>
        </div>
    </section>

    <a href="/profile" class="btn btn-secondary" style="margin-top: 20px;">Retour au Profil</a>
</div>

<?= $this->endSection() ?>