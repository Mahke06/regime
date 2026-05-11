<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="auth-container">
    <h1>Inscription - Étape 1</h1>
    <p>Informations Personnelles</p>

    <form method="POST" action="/register/step2">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?= old('nom') ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
        </div>

        <div class="form-group">
            <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre:</label>
            <select id="genre" name="genre" required>
                <option value="">Sélectionnez</option>
                <option value="homme" <?= old('genre') === 'homme' ? 'selected' : '' ?>>Homme</option>
                <option value="femme" <?= old('genre') === 'femme' ? 'selected' : '' ?>>Femme</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Continuer</button>
    </form>

    <p>Déjà inscrit? <a href="/login">Se connecter</a></p>
</div>

<?= $this->endSection() ?>
