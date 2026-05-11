<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Ajouter une Activité</h1>

<form method="POST" action="/activites/store">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= old('nom') ?>" required>
    </div>

    <div class="form-group">
        <label for="types">Type:</label>
        <select id="types" name="types" required>
            <option value="">Sélectionnez</option>
            <option value="perte_poids" <?= old('types') === 'perte_poids' ? 'selected' : '' ?>>Perte de Poids</option>
            <option value="prise_poids" <?= old('types') === 'prise_poids' ? 'selected' : '' ?>>Prise de Poids</option>
            <option value="maintien" <?= old('types') === 'maintien' ? 'selected' : '' ?>>Maintien</option>
        </select>
    </div>

    <div class="form-group">
        <label for="calories_brulees">Calories Brûlées:</label>
        <input type="number" id="calories_brulees" name="calories_brulees" value="<?= old('calories_brulees') ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
    <a href="/activites" class="btn btn-secondary">Annuler</a>
</form>

<?= $this->endSection() ?>
