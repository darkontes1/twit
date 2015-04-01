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

    //var_dump($_SESSION);
    //bouton prec est appuyé
    if(isset($_POST['prec'])){
        //echo '##';
        $_SESSION['nb'] -= 5;
        if($_SESSION['nb'] < 0){
            $_SESSION['nb'] = 0;
        }
        //header('location: index_pdo.php');
    }
    //bouton suiv apppuyé
    elseif(isset($_POST['suiv'])){
        //echo '--';
        $_SESSION['nb'] += 5;
        //header('location: index_pdo.php');
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
    //Bouton de retweet est appuyé
    if(isset($_GET['action'])){
        $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        if(isset($_GET['idTwit'])){
            $idT = filter_input(INPUT_GET,'idTwit',FILTER_SANITIZE_NUMBER_INT);
            if($action == "retwit"){
                //echo('retwit');
                $idU = $_SESSION['id'];
                $query = 'SELECT U.idUser, dateTwit
                        FROM users U 
                        JOIN reltwitusers R ON R.idUser = U.idUser 
                        WHERE idTwit = "'.$idT.'"
                        ORDER BY dateTwit ASC';
                $data = $db->prepare($query);
                $data->execute();
                $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $query = 'INSERT INTO reltwitusers(idUser, idTwit,retwit,origin) VALUES ('.$idU.','.$idT.',1,'.$result[0]['idUser'].')';
                $data = $db->prepare($query);
                $data->execute();
                //var_dump($data);
            }
        }
    }

    //Bouton Favori appuyé
    if(isset($_GET['action'])){
        $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        if(isset($_GET['idTwit'])){
            $idT = filter_input(INPUT_GET,'idTwit',FILTER_SANITIZE_NUMBER_INT);
            $idU = $_SESSION['id'];
            if($action == "favori"){
                $query = 'SELECT * FROM favori WHERE idTwit = "'.$idT.'" AND idUser = "'.$idU.'"';
                $data = $db->prepare($query);
                $data->execute();
                $result = $data->fetchAll(PDO::FETCH_ASSOC);
                if(count($result)>0){
                    $query = 'DELETE FROM favori WHERE idUser = "'.$idU.'" AND idTwit = "'.$idT.'"';
                    $data = $db->prepare($query);
                    $data->execute(); 
                    //echo ('delete');name="valueCo"
                }
                else{
                    //echo $idU.'-'.$idT;
                    $query = 'INSERT INTO favori(idUser, idTwit) VALUES (:idU, :idT)';
                    $tab = array('idU'=>$idU,
                            'idT'=>$idT);
                    $data = $db->prepare($query);
                    $data->execute($tab);
                    //echo ('add');
                }    
            }
        }      
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Twitter</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <a id="titre">TWITR©</a>
        <div id="container">
            <form id="myform" method="post" action="index_pdo.php">
                <?php
                if($_SESSION['connect']==FALSE){
                ?>
                <label>login</label><input type="text" id="valueCo" name="valueCo" required>
                <input type="submit" id="co" name="co" value="connection"/>
                <?php
                }
                if($_SESSION['connect']==TRUE){
                ?>
                <h2>Connecté sous : <?php echo $_SESSION['login']; ?></h2><br/>
                <input type="submit" id="deco" name="deco" value="deconnection"/>
                <?php
                }
                ?>
            </form>
            <?php
                if($_SESSION['login']==$meow){
                    echo 'Veuillez vous connecter :3';
                }
                else{
                    ?>
                    <nav>
                        <ul>
                            <li><a class="bouton-action" id="page_ret" href="page_ret.php">Go page de nos retwits</a></li>
                            <li><a class="bouton-action" id="page_fav" href="page_fav.php">Go page de nos favoris</a></li><br/>
                        </ul>
                    </nav>
                <?php
                //var_dump($_SESSION);
                //Les erreurs en PDO sont des exceptions donc on les gère(On est en POO)
                /*
                En mysqli et pdo : $query = 'SELECT * FROM users WHERE idUser = ? AND nameUser = ?'
                $tab = array(7,'toto');
                prepare($tab);
                execute
                En pdo : $query = 'SELECT * FROM users WHERE idUser = :id AND nameUser = :name'
                $tab = array('id' => 7, 'name' => 'toto');
                prepare($query);
                exec($tab);
                */
                //$query = 'SELECT * FROM users WHERE idUser = :id';
                //1ère solution
                //$tab = array('id'=>1);
                //$data = $db->prepare($query);
                //$data->execute($tab);
                //var_dump($db);
                //var_dump($data);
                //2eme solution
                /*$idUser = '1';
                $data = $db->prepare($query);
                $data->bindParam(':id',$idUser, PDO::PARAM_INT);
                $data->execute();*/
                //$result = $data->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($result);
                /*for($i=0;$i<10;$i++){
                    $query = 'INSERT INTO twit(messageTwit) VALUES (:message)';
                    $tab = array('message'=>'Twit automatique pour remplir la BDD '.$i);
                    $data = $db->prepare($query);
                    $data->execute($tab);
                    $result = $data->fetchAll(PDO::FETCH_ASSOC);
                    $query = 'INSERT INTO reltwitusers(idUser,idTwit) VALUES (:idU,:idT)';
                    $tab = array('idU'=>2,
                        'idT'=>$db->lastInsertId());
                    $data = $db->prepare($query);
                    $data->execute($tab);
                    $result = $data->fetchAll(PDO::FETCH_ASSOC);
                }*/
                $query = 'SELECT loginUser,nomUser,SUBSTRING(messageTwit,1,20) AS messageTwit,dateTwit
                        FROM users U 
                        JOIN reltwitusers R ON R.idUser = U.idUser 
                        JOIN twit T ON T.idTwit = R.idTwit
                        ORDER BY dateTwit DESC';
                $data = $db->prepare($query);
                $data->execute();
                $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $tailleMAX = count($result);
                //var_dump($tailleMAX);

                $query = 'SELECT T.idTwit,loginUser,nomUser,SUBSTRING(messageTwit,1,20) AS messageTwit,dateTwit
                        FROM users U 
                        JOIN reltwitusers R ON R.idUser = U.idUser 
                        JOIN twit T ON T.idTwit = R.idTwit
                        ORDER BY dateTwit DESC
                        LIMIT :nb1, :nb2';
                //$tab2 = array('nb1' => $_SESSION['nb'],
                //       'nb2' => $_SESSION['nb']+5);
                //var_dump($tab2);
                $data = $db->prepare($query);
                $data->bindValue('nb1',$_SESSION['nb'],PDO::PARAM_INT);
                $data->bindValue('nb2',5,PDO::PARAM_INT);
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
                            echo '<article>';
                            echo '<div id="top-article">';
                            echo '<p><b>'.date('j-m-y',strtotime($result[$i]['dateTwit'])).'</b>';
                            echo '<br/>'.date('H:i:s',strtotime($result[$i]['dateTwit'])).'</p>';
                            echo '</div>';
                            echo '<p>'.$result[$i]['messageTwit'].'...<br/>@'.$result[$i]['loginUser'].'</p>';

                            //IMPORTANT !!! syntaxe d'un get à la place de faire un form pour une action
                            echo '<a class="bouton-action" href="index_pdo.php?action=modifier&idTwit='.$result[$i]['idTwit'].'">modifier</a>';
                            echo '<a class="bouton-action" href="index_pdo.php?action=supprimer&idTwit='.$result[$i]['idTwit'].'">supprimer</a>';
                            echo '</article>';
                        }
                        else{
                            echo '<article>';
                            echo '<div id="top-article">';
                            echo '<p><b>'.date('j-m-y',strtotime($result[$i]['dateTwit'])).'</b>';
                            echo '<br/>'.date('H:i:s',strtotime($result[$i]['dateTwit'])).'</p>';
                            echo '</div>';
                            echo '<p>'.$result[$i]['messageTwit'].'...<br/>@'.$result[$i]['loginUser'].'</p>';
                            //IMPORTANT !!! syntaxe d'un get à la place de faire un form pour une action
                            echo '<a href=" class="bouton-action" index_pdo.php?action=retwit&idTwit='.$result[$i]['idTwit'].'">retwit</a>';
                            //Si il est favori
                            $query = 'SELECT * FROM favori WHERE idUser = "'.$_SESSION['id'].'" AND idTwit = "'.$result[$i]['idTwit'].'"';
                            $data = $db->prepare($query);
                            $data->execute();
                            $result2 = $data->fetchAll(PDO::FETCH_ASSOC);
                            if(count($result2)>0){
                                echo '<a class="bouton-action" href="index_pdo.php?action=favori&idTwit='.$result[$i]['idTwit'].'">favori</a>';
                            }
                            else{
                                echo '<a class="bouton-action" href="index_pdo.php?action=favori&idTwit='.$result[$i]['idTwit'].'">favori</a>';
                            }
                            echo '</article>';
                        }
                    }
                }
            ?>
            <form method="post" action="index_pdo.php">
                <?php
                if($_SESSION['nb']!=0){
                ?>
                    <input type="submit" id="prec" name="prec" value="precedent"/>
                <?php
                }
                $tailleX = $tailleMAX-4;
                if($_SESSION['nb']<$tailleX){
                ?>
                    <br/>
                    <input type="submit" id="suiv" name="suiv" value="suivant"/>
                <?php
                }
                ?>
            </form>
        </div>
    </body>
</html>
<?php
    }
    /*while($row = $data->fetch(PDO::FETCH_ASSOC)){
        echo $row->loginUser." ".$row->nomUser." ".$row->messageTwit."<br/>";
    }*/
?>
