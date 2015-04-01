<?php
session_start();
    $meow = 'Meow_kitty_cat';
    if(empty($_SESSION)){  //Préférer utiliser empty plutôt que isset pour les session car un session_start déclare une fonction directement
        $_SESSION['nb'] = 0;
        $_SESSION['connect'] = FALSE;
        $_SESSION['login'] = $meow;
        $_SESSION['id'] = -1;
        $_SESSION['idTwit'] = '';
    }
    try{
    //Syntaxe init PDO => $host;$BDD,$name,$mdp
        $db = new PDO('mysql:host=localhost;dbname=twitr','root','');
    } catch(PDOException $ex){
       echo '<br/>';
       echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
       echo $ex->getMessage();
       exit();
    }

    //var_dump($_SESSION);
    //Bouton de connection est appuyé
    if(isset($_POST['co'])){
        $login = filter_input(INPUT_POST,'valueCo',FILTER_SANITIZE_STRING);
        $query = 'SELECT * FROM users WHERE loginUser = "'.$login.'"';
        $data = $db->prepare($query);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if(count($result)>0){
            $_SESSION['connect'] = TRUE;
            $_SESSION['login'] = $login;
            $_SESSION['id'] = (int)$result[0]['idUser'];
        }
    }
    //Bouton de déco est appuyé
    if(isset($_POST['deco'])){
        $_SESSION['connect'] = FALSE;
        $_SESSION['login'] = $meow;
        $_SESSION['nb'] = 0;
        $_SESSION['message'] = '';
        $_SESSION['id'] = -1;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Twitter</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<form method="post" action="index_pdo.php">
    <?php
    if($_SESSION['connect']==FALSE){
        echo '<label>login</label><input type="text" name="valueCo" required>';
        echo '<input type="submit" name="co" value="connection"/>';
    }
    if($_SESSION['connect']==TRUE){
        echo '<h2>connecte sous : '.$_SESSION['login'].'</h2><br/>';
        echo '<input type="submit" name="deco" value="deconnection"/>';
    }
    ?>
</form>
<?php
    if($_SESSION['login']==$meow){
        echo 'Veuillez vous connecter :3';
    }
    else{
        echo '<a class="bouton-action" href="index_pdo.php">Go page de tous les twits</a>';
        echo '<a class="bouton-action" href="page_fav.php">Go page de nos favoris</a>';

    $query = 'SELECT T.idTwit,loginUser,nomUser,SUBSTRING(messageTwit,1,20) AS messageTwit,dateTwit,origin
            FROM users U 
            JOIN reltwitusers R ON R.idUser = U.idUser 
            JOIN twit T ON T.idTwit = R.idTwit
            WHERE retwit = 1
            ORDER BY dateTwit DESC';
    //$tab2 = array('nb1' => $_SESSION['nb'],
    //       'nb2' => $_SESSION['nb']+5);
    //var_dump($tab2);
    $data = $db->prepare($query);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($result);
    $taille = count($result);
    

    if($taille==0){
        $_SESSION['nb'] = 0;
        echo 'PAS DE TWEET DANS LA BASE !';
        header('location: index_pdo.php');
    }
    else{
        for($i=0;$i<$taille;$i++){
            if($_SESSION['login']==$result[$i]['loginUser']){
                /*$query = 'SELECT loginUser FROM reltwitusers R JOIN users U ON U.idUser = R.idUser WHERE U.idUser = "'.$result[$i]['origin'].'"';
                $data = $db->prepare($query);
                $data->execute();
                $result2 = $data->fetchAll(PDO::FETCH_ASSOC);*/
                echo '<article>';
                echo '<div id="top-article">';
                echo '<p><b>'.date('j-m-y',strtotime($result[$i]['dateTwit'])).'</b>';
                echo '<br/>'.date('H:i:s',strtotime($result[$i]['dateTwit'])).'</p>';
                echo '<p>'.$result[$i]['messageTwit'].'...<br/>retwitter par : @'.$result[$i]['loginUser'].'</p>';
                echo '</div>';
                //echo '<p>twit de : '.$result[0]['loginUser'].'</p>';
                //IMPORTANT !!! syntaxe d'un get à la place de faire un form pour une action
                echo '<a class="bouton-action" href="index_pdo.php?action=modifier&idTwit='.$result[$i]['idTwit'].'">modifier</a>';
                echo '<a class="bouton-action" href="index_pdo.php?action=supprimer&idTwit='.$result[$i]['idTwit'].'">supprimer</a>';
                echo '</article><br/>';
            }
        }
    }

    }
?>