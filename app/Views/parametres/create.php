<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau paramètre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="h3 mb-3">Nouveau paramètre</h1>

    <form method="post" action="/parametres/store" class="card card-body">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Clé</label>
            <input type="text" name="cle" class="form-control" value="<?= old('cle') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Valeur</label>
            <input type="text" name="valeur" class="form-control" value="<?= old('valeur') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
            <a class="btn btn-secondary" href="/parametres">Retour</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
