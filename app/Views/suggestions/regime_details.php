<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h2 fw-bold mb-2"><?= $regime['nom'] ?></h1>
        <p class="text-muted mb-0">Détails complets du régime sélectionné.</p>
    </div>

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Composition du Régime</h2>
        <div class="row g-3 text-center">
            <div class="col-md-4"><div class="p-3 rounded-3 bg-light"><strong><?= $regime['pourcentage_viande'] ?>%</strong><div class="small text-muted">Viande</div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 bg-light"><strong><?= $regime['pourcentage_poisson'] ?>%</strong><div class="small text-muted">Poisson</div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 bg-light"><strong><?= $regime['pourcentage_volaille'] ?>%</strong><div class="small text-muted">Volaille</div></div></div>
        </div>
    </div>

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Options de Durée et Prix</h2>
        
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

    <div class="suggestion-card mb-4 p-4">
        <h2 class="h5 fw-bold mb-3">Vos Informations</h2>
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
