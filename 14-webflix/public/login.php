
<?php require_once __DIR__ . '/../partials/header.php';
// Traitement du login
$email = null;
$password = null;
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // On récupère l'utilisateur associé à l'email saisi
    $query = $db->prepare('SELECT * FROM user WHERE email = :email');
    $query->bindValue(':email', $email);
    $query->execute();
    $user = $query->fetch();
    if ($user) { // Si l'utilisateur existe, on va vérifier que le mot de passe est correct
        var_dump($user);
        var_dump($password);
        $hash = $user['password']; // On récupère le hash du user
        if (password_verify($password, $hash)) { // On vérifie si le mot de passe correspond au hash
            $_SESSION['user'] = $user;
            echo 'OK';
        } else {
            echo 'KO';
        }
    } else {
        echo 'L\'utilisateur n\'existe pas.';
    }
}
?>

<div class="container my-5">
    <h1 class="text-center">Connexion</h1>
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
                <button class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php';