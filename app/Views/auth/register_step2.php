<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="auth-container">
    <h1>Inscription - Étape 2</h1>
    <p>Informations de Santé</p>

    <form method="POST" action="/register/complete">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="taille">Taille (cm):</label>
            <input type="number" id="taille" name="taille" value="<?= old('taille') ?>" step="0.1" required>
        </div>

        <div class="form-group">
            <label for="poids">Poids (kg):</label>
            <input type="number" id="poids" name="poids" value="<?= old('poids') ?>" step="0.1" required>
        </div>

        <button type="submit" class="btn btn-primary">Terminer l'inscription</button>
    </form>
</div>

<?= $this->endSection() ?>
