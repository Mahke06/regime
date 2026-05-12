<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row g-4">
        <div class="col-12">
            <div class="card rounded-4 mb-3">
                <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <span class="badge" style="background:<?= $user['gold'] ? "#fbbf24" : "#94a3b8" ?>; color:#111; border-radius:999px; padding:6px 12px;"><?= $user['gold'] ? 'Gold actif' : 'Compte standard' ?></span>
                        <h1 class="h2 fw-bold mb-2">Mon profil</h1>
                        <p class="text-muted mb-0">Bienvenue <?= esc($user['nom']) ?>, voici votre résumé personnel.</p>
                    </div>
                    <div class="text-end">
                        <div class="display-6 fw-bold" style="color:var(--brand-1)"><?= number_format($user['solde'], 2) ?> AR</div>
                        <div class="text-muted">Solde disponible</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card mb-4 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h5 fw-bold mb-3">Informations personnelles</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <span class="text-muted d-block mb-1">Email</span>
                                <strong><?= esc($user['email']) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <span class="text-muted d-block mb-1">Genre</span>
                                <strong><?= ucfirst($user['genre']) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <span class="text-muted d-block mb-1">IMC</span>
                                <strong><?= esc($user['imc']) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <span class="text-muted d-block mb-1">Taille</span>
                                <strong><?= esc($user['taille']) ?> cm</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <span class="text-muted d-block mb-1">Poids</span>
                                <strong><?= esc($user['poids']) ?> kg</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 rounded-4 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 fw-bold mb-0">Mes objectifs</h3>
                        <a href="/objectifs/choose" class="btn btn-sm btn-outline-primary">Gérer</a>
                    </div>

                    <?php if (!empty($objectifs)): ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($objectifs as $objectif): ?>
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2"><?= esc($objectif['nom_objectif']) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-light border mb-0">Aucun objectif choisi pour le moment.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-4 rounded-4 shadow-sm">
                <div class="card-body p-4">
                <h3 class="h5 fw-bold mb-3">Modifier mon profil</h3>
                    <form method="POST" action="/profile/update" class="row g-3">
                        <?= csrf_field() ?>
                        <div class="col-12">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= esc($user['nom']) ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="taille" class="form-label">Taille (cm)</label>
                            <input type="number" class="form-control" id="taille" name="taille" value="<?= esc($user['taille']) ?>" step="0.1" required>
                        </div>
                        <div class="col-6">
                            <label for="poids" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control" id="poids" name="poids" value="<?= esc($user['poids']) ?>" step="0.1" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h3 class="h5 fw-bold mb-3">Portefeuille</h3>
                    <div class="p-4 rounded-4" style="background:linear-gradient(90deg, rgba(16,185,129,0.08), rgba(5,150,105,0.04)); margin-bottom:1rem;">
                        <span class="d-block text-muted mb-1">Solde actuel</span>
                        <h2 class="mb-0" style="color:var(--brand-1)"><?= number_format($user['solde'], 2) ?> AR</h2>
                    </div>

                    <form method="POST" action="/codes/redeem" class="row g-3">
                        <?= csrf_field() ?>
                        <div class="col-12">
                            <label for="code" class="form-label">Code promo</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Entrez votre code" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-secondary w-100">Valider le code</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!$user['gold']): ?>
                <div class="card rounded-4 mb-3">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="h5 fw-bold mb-2">Activez Gold Premium</h3>
                            <p class="mb-0 text-muted">Profitez de 15% de réduction sur tous les régimes.</p>
                        </div>
                        <a href="/gold/activate" class="btn btn-primary" style="background:linear-gradient(90deg,var(--brand-2),var(--brand-1)); border:0;">Activer</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?= $this->endSection() ?>