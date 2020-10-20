<?php

    $error = "";
    $success = "";
    if(array_key_exists("submit",$_POST))
    {
        $link = mysqli_connect("localhost","sumanth","","ospforms");
        if(mysqli_connect_error()){
            die("Database connection Error");
        }

        if(!$_POST['email'])
        {
            
            $error .= "An email address is required<br>";
        }
        if(!$_POST['password'])
        {
            
            $error .= "A password is required<br>";
        }

        if($error!="")
        {
            
            $error = "<p>There is an error in your form</p>".$error;
        }
        else
        {
 
                $query = "SELECT * FROM admin WHERE AEID = '".mysqli_real_escape_string($link,$_POST['email'])."'";
                
                $result = mysqli_query($link,$query);
                
                if($result)
                {
                    header("Location: index.php");
                }
                else
                {
                    $error .= "No such combination exist";
                }
                /*
                $row = mysqli_fetch_array($result);

                if(isset($row))
                {
                    $hashedpassword = $row["AID"].$_POST['password'];

                    if($hashedpassword == $row['APASS'])
                    {
                        // change location to ADMIN dashboard
                        header("Location: index.php");
                    }
                    else
                    {
                    $error .= "The entered email/password combination does not exits";
                    }
                }

                else
                {
                    $error .= "The entered email/password combination does not exits";
                }*/
            
        }
    }

?>



<!DOCTYPE html>
<html>

<head>
        <title>Login</title>
        <style>
            body
            {
                background-image: url(images/M3ilZL.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
            .login
            {
                width: 500px;
                height: 500px;
                background-color: rgba(255, 255, 255, 0);
                align-items: center;
                justify-content: center;
                margin-top: 10%;
                margin-bottom: 20%;
                border-radius: 6px;
            }
            .details{
                width: 300px;
                padding: 15px;
                border-radius: 4px;
            }
            .form-group
            {
                padding-left: 135px;
            }
            label
            {
                font-size: 20px;
                color: rgb(255, 255, 255);
            }
            .butn:hover
            {
                background-color: rgb(99, 153, 252);
            }
            .butn
            {
                border-radius: 20px;
                margin-top: 8px;
                margin-left: 30px;
                width: 120px;
                padding: 10px;
                font-size: 15px;
                z-index: 1;
                background-color: rgba(118, 200, 255, 0.836);
            }
            .l{
                color: white;
                font-size: 30px;
                padding-top: 18px;
                padding-left: 50px;
            }
            .forgot
            {
                color: white;
                font-size: 18px;
            }
            .btn:hover
            {
                cursor: pointer;
                background-color: rgb(255, 221, 221);
            }
            
            .back:hover{
                cursor: pointer;
            }
            #error
            {
                color: white;
                font-size: 15px;
            }
            #succ{
                color:white;
                font-size:15px;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            function validate()
            {
                var e = document.getElementById("Email").value;
                var p = document.getElementById("password").value;
                var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                if(e=="")
                {
                    alert("Enter your mail id to login");
                    return false;
                }
                else if(!e.match(mailformat)){
                    alert("Enter valid mail address");
                    return false;
                }
                else if(p=="")
                {
                    alert("Enter your password to login");
                    return false;
                }
                
                else
                {
                return true;
                }
            }
        </script>

    </head>
    <body>
        
        <div class="container login col-sm-10 col-lg-7 col-md-8 col-xl-5">
        
            <form method="POST" class="form-group" name="form">
            
                <h2 class="l">ADMIN LOGIN</h2>
                <label for="Email">Email</label><br>
                <input id="Email" name="email" class="details" type="email" placeholder="Email">
                <span id="inv" style="color: black; visibility: hidden;">Enter your Email</span><br>
                <span class="back">Back</span>
                <button class="butn send">Reset</button><br>

                <label for="password" class="pp">Password</label><br>
                <input id="password" name="password" class="details" type="password" placeholder="password"><br>
                <span id="p" style="color: black; visibility: hidden;">Enter your password</span><br>
                
                <input id="check" type="checkbox" name="stayloggedin" value="1">
                <label for="Email" class="kl">Keep me logged in</label><br>
                <a class="forgot text-muted" href="#">&nbsp;&nbsp;Forgot password?</a><br>
                                
                <input type="hidden" name="signUp" value="0">
                <button class="butn" onclick="validate()" name="submit">Login</button>
                <div id="error"><?php echo $error; ?></div>
                <div id="succ"><?php echo $success; ?></div>
            
            </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".back,.send").hide();
          $(".forgot").click(function(){
            $(".butn,.na,#check,.kl,#password,.pp,.forgot").hide();
            $(".back").css("visibility","visible");
            $(".back,.send").show();
            $(".login").css("height","350px");
            $(".l").text('Reset password');
          });
          $(".back").click(function()
          {
            $(".butn,.na,#check,.kl,#password,.pp,.forgot").show();
            $(".back,.send").hide();
            $(".l").text('ADMIN LOGIN');
            $(".login").css("height","500px");
          })
        });
        </script>
    </body>
    <html>