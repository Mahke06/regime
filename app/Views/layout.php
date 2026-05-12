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

<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background: rgba(16,185,129,0.06);">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
            <i class="bi bi-leaf-fill" style="color:var(--brand-1); font-size:1.2rem"></i>
            <span style="color:var(--ink-1);">Régime Santé</span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <?php if (session()->get('user_id')): ?>

                    <?php if (session()->get('roles') === 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/dashboard">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown">Gestion</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/users">Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="/regimes">Régimes</a></li>
                                <li><a class="dropdown-item" href="/activites">Activités</a></li>
                                <li><a class="dropdown-item" href="/codes">Codes</a></li>
                                <li><a class="dropdown-item" href="/parametres">Paramètres</a></li>
                            </ul>
                        </li>

                        <li class="nav-item ms-2">
                            <span class="nav-link text-success"><i class="bi bi-person-circle"></i> <?= esc(session()->get('nom')) ?></span>
                        </li>

                    <?php else: ?>

                        <li class="nav-item"><a class="nav-link text-dark" href="/suggestions"><i class="bi bi-lightbulb me-1"></i> Suggestions</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="/objectifs/choose"><i class="bi bi-bullseye me-1"></i> Objectifs</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="/gold/activate"><i class="bi bi-gem me-1"></i> Gold</a></li>
                        <li class="nav-item ms-2"><span class="nav-link fw-semibold text-dark"><i class="bi bi-wallet2"></i> <?= number_format(session()->get('solde'), 2) ?> €</span></li>

                    <?php endif; ?>

                    <li class="nav-item ms-2"><a class="nav-link text-dark" href="/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>

                <?php else: ?>

                    <li class="nav-item"><a class="nav-link text-dark" href="/login">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/register">Inscription</a></li>

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
