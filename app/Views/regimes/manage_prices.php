<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Gérer les Prix - <?= $regime['nom'] ?></h1>
        <p class="text-muted mb-0">Configurez les durées, tarifs et variations de poids.</p>
    </div>

    <div class="suggestion-card p-0 mb-4">
        <div class="card-body p-4 pb-0">
            <h2 class="h5 fw-bold">Prix existants</h2>
        </div>

        <?php if (!empty($prix)): ?>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Durée (jours)</th>
                            <th>Prix (€)</th>
                            <th class="pe-4">Variation Poids (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prix as $p): ?>
                            <tr>
                                <td class="ps-4"><?= $p['duree'] ?></td>
                                <td><?= number_format($p['prix'], 2) ?></td>
                                <td class="pe-4"><?= $p['variation_poids'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="card-body p-4 pt-2">
                <div class="alert alert-light border mb-0">Aucun prix défini pour ce régime.</div>
            </div>
        <?php endif; ?>
    </div>

    <form method="POST" action="/regimes/add-price/<?= $regime['id'] ?>" class="suggestion-card p-4">
        <?= csrf_field() ?>
        <h2 class="h5 fw-bold mb-3">Ajouter un prix</h2>

        <div class="row g-3">
            <div class="col-md-4">
                <label for="duree">Durée (jours)</label>
                <input type="number" id="duree" name="duree" value="<?= old('duree') ?>" required>
            </div>

            <div class="col-md-4">
                <label for="prix">Prix (€)</label>
                <input type="number" id="prix" name="prix" value="<?= old('prix') ?>" step="0.01" required>
            </div>

            <div class="col-md-4">
                <label for="variation_poids">Variation Poids (kg)</label>
                <input type="number" id="variation_poids" name="variation_poids" value="<?= old('variation_poids') ?>" step="0.1" required>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Ajouter Prix</button>
                <a href="/regimes" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
