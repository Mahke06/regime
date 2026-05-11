<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="purchase-container">
    <h1>Acheter le Régime: <?= $regime['nom'] ?></h1>

    <div class="regime-summary">
        <h2>Récapitulatif du Régime</h2>
        <p>🥩 Viande: <?= $regime['pourcentage_viande'] ?>%</p>
        <p>🐟 Poisson: <?= $regime['pourcentage_poisson'] ?>%</p>
        <p>🐔 Volaille: <?= $regime['pourcentage_volaille'] ?>%</p>
    </div>

    <form method="POST" action="/suggestions/purchase">
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

        <div class="purchase-info">
            <h3>Informations de Paiement</h3>
            <p><strong>Solde Actuel:</strong> <?= number_format($user['solde'], 2) ?>€</p>
            <?php if ($user['gold']): ?>
                <p><strong style="color: gold;">✓ Remise Gold 15% Appliquée</strong></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success btn-large">Confirmer l'Achat</button>
        <a href="/suggestions" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?= $this->endSection() ?>
