<?php
//session_start();
//session_destroy();
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

    //Bouton de connection est appuyé
    /*if(isset($_POST['co'])){
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
    }*/
    if(isset($_POST['action']) && $_POST['action']=="co"){
        $login = $_POST['login'];
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
    /*if(isset($_POST['deco'])){
        $_SESSION['connect'] = FALSE;
        $_SESSION['login'] = $meow;
        $_SESSION['nb'] = 0;
        $_SESSION['message'] = '';
        $_SESSION['id'] = -1;
    }*/
    if(isset($_POST['action']) && $_POST['action']=="deco"){
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
        <title>Twitter</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="container">
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
                    echo '<nav>';
                    echo '<ul>';
                    echo '<li>';
                    echo '<a class="bouton-action" href="index_pdo.php">Go page de tous les twits</a>';
                    echo '</li>';
                    echo '<li>';
                    echo '<a class="bouton-action" href="page_ret.php">Go page de nos retwits</a>';
                    echo '</li>';
                    echo '</ul>';
                    echo '</nav><br/><br/><br/>';

                    $query = 'SELECT DISTINCT T.idTwit,loginUser,nomUser,SUBSTRING(messageTwit,1,20) AS messageTwit,dateTwit,origin
                            FROM users U 
                            JOIN reltwitusers R ON R.idUser = U.idUser 
                            JOIN twit T ON T.idTwit = R.idTwit
                            JOIN favori F ON F.idUser = U.idUser
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
                                $query = 'SELECT * FROM favori WHERE idUser = "'.$_SESSION['id'].'" AND idTwit = "'.$result[$i]['idTwit'].'"';
                                $data = $db->prepare($query);
                                $data->execute();
                                $result2 = $data->fetchAll(PDO::FETCH_ASSOC);
                                if(count($result2)>0){
                                    echo '<article>';
                                    echo '<div id="top-article">';
                                    echo '<p><b>'.date('j-m-y',strtotime($result[$i]['dateTwit'])).'</b>';
                                    echo '<br/>'.date('H:i:s',strtotime($result[$i]['dateTwit'])).'</p>';
                                    echo '</div>';
                                    echo '<p>'.$result[$i]['messageTwit'].'...<br/>@'.$result[$i]['loginUser'].'-'.$result[$i]['idTwit'].'</p>';
                                    echo '</article>';
                                }
                            }
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>