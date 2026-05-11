<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Ajouter un Objectif</h1>

<form method="POST" action="/objectifs/store">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="nom_objectif">Nom:</label>
        <input type="text" id="nom_objectif" name="nom_objectif" value="<?= old('nom_objectif') ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
    <a href="/objectifs" class="btn btn-secondary">Annuler</a>
</form>

<?= $this->endSection() ?>
