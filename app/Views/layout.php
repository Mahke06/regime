<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title : 'Régime App' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="site">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            Régime App
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <?php if (session()->get('user_id')): ?>

                    <?php if (session()->get('roles') === 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle"
                               href="#"
                               id="adminMenu"
                               role="button"
                               data-bs-toggle="dropdown">

                                Gestion
                            </a>

                            <ul class="dropdown-menu">

                                <li>
                                    <a class="dropdown-item" href="/users">
                                        Utilisateurs
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/activites">
                                        Activités
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/regimes">
                                        Régimes
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/codes">
                                        Codes Promo
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/objectifs">
                                        Objectifs
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/parametres">
                                        Paramètres
                                    </a>
                                </li>

                            </ul>

                        </li>

                        <li class="nav-item">
                            <span class="nav-link text-warning">
                                <i class="bi bi-person-circle"></i>
                                <?= esc(session()->get('nom')) ?>
                            </span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">
                                Déconnexion
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/profile">
                                Profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/objectifs/choose">
                                Objectifs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/suggestions">
                                Suggestions
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/gold/activate">
                                Gold
                            </a>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link text-success">
                                Solde :
                                <?= number_format(session()->get('solde'), 2) ?> €
                            </span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/logout">
                                Déconnexion
                            </a>
                        </li>

                    <?php endif; ?>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            Connexion
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/register">
                            Inscription
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>
</nav>

<div class="container mt-3">

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= session()->getFlashdata('success') ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?= session()->getFlashdata('error') ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>

</div>

<main>

    <?= $this->renderSection('content') ?>

</main>

<footer class="site-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div class="footer-left text-center text-md-start">
            <strong>&copy; 2026 Régime App</strong>
            <div class="small text-muted">Application de gestion de régimes</div>
        </div>

        <div class="footer-right text-center text-md-end">
            <a href="/" class="text-muted me-3 footer-link">Accueil</a>
            <a href="/profile" class="text-muted me-3 footer-link">Profil</a>
            <a href="/suggestions" class="text-muted footer-link">Suggestions</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
