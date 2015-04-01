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
        echo '<a href="index_pdo.php">Go page de tous les twits</a><br/>';
        echo '<a href="page_ret.php">Go page de nos retwits</a><br/>';

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
                    echo '<article style="border:1px solid skyblue; width:200px; padding:5px;">';
                    echo '<p><b>'.date('j-m-y',strtotime($result[$i]['dateTwit'])).'</b><br/>'.date('H:i:s',strtotime($result[$i]['dateTwit'])).'</p>';
                    echo '<p>'.$result[$i]['messageTwit'].'...<br/>@'.$result[$i]['loginUser'].'-'.$result[$i]['idTwit'].'</p>';
                    echo '</article><br/>';
                }
            }
        }
    }

    }
?>