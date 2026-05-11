<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Modifier Activité</h1>
        <p class="text-muted mb-0">Mettez à jour les données de l’activité #<?= $activite['id'] ?>.</p>
    </div>

    <form method="POST" action="/activites/update/<?= $activite['id'] ?>" class="suggestion-card p-4">
        <?= csrf_field() ?>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= old('nom', $activite['nom']) ?>" required>
            </div>

            <div class="col-md-6">
                <label for="types">Type</label>
                <select id="types" name="types" required>
                    <option value="">Sélectionnez</option>
                    <option value="perte_poids" <?= old('types', $activite['types']) === 'perte_poids' ? 'selected' : '' ?>>Perte de Poids</option>
                    <option value="prise_poids" <?= old('types', $activite['types']) === 'prise_poids' ? 'selected' : '' ?>>Prise de Poids</option>
                    <option value="maintien" <?= old('types', $activite['types']) === 'maintien' ? 'selected' : '' ?>>Maintien</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="calories_brulees">Calories Brûlées</label>
                <input type="number" id="calories_brulees" name="calories_brulees" value="<?= old('calories_brulees', $activite['calories_brulees']) ?>" required>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="/activites" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
