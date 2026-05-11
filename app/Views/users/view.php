<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1"><?= $user['nom'] ?></h1>
            <p class="text-muted mb-0">Détails complets du profil utilisateur.</p>
        </div>
        <a href="/users" class="btn btn-secondary">Retour</a>
    </div>

    <div class="suggestion-card p-4">
        <div class="row g-3">
            <div class="col-md-6"><div class="p-3 bg-light rounded-3"><strong>Email:</strong> <?= $user['email'] ?></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-3"><strong>Genre:</strong> <?= ucfirst($user['genre']) ?></div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>Taille:</strong> <?= $user['taille'] ?> cm</div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>Poids:</strong> <?= $user['poids'] ?> kg</div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>IMC:</strong> <?= $user['imc'] ?></div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>Solde:</strong> <?= number_format($user['solde'], 2) ?> €</div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>Gold:</strong> <?= $user['gold'] ? 'Actif' : 'Inactif' ?></div></div>
            <div class="col-md-4"><div class="p-3 bg-light rounded-3"><strong>Rôle:</strong> <?= ucfirst($user['roles']) ?></div></div>
            <div class="col-12"><div class="p-3 bg-light rounded-3"><strong>Date d'inscription:</strong> <?= $user['date_inscription'] ?></div></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
