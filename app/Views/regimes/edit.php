<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Modifier Régime</h1>
        <p class="text-muted mb-0">Mettez à jour les valeurs du régime #<?= $regime['id'] ?>.</p>
    </div>

    <form method="POST" action="/regimes/update/<?= $regime['id'] ?>" class="suggestion-card p-4">
        <?= csrf_field() ?>

        <div class="row g-3">
            <div class="col-12">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= old('nom', $regime['nom']) ?>" required>
            </div>

            <div class="col-md-4">
                <label for="pourcentage_viande">% Viande (0-100)</label>
                <input type="number" id="pourcentage_viande" name="pourcentage_viande" value="<?= old('pourcentage_viande', $regime['pourcentage_viande']) ?>" min="0" max="100" required>
            </div>

            <div class="col-md-4">
                <label for="pourcentage_poisson">% Poisson (0-100)</label>
                <input type="number" id="pourcentage_poisson" name="pourcentage_poisson" value="<?= old('pourcentage_poisson', $regime['pourcentage_poisson']) ?>" min="0" max="100" required>
            </div>

            <div class="col-md-4">
                <label for="pourcentage_volaille">% Volaille (0-100)</label>
                <input type="number" id="pourcentage_volaille" name="pourcentage_volaille" value="<?= old('pourcentage_volaille', $regime['pourcentage_volaille']) ?>" min="0" max="100" required>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="/regimes" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
