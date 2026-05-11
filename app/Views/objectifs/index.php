<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gestion des Objectifs</h1>

<a href="/objectifs/create" class="btn btn-primary">Ajouter un Objectif</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($objectifs as $objectif): ?>
            <tr>
                <td><?= $objectif['id'] ?></td>
                <td><?= $objectif['nom_objectif'] ?></td>
                <td>
                    <a href="/objectifs/edit/<?= $objectif['id'] ?>" class="btn btn-warning">Éditer</a>
                    <a href="/objectifs/delete/<?= $objectif['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
