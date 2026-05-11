<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Modifier Code</h1>
        <p class="text-muted mb-0">Mettez à jour les informations du code #<?= $code['id'] ?>.</p>
    </div>

    <form method="POST" action="/codes/update/<?= $code['id'] ?>" class="suggestion-card p-4">
        <?= csrf_field() ?>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="code">Code (nombre)</label>
                <input type="number" id="code" name="code" value="<?= old('code', $code['code']) ?>" required>
            </div>

            <div class="col-md-6">
                <label for="montant">Montant (€)</label>
                <input type="number" id="montant" name="montant" value="<?= old('montant', $code['montant']) ?>" step="0.01" required>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="/codes" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
