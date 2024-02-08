<?php
// la fonction include permet d'importer un fichier externe
// include_once obligera à ne charger ce fichier qu'une seule
// et unique fois
include_once("./inc/pdo.php");
// creation une variable pour les messsages d'erreur
$error = "";
// est ce qu'un utilisateur à cliquer sur le submit? 
if (isset($_POST["submitted"])) {
    $email = $_POST['email'];
    $password = $_POST['password']; //mot de passe en clair
    // me permet de tester si l'eamil envoyer dans mon formulaire
    // existe dans ma base de données 
    $rq = "SELECT * FROM user WHERE email = '$email' ";

    $results = $pdo->prepare($rq);
    $results->execute();
    $results = $results->fetch();
    if ($results) {
        //password_verify($password, $passwordVerif) return boolean
        $passwordVerif = $results['password']; //mot de passe hashé qui vient de ma bdd
        if (password_verify($password, $passwordVerif)) {
            header("Location: match.php?email=$email");
            
        } else {
            $error = "Casse toi d'ici!!!!!!!!!!!!!!!!!!!!";
        }
    } else {
        $error = "Casse toi!!!!!!!!!!!!!!!!!!!!";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    hello world

    <?php
    // ici je déclare une variable avec le signe $ attaché
    $unePhrase = "hello world again ! ";
    //echo() est une fonction qui permet d'envoyer des information au client// 
    echo ($unePhrase);
    //var_dump() est l'équivalent de la fonction Javascript console.dir()//
    //mais elle ne peut pas utiliser la console et affiche le restat dans la page web// 
    //dans la page web 
    var_dump($unePhrase);
    ?>
    <h1>Identifiez-vous</h1>
    <form action="login.php" method="post">
        <div><input type="email" name="email"></div>
        <div><input type="password" name="password"></div>
        <div><input type="submit" value="Identifiez-vous" name="submitted"></div>

    </form>
    <div>
        <?php echo ($error); ?>
    </div>
</body>

</html>