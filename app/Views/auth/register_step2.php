<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rounded-4 shadow-sm p-4">
                <h1 class="h4 fw-bold mb-2">Inscription - Étape 2</h1>
                <p class="text-muted mb-3">Informations de Santé</p>

                <form method="POST" action="/register/complete">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="taille" class="form-label">Taille (cm)</label>
                        <input type="number" id="taille" name="taille" value="<?= old('taille') ?>" step="0.1" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="poids" class="form-label">Poids (kg)</label>
                        <input type="number" id="poids" name="poids" value="<?= old('poids') ?>" step="0.1" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Terminer l'inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
