<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Nouveau paramètre</h1>
        <p class="text-muted mb-0">Ajoutez une nouvelle clé de configuration.</p>
    </div>

    <form method="post" action="/parametres/store" class="suggestion-card p-4">
        <?= csrf_field() ?>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="cle">Clé</label>
                <input type="text" id="cle" name="cle" value="<?= old('cle') ?>">
            </div>

            <div class="col-md-6">
                <label for="valeur">Valeur</label>
                <input type="text" id="valeur" name="valeur" value="<?= old('valeur') ?>">
            </div>

            <div class="col-12">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"><?= old('description') ?></textarea>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a class="btn btn-secondary" href="/parametres">Retour</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
