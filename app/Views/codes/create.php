<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Ajouter un Code</h1>

<form method="POST" action="/codes/store">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="code">Code (nombre):</label>
        <input type="number" id="code" name="code" value="<?= old('code') ?>" required>
    </div>

    <div class="form-group">
        <label for="montant">Montant (€):</label>
        <input type="number" id="montant" name="montant" value="<?= old('montant') ?>" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
    <a href="/codes" class="btn btn-secondary">Annuler</a>
</form>

<?= $this->endSection() ?>
