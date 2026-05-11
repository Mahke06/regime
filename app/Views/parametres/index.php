<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Paramètres</h1>
        <a class="btn btn-primary" href="/parametres/create">Nouveau paramètre</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Clé</th>
                <th>Valeur</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($parametres as $parametre): ?>
                <tr>
                    <td><?= esc($parametre['id']) ?></td>
                    <td><?= esc($parametre['cle']) ?></td>
                    <td><?= esc($parametre['valeur']) ?></td>
                    <td><?= esc($parametre['description'] ?? '') ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="/parametres/edit/<?= esc($parametre['id']) ?>">Modifier</a>
                        <a class="btn btn-sm btn-danger" href="/parametres/delete/<?= esc($parametre['id']) ?>" onclick="return confirm('Supprimer ce paramètre ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
