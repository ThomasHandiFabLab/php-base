<?php
/**
 * Inscription de l'utilisateur
 * Etape 1 : Créer une nouvelle table user dans la base de données avec PHPMyAdmin.
 *           On va créer les colonnes id (INT auto_increment), email (VARCHAR) et password (VARCHAR).
 * Etape 2 : Ajouter un formulaire sur cette page pour que l'utilisateur puisse s'inscrire.
 *           On aura trois champs : email, password, et confirm-password.
 *           Pour être valide, l'email devra être un email valide. Le mot de passe devra correspondre au second
 *           champ de confirmation de mot de passe. (BONUS: Carmelo nous propose de valider le mot de passe
 *           avec un minimum de 8 caractères contenant au moins un chiffre et un caractère spécial).
 * Etape 3 : Avec les données du formulaire, insérer le nouvel d'utilisateur dans la base de données.
 */
require_once __DIR__ . '/../partials/header.php';
$email = null;
$password = null;
$cfpassword = null;
if (!empty($_POST)) { // Si on a soumis le formulaire
    $email = $_POST['email'];
    $password = trim($_POST['password']); // trim enlève les espaces au début et à la fin de la chaine
    $cfpassword = trim($_POST['cfpassword']);
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // On vérifie que l'email soit valide
        $errors['email'] = 'L\'email n\'est pas valide.';
    }
    // Vérification mot de passe
    if (empty($password) || $password != $cfpassword) {
        $errors['password'] = 'Les mots de passe sont vides ou ne correspondent pas.';
    }
    // Vérification de la force du mot de passe
    // - Au moins 8 caractères
    // - Un chiffre
    // - Un caractère spécial
    if (!preg_match('/(.){8,}/', $password)) {
        $errors['password'] = 'Le mot de passe n\'est pas assez long (8 caractères).';
    }
    if (!preg_match('/[0-9]+/', $password)) {
        $errors['password'] = 'Le mot de passe doit contenir un chiffre.';
    }
    if (!preg_match('/[^a-zA-Z0-9]+/', $password)) {
        $errors['password'] = 'Le mot de passe doit contenir un caractère spécial.';
    }
    // Inscription de l'utilisateur
    if (empty($errors)) {
        $query = $db->prepare('INSERT INTO user (email, password) VALUES (:email, :password)');
        $query->bindValue(':email', $email);
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        if ($query->execute()) {
            echo '<div class="alert alert-success">Vous êtes inscrit.</div>';
        }
    }
}
?>

<div class="container my-5">
    <h1 class="text-center">Inscription</h1>
    <div class="row">
        <div class="col-md-6 offset-3">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cfpassword">Confirmer le mot de passe</label>
                    <input type="password" name="cfpassword" id="cfpassword" class="form-control">
                </div>
                <button class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php';
