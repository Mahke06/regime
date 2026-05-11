<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1><?= $user['nom'] ?></h1>

<div class="user-details">
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>Genre:</strong> <?= ucfirst($user['genre']) ?></p>
    <p><strong>Taille:</strong> <?= $user['taille'] ?> cm</p>
    <p><strong>Poids:</strong> <?= $user['poids'] ?> kg</p>
    <p><strong>IMC:</strong> <?= $user['imc'] ?></p>
    <p><strong>Solde:</strong> <?= number_format($user['solde'], 2) ?>€</p>
    <p><strong>Gold:</strong> <?= $user['gold'] ? '✓ Actif' : '✗ Inactif' ?></p>
    <p><strong>Rôle:</strong> <?= ucfirst($user['roles']) ?></p>
    <p><strong>Date d'inscription:</strong> <?= $user['date_inscription'] ?></p>
</div>

<a href="/users" class="btn btn-secondary">Retour</a>

<?= $this->endSection() ?>
