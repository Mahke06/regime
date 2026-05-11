<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="regime-details-container">
    <h1><?= $regime['nom'] ?></h1>

    <div class="regime-composition">
        <h2>Composition du Régime</h2>
        <ul>
            <li>🥩 <strong>Viande:</strong> <?= $regime['pourcentage_viande'] ?>%</li>
            <li>🐟 <strong>Poisson:</strong> <?= $regime['pourcentage_poisson'] ?>%</li>
            <li>🐔 <strong>Volaille:</strong> <?= $regime['pourcentage_volaille'] ?>%</li>
        </ul>
    </div>

    <div class="regime-prices">
        <h2>Options de Durée et Prix</h2>
        
        <?php if (!empty($prices)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Durée (jours)</th>
                        <th>Variation Poids (kg)</th>
                        <th>Prix Normal (€)</th>
                        <?php if ($user['gold']): ?>
                            <th>Prix Gold (€)</th>
                        <?php endif; ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prices as $price): ?>
                        <tr>
                            <td><?= $price['duree'] ?></td>
                            <td><?= $price['variation_poids'] ?></td>
                            <td><?= number_format($price['prix'], 2) ?></td>
                            <?php if ($user['gold']): ?>
                                <td><strong><?= number_format($price['prix'] * 0.85, 2) ?></strong></td>
                            <?php endif; ?>
                            <td>
                                <form method="POST" action="/suggestions/purchase" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                                    <input type="hidden" name="price_id" value="<?= $price['id'] ?>">
                                    <button type="submit" class="btn btn-success">Acheter</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun prix disponible pour ce régime.</p>
        <?php endif; ?>
    </div>

    <div class="regime-user-info">
        <h2>Vos Informations</h2>
        <p><strong>Solde:</strong> <?= number_format($user['solde'], 2) ?>€</p>
        <p><strong>Vos Objectifs:</strong></p>
        <ul>
            <?php foreach ($userObjectifs as $objectif): ?>
                <li><?= $objectif['nom_objectif'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a href="/suggestions" class="btn btn-secondary">Retour aux Suggestions</a>
</div>

<?= $this->endSection() ?>
