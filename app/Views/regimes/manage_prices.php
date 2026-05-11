<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gérer les Prix - <?= $regime['nom'] ?></h1>

<h3>Prix Existants:</h3>

<?php if (!empty($prix)): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Durée (jours)</th>
                <th>Prix (€)</th>
                <th>Variation Poids (kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prix as $p): ?>
                <tr>
                    <td><?= $p['duree'] ?></td>
                    <td><?= number_format($p['prix'], 2) ?></td>
                    <td><?= $p['variation_poids'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun prix défini pour ce régime.</p>
<?php endif; ?>

<h3>Ajouter un Prix:</h3>

<form method="POST" action="/regimes/add-price/<?= $regime['id'] ?>">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="duree">Durée (jours):</label>
        <input type="number" id="duree" name="duree" value="<?= old('duree') ?>" required>
    </div>

    <div class="form-group">
        <label for="prix">Prix (€):</label>
        <input type="number" id="prix" name="prix" value="<?= old('prix') ?>" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="variation_poids">Variation Poids (kg):</label>
        <input type="number" id="variation_poids" name="variation_poids" value="<?= old('variation_poids') ?>" step="0.1" required>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter Prix</button>
    <a href="/regimes" class="btn btn-secondary">Retour</a>
</form>

<?= $this->endSection() ?>
