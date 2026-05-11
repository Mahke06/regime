<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="hero-panel">
                <span class="badge bg-primary-subtle text-primary rounded-pill mb-3">Application Régime</span>
                <h1 class="hero-lead mb-3">Un suivi simple pour mieux manger, mieux bouger et progresser.</h1>
                <p class="hero-sub mb-4">
                    Gérez votre profil, vos objectifs, vos régimes et votre portefeuille dans une interface claire pensée pour le suivi quotidien.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <?php if (!session()->get('user_id')): ?>
                        <a href="/register" class="btn btn-primary btn-lg px-4">Commencer maintenant</a>
                        <a href="/login" class="btn btn-secondary btn-lg px-4">Se connecter</a>
                    <?php else: ?>
                        <a href="/profile" class="btn btn-primary btn-lg px-4">Mon profil</a>
                        <?php if (session()->get('roles') === 'user'): ?>
                            <a href="/objectifs/choose" class="btn btn-outline-secondary btn-lg px-4">Mes objectifs</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="row g-3">
                <div class="col-6">
                    <div class="suggestion-card p-3 h-100">
                        <i class="bi bi-calculator display-6 text-primary"></i>
                        <h5 class="mt-3 mb-2">IMC automatique</h5>
                        <p class="text-muted mb-0">Calcul instantané selon votre taille et votre poids.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm border h-100">
                        <i class="bi bi-bullseye display-6 text-success"></i>
                        <h5 class="mt-3 mb-2">Objectifs</h5>
                        <p class="text-muted mb-0">Choix guidé des objectifs de santé et de forme.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm border h-100">
                        <i class="bi bi-egg-fried display-6 text-warning"></i>
                        <h5 class="mt-3 mb-2">Régimes</h5>
                        <p class="text-muted mb-0">Suggestions adaptées à votre profil.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-4 bg-white shadow-sm border h-100">
                        <i class="bi bi-gem display-6 text-danger"></i>
                        <h5 class="mt-3 mb-2">Gold</h5>
                        <p class="text-muted mb-0">Réduction automatique sur les régimes.</p>
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