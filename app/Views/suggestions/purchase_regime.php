<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h2 fw-bold mb-2">Acheter le Régime: <?= $regime['nom'] ?></h1>
        <p class="text-muted mb-0">Sélectionnez une durée et confirmez l’achat.</p>
    </div>

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Récapitulatif du Régime</h2>
        <p>Viande: <?= $regime['pourcentage_viande'] ?>%</p>
        <p>Poisson: <?= $regime['pourcentage_poisson'] ?>%</p>
        <p>Volaille: <?= $regime['pourcentage_volaille'] ?>%</p>
    </div>

    <form method="POST" action="/suggestions/purchase" class="suggestion-card p-4">
        <?= csrf_field() ?>

        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">

        <div class="form-group">
            <label for="price_id"><strong>Sélectionnez la durée:</strong></label>
            <select id="price_id" name="price_id" required>
                <option value="">-- Choisir une option --</option>
                <?php foreach ($prices as $price): ?>
                    <?php $finalPrice = $price['prix'] * $goldDiscount; ?>
                    <option value="<?= $price['id'] ?>">
                        <?= $price['duree'] ?> jours - 
                        <?= number_format($finalPrice, 2) ?>€
                        <?php if ($user['gold']): ?>
                            (remisé de 15%)
                        <?php endif; ?>
                        - Variation: <?= $price['variation_poids'] ?> kg
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="purchase-info p-3 rounded-3 bg-light">
            <h3 class="h6 fw-bold">Informations de Paiement</h3>
            <p><strong>Solde Actuel:</strong> <?= number_format($user['solde'], 2) ?>€</p>
            <?php if ($user['gold']): ?>
                <p><strong style="color: gold;">✓ Remise Gold 15% Appliquée</strong></p>
            <?php endif; ?>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Confirmer l'Achat</button>
            <a href="/suggestions" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
