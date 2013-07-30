<?php

include_once 'php/conn.php';
include_once 'php/functions.php';

//setup some variables/arrays
$action = array();
$action['result'] = null;

$text = array();

//check if the form has been submitted
if(isset($_POST['signup'])){

    //cleanup the variables
    //prevent mysql injection
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $email = mysql_real_escape_string($_POST['email']);
    
    //quick/simple validation
    if(empty($username)){ $action['result'] = 'error'; array_push($text,'You forgot your username'); }
    if(empty($password)){ $action['result'] = 'error'; array_push($text,'You forgot your password'); }
    if(empty($email)){ $action['result'] = 'error'; array_push($text,'You forgot your email'); }
    
    if($action['result'] != 'error'){
                
        $password = md5($password); 
            
        //add to the database
        $add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
        
        if($add){
            
            //get the new user id
            $userid = mysql_insert_id();
            
            //create a random key
            $key = $username . $email . date('mY');
            $key = md5($key);
            
            //add confirm row
            $confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')"); 
            
            if($confirm){
            
                //include the swift class
                include_once 'inc/php/swift/swift_required.php';
            
                //put info into an array to send to the function
                $info = array(
                    'username' => $username,
                    'email' => $email,
                    'key' => $key);
            
                //send the email
                if(send_email($info)){
                                
                    //email sent
                    $action['result'] = 'success';
                    array_push($text,'Thanks for signing up. Please check your email for confirmation!');
                
                }else{
                    
                    $action['result'] = 'error';
                    array_push($text,'Could not send confirm email');
                
                }
            
            }else{
                
                $action['result'] = 'error';
                array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
                
            }
            
        }else{
        
            $action['result'] = 'error';
            array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
        
        }
    
    }
    
    $action['text'] = $text;

}

?>

<!DOCTYPE html>
<html lang="pt-BR" class="no-js">

    <head>

        <title>ABVET - Associação Brasileira de Veterinários Especialistas</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="js/jquery/jquery.js"></script>
        <script src="js/modernizr/modernizr-latest.js"></script>
        <script src="js/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/bootstrap/js/bootstrap-select.min.js"></script>
        <script src="http://underscorejs.org/underscore-min.js"></script>
        <script src="http://j.maxmind.com/app/geoip.js" charset="ISO-8859-1" type="text/javascript" ></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="js/app.js"></script>

        <link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="js/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="css/app.css">

        <style>
            #mapa { width:420px; height:420px; display:none; }
        </style>


    </head>

    <body>

        <?php require_once ('navbar.html'); ?>

        <!-- Button to trigger modal -->
        <a href="#myModal" role="button" class="btn" data-toggle="modal">Executar modal de demo</a>
         
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
          </div>
          <div class="modal-body">
            <p>Um corpo fino …</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
            <button class="btn btn-primary">Salvar mudanças</button>
          </div>
        </div>   

    </body>

</html>