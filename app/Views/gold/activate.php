<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container" style="max-width: 600px;">
    <div class="card" style="text-align: center;">
        <h1>Activation Gold Premium</h1>
        <div style="text-align: left; margin: 20px 0;">
            <h3>Benefices:</h3>
            <ul>
                <li>Remise de <?= $discount ?>% sur tous les regimes</li>
                <li>Acces prioritaire aux offres</li>
                <li>Support premium</li>
            </ul>
        </div>

        <h2 style="color: var(--primary);">Prix: <?= number_format($price, 2) ?> AR</h2>
        <p>Votre solde actuel: <?= number_format($user['solde'], 2) ?> AR</p>

        <?php if ($user['solde'] >= $price): ?>
            <form method="POST" action="/gold/purchase">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-warning" style="width: 100%; font-size: 18px;">Activer Gold</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">
                Solde insuffisant. Manque: <?= number_format($price - $user['solde'], 2) ?> AR
            </div>
            <a href="/profile" class="btn btn-primary">Recharger mon solde</a>
        <?php endif; ?>
        
        <div style="margin-top: 20px;">
            <a href="/profile" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>