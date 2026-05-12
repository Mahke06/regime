<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h2 fw-bold mb-2">Acheter le Régime: <?= $regime['nom'] ?></h1>
        <p class="text-muted mb-0">Sélectionnez une durée et confirmez l’achat.</p>
    </div>

    <div class="card rounded-4 mb-4">
        <div class="card-body p-4">
            <h2 class="h5 fw-bold mb-3">Récapitulatif du Régime</h2>
            <p>Viande: <?= $regime['pourcentage_viande'] ?>%</p>
            <p>Poisson: <?= $regime['pourcentage_poisson'] ?>%</p>
            <p>Volaille: <?= $regime['pourcentage_volaille'] ?>%</p>
        </div>
    </div>

    <form method="POST" action="/suggestions/purchase" class="card rounded-4 p-4">
        <div class="card-body">
            <?= csrf_field() ?>

            <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">

            <div class="mb-3">
                <label for="price_id" class="form-label"><strong>Sélectionnez la durée:</strong></label>
                <select id="price_id" name="price_id" class="form-select" required>
                    <option value="">-- Choisir une option --</option>
                    <?php foreach ($prices as $price): ?>
                        <?php $finalPrice = $price['prix'] * $goldDiscount; ?>
                        <option value="<?= $price['id'] ?>">
                            <?= $price['duree'] ?> jours - <?= number_format($finalPrice, 2) ?>€ - Variation: <?= $price['variation_poids'] ?> kg
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="purchase-info p-3 rounded-3 bg-light mb-3">
                <h3 class="h6 fw-bold">Informations de Paiement</h3>
                <p class="mb-1"><strong>Solde Actuel:</strong> <?= number_format($user['solde'], 2) ?>€</p>
                <?php if ($user['gold']): ?>
                    <p class="mb-0"><strong style="color: #b45309;">✓ Remise Gold 15% Appliquée</strong></p>
                <?php endif; ?>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Confirmer l'achat</button>
                <a href="/suggestions" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
