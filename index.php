<!-- Initialisation des cookies -->
<?php

// Si l'utilisateur clique sur "Recommencer", les cookies sont détruits
if (isset($_POST['newgame'])){
  setcookie('valeur','', time()-100000);
  setcookie('nombreCoups','',time()-100000);
  Header('Location: index.php');
}

// Les cookies étant détruits, il faut les réinitialiser
if (!isset($_COOKIE['valeur'])){
  setcookie('valeur', rand(0,100));
  setcookie('nombreCoups',0);
  Header('Location: index.php');
} else {
  setcookie('nombreCoups', ($_COOKIE['nombreCoups']+1));
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>More or Less</title>
</head>

<?php

// Initialisation des message d'erreur et de succès
$msgErr = $msgSucc = $msg ="";
// Lorsque l'utilisateur clique sur le bouton submit
if (isset($_POST['submit'])) {
  if(isset($_POST['valeur'])){
// Si la valeur saisie est inférieure, l'ordinateur affiche "C'est plus !"
    if ($_POST['valeur'] < 101 && $_POST['valeur'] >= 0 ) {
      if ($_POST['valeur'] < $_COOKIE['valeur']) {
        $msgErr .="C'est plus !";
// Si la valeur saisie est supérieure, l'ordinateur affiche "C'est moins !"
      } else if ($_POST['valeur'] > $_COOKIE['valeur']) {
        $msgErr .="C'est moins !";
      } else {
// Si la valeur saisie est égale, l'ordinateur affiche "C'est gagné !"
        $msgSucc .= "C'est gagné !";
      }
    } else {
      $msgErr .= "Tapez une valeur comprise entre 0 et 100";
    }
  } else {
//Si l'utilisateur clique sur le bouton sans avoir saisi de valeur, un message d'erreur apparait
    $msgErr .= "Aucune valeur n'a été saisie";
  }
}

?>

<body>
  <!-- Création du formulaire, et affichage du nomnbre de coups joués -->
  <form action="index.php" method="post">
    <label>Saisissez une valeur (entre 0 et 100) : </label>
    <input type="valeur" name="valeur">
    <input type="submit" name="submit">
  </form>
  <p>Nombre de coups joués : <?php echo $_COOKIE['nombreCoups'] ?> </p>
  <span><?php echo "<font color='red'>$msgErr</font>" ;?></span>
  <span><?php echo "<font color='green'>$msgSucc</font>";?></span>
  <?php if ($msgSucc !== ""): ?>
    <form action="index.php" method="post">
      <input type="submit" name="newgame" value="Recommencer">
    </form>
  <?php endif ?>

</body>
</html>
