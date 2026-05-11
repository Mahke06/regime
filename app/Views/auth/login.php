<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="auth-container">
    <h1>Connexion</h1>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="POST" action="/authenticate" id="login-form">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="exemple@email.com" autocomplete="email" required>
            <small>Entrez l’adresse email utilisée lors de votre inscription.</small>
            <?php if (isset($errors['email'])): ?>
                <div class="field-error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <div class="password-row">
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" autocomplete="current-password" required>
                <button type="button" class="password-toggle" id="toggle-password">Afficher</button>
            </div>
            <small>Le mot de passe est celui que vous avez créé à l’inscription. Vous pouvez l’afficher pour vérifier la saisie.</small>
            <?php if (isset($errors['mot_de_passe'])): ?>
                <div class="field-error"><?= $errors['mot_de_passe'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary" id="login-submit">Se connecter</button>
    </form>

    <p>Pas encore inscrit ? <a href="/register">Créer un compte</a></p>
</div>

<script src="/js/login.js"></script>

<?= $this->endSection() ?>
