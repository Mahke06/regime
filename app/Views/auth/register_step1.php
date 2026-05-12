<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rounded-4 shadow-sm p-4">
                <h1 class="h4 fw-bold mb-2">Inscription - Étape 1</h1>
                <p class="text-muted mb-3">Informations Personnelles</p>

                <form method="POST" action="/register/step2">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= old('nom') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="<?= old('email') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de passe</label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre</label>
                        <select id="genre" name="genre" class="form-select" required>
                            <option value="">Sélectionnez</option>
                            <option value="homme" <?= old('genre') === 'homme' ? 'selected' : '' ?>>Homme</option>
                            <option value="femme" <?= old('genre') === 'femme' ? 'selected' : '' ?>>Femme</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Continuer</button>
                    </div>
                </form>

                <div class="mt-3 text-center"><p class="mb-0">Déjà inscrit? <a href="/login">Se connecter</a></p></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
