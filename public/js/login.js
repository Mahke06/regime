document.addEventListener('DOMContentLoaded', function () {
	var toggleButton = document.getElementById('toggle-password');
	var passwordField = document.getElementById('mot_de_passe');
	var form = document.getElementById('login-form');
	var submitButton = document.getElementById('login-submit');

	if (toggleButton && passwordField) {
		toggleButton.addEventListener('click', function () {
			var isHidden = passwordField.type === 'password';
			passwordField.type = isHidden ? 'text' : 'password';
			toggleButton.textContent = isHidden ? 'Masquer' : 'Afficher';
		});
	}

	if (form && submitButton) {
		form.addEventListener('submit', function () {
			submitButton.disabled = true;
			submitButton.textContent = 'Connexion en cours...';
		});
	}
});
