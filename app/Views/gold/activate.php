<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4" style="max-width:720px;">
    <div class="card rounded-4 shadow-sm">
        <div class="card-body text-center">
            <h1 class="h4 fw-bold mb-3">Activation Gold Premium</h1>
            <div class="text-start mb-3">
                <h5 class="fw-semibold">Bénéfices</h5>
                <ul>
                    <li>Remise de <?= $discount ?>% sur tous les régimes</li>
                    <li>Accès prioritaire aux offres</li>
                    <li>Support premium</li>
                </ul>
            </div>

            <h2 class="fw-bold" style="color:var(--brand-1);">Prix: <?= number_format($price, 2) ?> AR</h2>
            <p class="text-muted">Votre solde actuel: <?= number_format($user['solde'], 2) ?> AR</p>

            <?php if ($user['solde'] >= $price): ?>
                <form method="POST" action="/gold/purchase">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-primary btn-lg w-100" style="background:linear-gradient(90deg,var(--brand-2),var(--brand-1)); border:0;">Activer Gold</button>
                </form>
            <?php else: ?>
                <div class="alert alert-danger">Solde insuffisant. Manque: <?= number_format($price - $user['solde'], 2) ?> AR</div>
                <a href="/profile" class="btn btn-outline-primary">Recharger mon solde</a>
            <?php endif; ?>

            <div class="mt-3">
                <a href="/profile" class="btn btn-outline-secondary">Retour</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>