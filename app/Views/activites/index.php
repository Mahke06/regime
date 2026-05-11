<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gestion des Activités</h1>

<a href="/activites/create" class="btn btn-primary">Ajouter une Activité</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Calories Brûlées</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activites as $activite): ?>
            <tr>
                <td><?= $activite['id'] ?></td>
                <td><?= $activite['nom'] ?></td>
                <td><?= $activite['types'] ?></td>
                <td><?= $activite['calories_brulees'] ?></td>
                <td>
                    <a href="/activites/edit/<?= $activite['id'] ?>" class="btn btn-warning">Éditer</a>
                    <a href="/activites/delete/<?= $activite['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
