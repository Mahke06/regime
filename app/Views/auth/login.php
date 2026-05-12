<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rounded-4 shadow-sm p-4">
                <h1 class="h4 fw-bold mb-2">Connexion</h1>
                <p class="text-muted mb-4">Connectez-vous pour accéder à votre espace santé personnalisé.</p>

                <?php $errors = session()->getFlashdata('errors') ?? []; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form method="POST" action="/authenticate" id="login-form">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" id="email" name="email" value="<?= old('email') ?>" class="form-control" placeholder="exemple@email.com" autocomplete="email" required>
                        <div class="form-text">Entrez l’adresse email utilisée lors de votre inscription.</div>
                        <?php if (isset($errors['email'])): ?>
                            <div class="text-danger small"><?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Votre mot de passe" autocomplete="current-password" required>
                            <button type="button" class="btn btn-outline-secondary" id="toggle-password">Afficher</button>
                        </div>
                        <div class="form-text">Le mot de passe est celui que vous avez créé à l’inscription.</div>
                        <?php if (isset($errors['mot_de_passe'])): ?>
                            <div class="text-danger small"><?= $errors['mot_de_passe'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" id="login-submit">Se connecter</button>
                    </div>
                </form>

                <div class="mt-3 text-center"><p class="mb-0">Pas encore inscrit ? <a href="/register">Créer un compte</a></p></div>
            </div>
        </div>
    </div>
</div>

<script src="/js/login.js"></script>

<?= $this->endSection() ?>
