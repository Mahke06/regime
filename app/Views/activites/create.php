<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="hero-panel mb-4">
        <h1 class="h3 fw-bold mb-1">Ajouter une Activité</h1>
        <p class="text-muted mb-0">Ajoutez une activité sportive avec sa catégorie et ses calories.</p>
    </div>

    <form method="POST" action="/activites/store" class="card p-4">
        <div class="card-body">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= old('nom') ?>" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="types" class="form-label">Type</label>
                    <select id="types" name="types" class="form-select" required>
                        <option value="">Sélectionnez</option>
                        <option value="perte_poids" <?= old('types') === 'perte_poids' ? 'selected' : '' ?>>Perte de Poids</option>
                        <option value="prise_poids" <?= old('types') === 'prise_poids' ? 'selected' : '' ?>>Prise de Poids</option>
                        <option value="maintien" <?= old('types') === 'maintien' ? 'selected' : '' ?>>Maintien</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="calories_brulees" class="form-label">Calories Brûlées</label>
                    <input type="number" id="calories_brulees" name="calories_brulees" value="<?= old('calories_brulees') ?>" class="form-control" required>
                </div>

                <div class="col-12 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <a href="/activites" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
