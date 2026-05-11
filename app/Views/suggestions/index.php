<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4 suggestions-page">
    <div class="hero-panel mb-4">
        <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="badge bg-primary rounded-pill mb-3">Suggestions personnalisées</span>
                <h1 class="h2 fw-bold mb-2">Activités et régimes adaptés à votre profil</h1>
                <p class="text-muted mb-0">Les recommandations tiennent compte de votre IMC, de vos objectifs et de votre solde.</p>
            </div>
            <?php if ($user['gold']): ?>
                <div class="badge bg-warning text-dark rounded-pill px-4 py-3 fs-6">Gold actif -15%</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="suggestion-card h-100">
                <div class="card-body p-4">
                    <span class="text-muted d-block mb-1">Nom</span>
                    <strong class="fs-5"><?= esc($user['nom']) ?></strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="suggestion-card h-100">
                <div class="card-body p-4">
                    <span class="text-muted d-block mb-1">IMC</span>
                    <strong class="fs-5"><?= esc($user['imc']) ?></strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="suggestion-card h-100">
                <div class="card-body p-4">
                    <span class="text-muted d-block mb-1">Solde</span>
                    <strong class="fs-5"><?= number_format($user['solde'], 2) ?> AR</strong>
                </div>
            </div>
        </div>
    </div>

    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Activités recommandées</h2>
                <p class="text-muted mb-0">Sélectionnées selon vos objectifs.</p>
            </div>
        </div>

        <?php if (!empty($suggestedActivites)): ?>
            <div class="row g-3">
                <?php foreach ($suggestedActivites as $activite): ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="suggestion-card h-100">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1"><?= esc($activite['nom']) ?></h3>
                                        <p class="text-muted mb-0">Activité sportive adaptée.</p>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill"><?= ucfirst(str_replace('_', ' ', $activite['types'])) ?></span>
                                </div>

                                <div class="p-3 rounded-3 bg-light mb-3">
                                    <?= esc($activite['calories_brulees']) ?> calories brûlées
                                </div>

                                <a href="/suggestions/activite/<?= $activite['id'] ?>" class="btn btn-primary mt-auto">Voir détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-light border mb-0">Aucune activité recommandée.</div>
        <?php endif; ?>
    </section>

    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h4 fw-bold mb-1">Régimes disponibles</h2>
                <p class="text-muted mb-0">Les tarifs affichés incluent la remise Gold si vous l’avez activée.</p>
            </div>
        </div>

        <?php if (!empty($suggestedRegimes)): ?>
            <div class="row g-3">
                <?php foreach ($suggestedRegimes as $regime): ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="suggestion-card h-100">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <h3 class="h5 fw-bold mb-1"><?= esc($regime['nom']) ?></h3>
                                    <div class="text-muted">Composition nutritionnelle</div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-4"><div class="p-2 rounded-3 bg-light text-center"><strong><?= $regime['pourcentage_viande'] ?>%</strong><div class="small text-muted">Viande</div></div></div>
                                    <div class="col-4"><div class="p-2 rounded-3 bg-light text-center"><strong><?= $regime['pourcentage_poisson'] ?>%</strong><div class="small text-muted">Poisson</div></div></div>
                                    <div class="col-4"><div class="p-2 rounded-3 bg-light text-center"><strong><?= $regime['pourcentage_volaille'] ?>%</strong><div class="small text-muted">Volaille</div></div></div>
                                </div>

                                <?php if (!empty($regime['prix'])): ?>
                                    <div class="d-flex flex-column gap-2 mb-3">
                                        <?php foreach ($regime['prix'] as $p): ?>
                                            <div class="p-3 rounded-3 bg-light d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong><?= $p['duree'] ?> jours</strong>
                                                    <div class="small text-muted">Variation : <?= $p['variation_poids'] ?> kg</div>
                                                </div>
                                                <div class="fw-bold text-success"><?= number_format($p['prix'] * $goldDiscount, 2) ?> AR</div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <a href="/suggestions/purchase/<?= $regime['id'] ?>" class="btn btn-success mt-auto">Acheter</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-light border mb-0">Aucun régime disponible.</div>
        <?php endif; ?>
    </section>

    <div class="d-flex justify-content-end">
        <a href="/profile" class="btn btn-outline-secondary">Retour au profil</a>
    </div>
</div>

<?= $this->endSection() ?>