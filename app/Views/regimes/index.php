<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Gestion des Régimes</h1>

<a href="/regimes/create" class="btn btn-primary">Ajouter un Régime</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>% Viande</th>
            <th>% Poisson</th>
            <th>% Volaille</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($regimes as $regime): ?>
            <tr>
                <td><?= $regime['id'] ?></td>
                <td><?= $regime['nom'] ?></td>
                <td><?= $regime['pourcentage_viande'] ?>%</td>
                <td><?= $regime['pourcentage_poisson'] ?>%</td>
                <td><?= $regime['pourcentage_volaille'] ?>%</td>
                <td>
                    <a href="/regimes/edit/<?= $regime['id'] ?>" class="btn btn-warning">Éditer</a>
                    <a href="/regimes/manage-prices/<?= $regime['id'] ?>" class="btn btn-info">Gérer Prix</a>
                    <a href="/regimes/delete/<?= $regime['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
