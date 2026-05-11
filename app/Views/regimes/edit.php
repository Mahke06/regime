<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Modifier Régime</h1>

<form method="POST" action="/regimes/update/<?= $regime['id'] ?>">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= old('nom', $regime['nom']) ?>" required>
    </div>

    <div class="form-group">
        <label for="pourcentage_viande">% Viande (0-100):</label>
        <input type="number" id="pourcentage_viande" name="pourcentage_viande" value="<?= old('pourcentage_viande', $regime['pourcentage_viande']) ?>" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="pourcentage_poisson">% Poisson (0-100):</label>
        <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" value="<?= old('pourcentage_poisson', $regime['pourcentage_poisson']) ?>" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="pourcentage_volaille">% Volaille (0-100):</label>
        <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" value="<?= old('pourcentage_volaille', $regime['pourcentage_volaille']) ?>" min="0" max="100" required>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <a href="/regimes" class="btn btn-secondary">Annuler</a>
</form>

<?= $this->endSection() ?>
