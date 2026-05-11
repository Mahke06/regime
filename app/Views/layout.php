<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Régime App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Régime App</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('user_id')): ?>
                        <?php if (session()->get('roles') === 'admin'): ?>
                            <!-- Menu Admin -->
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown">
                                    ⚙️ Gestion
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminMenu">
                                    <li><a class="dropdown-item" href="/users">Utilisateurs</a></li>
                                    <li><a class="dropdown-item" href="/activites">Activités</a></li>
                                    <li><a class="dropdown-item" href="/regimes">Régimes</a></li>
                                    <li><a class="dropdown-item" href="/codes">Codes Promo</a></li>
                                    <li><a class="dropdown-item" href="/objectifs">Objectifs</a></li>
                                    <li><a class="dropdown-item" href="/parametres">Paramètres</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" style="color: #ffc107;">
                                    👤 <?php echo htmlspecialchars(session()->get('nom')); ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/logout">Déconnexion</a>
                            </li>
                        <?php else: ?>
                            <!-- Menu Utilisateur -->
                            <li class="nav-item">
                                <a class="nav-link" href="/profile">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/objectifs/choose">Objectifs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/suggestions">Suggestions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/gold/activate">Gold</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link" style="color: #28a745;">
                                    Solde: <?php echo number_format(session()->get('solde'), 2); ?> €
                                </span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Déconnexion</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Menu Non connecté -->
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Messages Flash -->
    <div class="container mt-3">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✓ <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ✕ <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('info')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                ℹ️ <?= session()->getFlashdata('info') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>⚠️ Erreurs :</strong>
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Contenu -->
    <main>
        <?php echo $this->renderSection('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 Régime App - Tous droits réservés</p>
            <small>Une application de gestion de régimes et d'activités physiques</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
