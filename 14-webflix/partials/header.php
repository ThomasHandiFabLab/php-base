<?php
  // Démarrer la session PHP
  session_start();
  // Inclus les fichiers de configuration du site
  require_once __DIR__ . '/../config/functions.php';
  require_once __DIR__ . '/../config/config.php';
  require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php"><?php echo $siteName; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <?php
          // Gestion du menu dynamique
          $menuItems = [
            ['label' => 'Films', 'link' => 'index.php'],
            ['label' => 'Catégories', 'link' => 'category_list.php']
          ];
        ?>

        <ul class="navbar-nav mr-auto">
          <?php foreach ($menuItems as $item) { ?> 
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $item['link']; ?>">
                <?php echo $item['label']; ?>
              </a>
            </li>
          <?php } ?>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <?php
                /**
                 * On se rend sur https://fr.gravatar.com/site/implement/images/
                 * On peut créer un compte et y associer un avatar (lié à notre email).
                 * On doit générer un hash de notre email avec md5().
                 * On peut ensuite afficher une balise <img> avec un lien vers notre gravatar.
                 */

                $hash = md5($_SESSION['user']['email']);
                echo $_SESSION['user']['email'];         
                ?>
                <img width="40" src="https://www.gravatar.com/avatar/<?= $hash; ?>" alt="Photo de votre avatar"/>
              </a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="sign-up.php">
                Sign up
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">
                Login
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>