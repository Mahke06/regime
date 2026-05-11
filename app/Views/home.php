<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="hero">
    <h1>Bienvenue sur Régime App</h1>
    <p>Trouvez le régime alimentaire adapté à vos objectifs</p>

    <?php if (!session()->get('user_id')): ?>
        <a href="/register" class="btn btn-primary">S'inscrire</a>
        <a href="/login" class="btn btn-secondary">Se connecter</a>
    <?php else: ?>
        <a href="/profile" class="btn btn-primary">Mon Profil</a>
        <?php if (session()->get('roles') === 'user'): ?>
            <a href="/objectifs/choose" class="btn btn-secondary">Mes Objectifs</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

<section class="features">
    <h2>Nos Services</h2>
    
    <div class="feature">
        <h3>Inscription Simple</h3>
        <p>Créez votre compte en 2 étapes simples avec vos informations personnelles et de santé</p>
    </div>

    <div class="feature">
        <h3>Calcul de l'IMC</h3>
        <p>Notre système calcule automatiquement votre Indice de Masse Corporelle</p>
    </div>

    <div class="feature">
        <h3>Régimes Personnalisés</h3>
        <p>Découvrez des régimes adaptés à vos objectifs et à votre morphologie</p>
    </div>

    <div class="feature">
        <h3>Suivi d'Activités</h3>
        <p>Consultez nos activités sportives recommandées pour atteindre vos buts</p>
    </div>

    <div class="feature">
        <h3>Portefeuille Sécurisé</h3>
        <p>Gérez votre solde et utilisez des codes promo pour le recharger</p>
    </div>

    <div class="feature">
        <h3>Option Gold Premium</h3>
        <p>Profitez de 15% de remise sur tous les régimes avec l'abonnement Gold</p>
    </div>
</section>

<?= $this->endSection() ?>
