<!-- 
 ______ _  __     __       __  ____     __       _______ ____  _____  
|  ____| | \ \   / /      |  \/  \ \   / /      |__   __/ __ \|  __ \ 
| |__  | |  \ \_/ /       | \  / |\ \_/ /          | | | |  | | |__) |
|  __| | |   \   /        | |\/| | \   /           | | | |  | |  _  / 
| |    | |____| |         | |  | |  | |            | | | |__| | | \ \ 
|_|    |______|_|         |_|  |_|  |_|            |_|  \____/|_|  \_\
                                                                      
 -->
<?php
   session_start();

   if (isset($_SESSION['id'])) {
     header("location:home.php");
   }else{

   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Torrent </title>
    <link rel="stylesheet" href="css/index_css.css">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.css">
</head>
<body id="body">
<!--  START LOGIN FORM-->
   <div id="login_container">
    <form id="login_form"  method="POST">
       <div id="login_title"></div>
        <input  class="input_form" name="login_username" type="text" class="login_input" placeholder="Username" required="yes" autocomplete="off">
        <input class="input_form" name="login_password" type="password" class="login_input" placeholder="Password" required="yes" autocomplete="off">
        <button type="submit" class="login_btn_login" name="login_submit">Login</button>
        <br>
    </form>
    <button id="show_register_form" class="register_btn_login">Register</button>
   </div>
<!--   FINISH LOGIN FORM-->

<!--  START REGISTER FORM-->
   <div id="register_container">
    <form id="register_form" method="POST">
       <div id="login_title"></div>
        <input class="input_form" name="register_name" type="text" class="login_input" placeholder="Name" required="yes">
        <input class="input_form" name="register_surname" type="text" class="login_input" placeholder="surname" required="yes">
        <input class="input_form" name="register_username" type="text" class="login_input" placeholder="Username" required="yes">
        <input class="input_form" name="register_email" type="text" class="login_input" placeholder="Email" required="yes">
        <input class="input_form" name="register_password" type="password" class="login_input" placeholder="Password" required="yes">
        <br>
        <button name="register_submit" class="register_btn_register">Register</button>
        <br>
    </form>
      <button id="show_login_form" class="login_btn_register">Login</button>
      <br>
   </div>
   <!--  FINISH REGISTER FORM-->
   <div id="resultado"></div>
<!--   SHOW & HIDE REGISTER AND LOGIN FORMS-->
   <script>

        $(document).ready(function(){
          //oom
            $('#show_register_form').click(function(){
                $('#login_container').hide();
                $('#register_container').fadeIn(1000);
            });
            
            $('#show_login_form').click(function(){
                 $('#register_container').hide();
                $('#login_container').fadeIn(1000);
            })
        })
    </script>
    <!--  END SHOW & HIDE REGISTER AND LOGIN FORMS-->

</body>
</html>
<!--START REGISTER CODE-->
<?php
    if(isset($_POST['register_submit'])){

      include 'php/connection.php';
        $name = mysqli_real_escape_string($db_con,$_POST['register_name']);
        $surname = mysqli_real_escape_string($db_con,$_POST['register_surname']); 
        $username = mysqli_real_escape_string($db_con,$_POST['register_username']);
        $email = mysqli_real_escape_string($db_con,  $_POST['register_email']);
        $password = mysqli_real_escape_string($db_con, md5($_POST['register_password']));

       
        if (strlen($name)<5){
          echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Name Must Be At Least 5 Characters</div>";
        }elseif (strlen($surname)<5) {
           echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Surname Must Be At Least 5 Characters</div>";
        }elseif (strlen($username)<5) {
             echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Username Must Be At Least 5 Characters</div>";
        }elseif (strlen($email)<6) {
           echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Email Must Be At Least 6 Characters</div>";
        }elseif (strlen($password)<6) {
             echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Password Must Be At Least 6 Characters</div>";
        }else{

            $check_username = mysqli_query($db_con,"SELECT * FROM users WHERE username ='$username'");
            $check_email = mysqli_query($db_con,"SELECT * FROM users WHERE email = '$email'");

            if (mysqli_num_rows($check_username)>0) {
               echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Username Alredy Exists</div>";
            }elseif (mysqli_num_rows($check_email)>0) {
                
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Email Alredy Exists</div>";
            }else{
              mysqli_query($db_con,"INSERT INTO users(name,surname,username,email,password) values ('$name','$surname','$username','$email','$password')");
              echo "<div class='alert alerta alert-success' role='alert'><strong>NICE !</strong> Registred Correctly <strong>LOG IN </strong></div>";
            }

        }
    }
?>
<!--END REGISTER CODE-->
<!--START LOGIN CODE-->
<?php
if (isset($_POST['login_submit'])) {
    include 'php/connection.php';
    $login_username = mysqli_real_escape_string($db_con,$_POST['login_username']); 
    $login_password = mysqli_real_escape_string($db_con,md5($_POST['login_password'])); 

    $login_query = mysqli_query($db_con,"SELECT * FROM users WHERE username= '$login_username'");

    if ($login_query) {
          
          while ($row = $login_query-> fetch_assoc()) {
              
              $username1 = $row['username'];
              $password1 = $row['password'];
              $name1 = $row['name'];
              $surname1 = $row['surname'];
              $email1 = $row['email'];
              $id1 = $row['id'];

              if ($login_username == $username1 && $login_password == $password1){
                    
                   

                      $_SESSION['id'] = $id1;
                      $_SESSION['name'] = $name1;
                      $_SESSION['surname'] = $surname1;
                      $_SESSION['username'] = $username1;
                      $_SESSION['email'] = $email1;
                      $_SESSION['password'] = $password1;

                    header("location:home.php");
              }else{
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Check your Information</div>";
              }
          }
    }
}
?>
<!--END LOGIN CODE--> 