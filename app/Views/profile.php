<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="profile-page">

        <!-- HEADER -->
        <div class="profile-header">
            <div>
                <h1 class="profile-title">Mon Profil</h1>
                <p class="profile-subtitle">
                    Bienvenue <?= esc($user['nom']) ?>
                </p>
            </div>

            <div class="profile-badge <?= $user['gold'] ? 'gold-active' : 'gold-inactive' ?>">
                <?= $user['gold'] ? '⭐ Gold Actif' : 'Standard' ?>
            </div>
        </div>

        <!-- INFOS -->
        <div class="profile-card profile-section">
            <h3 class="section-title">Informations personnelles</h3>

            <div class="profile-grid">
                <div class="info-box">
                    <span>Email</span>
                    <strong><?= esc($user['email']) ?></strong>
                </div>

                <div class="info-box">
                    <span>Genre</span>
                    <strong><?= ucfirst($user['genre']) ?></strong>
                </div>

                <div class="info-box">
                    <span>Taille</span>
                    <strong><?= esc($user['taille']) ?> cm</strong>
                </div>

                <div class="info-box">
                    <span>Poids</span>
                    <strong><?= esc($user['poids']) ?> kg</strong>
                </div>

                <div class="info-box">
                    <span>IMC</span>
                    <strong><?= esc($user['imc']) ?></strong>
                </div>

                <div class="info-box">
                    <span>Solde</span>
                    <strong><?= number_format($user['solde'], 2) ?> AR</strong>
                </div>
            </div>
        </div>

        <!-- OBJECTIFS -->
        <div class="profile-card profile-section">
            <h3 class="section-title">Mes objectifs</h3>

            <?php if (!empty($objectifs)): ?>
                <div class="objectif-list">
                    <?php foreach ($objectifs as $objectif): ?>
                        <div class="objectif-item">
                             <?= esc($objectif['nom_objectif']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="empty-text">
                    Aucun objectif choisi.
                </p>

                <a href="/objectifs/choose" class="btn btn-primary">
                    Choisir un objectif
                </a>
            <?php endif; ?>
        </div>

        <!-- MODIFIER -->
        <div class="profile-card profile-section">
            <h3 class="section-title">Modifier mon profil</h3>

            <form method="POST" action="/profile/update" class="profile-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text"
                           id="nom"
                           name="nom"
                           value="<?= esc($user['nom']) ?>"
                           required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="taille">Taille (cm)</label>
                        <input type="number"
                               id="taille"
                               name="taille"
                               value="<?= esc($user['taille']) ?>"
                               step="0.1"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="poids">Poids (kg)</label>
                        <input type="number"
                               id="poids"
                               name="poids"
                               value="<?= esc($user['poids']) ?>"
                               step="0.1"
                               required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Mettre à jour
                </button>
            </form>
        </div>

        <!-- WALLET -->
        <div class="profile-card profile-section">
            <h3 class="section-title">Portefeuille</h3>

            <div class="wallet-box">
                <div>
                    <span class="wallet-label">Solde actuel</span>
                    <h2><?= number_format($user['solde'], 2) ?> AR</h2>
                </div>
            </div>

            <form method="POST" action="/codes/redeem" class="promo-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="code">Code promo</label>
                    <input type="text"
                           id="code"
                           name="code"
                           placeholder="Entrez votre code"
                           required>
                </div>

                <button type="submit" class="btn btn-secondary">
                    Valider le code
                </button>
            </form>
        </div>

        <!-- GOLD -->
        <?php if (!$user['gold']): ?>
            <div class="gold-section">
                <div>
                    <h3>Activez Gold Premium</h3>
                    <p>Obtenez 15% de réduction sur tous les régimes.</p>
                </div>

                <a href="/gold/activate" class="btn btn-warning">
                    Activer Gold
                </a>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>