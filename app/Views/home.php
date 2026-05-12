<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="hero-panel p-4" style="background: linear-gradient(90deg, rgba(16,185,129,0.06), rgba(5,150,105,0.03)); border-radius:14px;">
                <span class="badge" style="background:var(--brand-1); color:#fff; border-radius:999px; padding:6px 12px;">Santé & Régime</span>
                <h1 class="hero-lead mb-3" style="color:var(--ink-1);">Atteignez vos objectifs de poids avec plans personnalisés</h1>
                <p class="hero-sub mb-4 text-muted">Entrez vos informations, choisissez vos objectifs et recevez des régimes adaptés avec suivi IMC et recommandations d'activité.</p>
                <div class="d-flex flex-wrap gap-3">
                    <?php if (!session()->get('user_id')): ?>
                        <a href="/register" class="btn btn-primary btn-lg px-4">Commencer</a>
                        <a href="/login" class="btn btn-outline-secondary btn-lg px-4">Se connecter</a>
                    <?php else: ?>
                        <a href="/profile" class="btn btn-primary btn-lg px-4">Mon profil</a>
                        <?php if (session()->get('roles') === 'user'): ?>
                            <a href="/suggestions" class="btn btn-outline-secondary btn-lg px-4">Voir suggestions</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm h-100 text-center" style="border-left:4px solid var(--brand-1);">
                        <i class="bi bi-heart-pulse" style="font-size:2rem; color:var(--brand-1);"></i>
                        <h6 class="mt-3 mb-2 fw-bold">IMC</h6>
                        <p class="text-muted small mb-0">Suivi automatique IMC</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm h-100 text-center" style="border-left:4px solid var(--brand-2);">
                        <i class="bi bi-bullseye" style="font-size:2rem; color:var(--brand-2);"></i>
                        <h6 class="mt-3 mb-2 fw-bold">Objectifs</h6>
                        <p class="text-muted small mb-0">Perte / Prise / IMC idéal</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm h-100 text-center" style="border-left:4px solid var(--accent);">
                        <i class="bi bi-fire" style="font-size:2rem; color:var(--accent);"></i>
                        <h6 class="mt-3 mb-2 fw-bold">Régimes</h6>
                        <p class="text-muted small mb-0">Plans adaptés par durée</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm h-100 text-center" style="border-left:4px solid #fbbf24;">
                        <i class="bi bi-gem" style="font-size:2rem; color:#fbbf24;"></i>
                        <h6 class="mt-3 mb-2 fw-bold">Gold</h6>
                        <p class="text-muted small mb-0">Réduction 15% sur régimes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="suggestion-card h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Inscription rapide</h5>
                    <p class="text-muted mb-0">Création de compte en deux étapes avec informations personnelles et physiques.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Dashboard clair</h5>
                    <p class="text-muted mb-0">Statistiques, graphiques et aperçu global pour l’administrateur.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Portefeuille intégré</h5>
                    <p class="text-muted mb-0">Recharge par code promo et gestion du solde directement dans le profil.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>