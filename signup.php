<?php

    $error = "";
    $success = "";
    if(array_key_exists("submit",$_POST))
    {
        $link = mysqli_connect("localhost","sumanth","","ospforms");
        if(mysqli_connect_error()){
            die("Database connection Error");
        }

        if(!$_POST['name'])
        {
            
            $error .="Name is required<br>";
        }
        if(!$_POST['phone'])
        {
            
            $error .="Phone number is required<br>";
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
            
            $query = "SELECT ID FROM users WHERE EMAIL = 
            '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0)
            {
                $error = "The email address is already registered";
            
            }
            else
            {
                $query = "INSERT INTO users(NAME,EMAIL,PASSWORD,PHONE) 
                VALUES('".mysqli_real_escape_string($link,$_POST['name'])."',
                '".mysqli_real_escape_string($link,$_POST['email'])."',
                '".mysqli_real_escape_string($link,$_POST['password'])."',
                '".mysqli_real_escape_string($link,$_POST['phone'])."')";
                if(!mysqli_query($link,$query))
                {
                    $error = "<p>Sign Up failed. Please try again.</p>";
                }
                else
                {
                    $query = "UPDATE users SET PASSWORD = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE ID = ".mysqli_insert_id($link)." LIMIT 1";
                    
                    mysqli_query($link,$query);
                    
                    
                    $success =  "<p>Sign up successful</p>";
                    
                }

            }
            
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>STUDENT SIGN UP</title>
        <link rel = "stylesheet" href="assets/css/signup.css">
        <script type="text/javascript">
            function validate()
            {
                var f = document.getElementById("name").value;
                
                var e = document.getElementById("Email").value;
                var p = document.getElementById("password").value;
                var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var g = document.getElementsByName("gender").value;
                var dob = document.getElementById("birthday");
                var ph = document.getElementById("phone").value;
                var rp = document.getElementById("rpassword").value;
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                if(f=="")
                {
                    alert("Enter your name");
                    return false;
                }
                
                else if(e=="")
                {
                    alert("Enter your mail id");
                    return false;
                }
                else if(!e.match(mailformat)){
                    alert("Enter valid mail address");
                    return false;
                }
                else if(p=="")
                {
                    alert("Enter your password");
                    return false;
                }
                else if(rp=="")
                {
                    alert("Confirm your password");
                    return false;
                }
                else if(!(p==rp))
                {
                    alert("Passwords don't match");
                    return false;
                }
                else if(p.length<=6)
                {
                    alert("Password too short!");
                    return false;
                }
                else if(ph=="")
                {
                    alert("Enter your phone number");
                    return false;
                }
                else if((String(ph).length)!=10)
                {
                    alert("Enter a valid phone number");
                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   
</head>
    <body>
        <div class="container login col-sm-12 col-lg-9 col-md-12 col-xl-7">
            
            <form method ="POST" action="signup.php" class="form" name="form">
                <div class="form-group" name="form">
                <h2 class="l text-light" style="padding-left: 50px;">STUDENT SIGN UP</h2><br>

                <label for="name">Name</label><br>
                
                <input id="name" name="name" class="details" type="text" placeholder="Name">
                
               
                <br>

                <label for="Email">Email</label><br>
                <input id="Email" name="email" class="details" type="email" placeholder="Email">
                <br>
                
                <label for="password">Password</label><br>
                <input id="password" name="password" class="details" type="password" placeholder="Password">
                <br>
                <label for="rpassword">Confirm Password</label><br>
                <input id="rpassword" name="rpassword" class="details" type="password" placeholder="Re-Enter Password"><br>
                
                <label for="phone">Phone Number</label><br>
                <input id="phone" name="phone" class="details" type="number" placeholder="Phone Number">
                <br>
                

                    <br><br>
                    <span id="ahac" style="color:white;margin-left: 80px;font-size: 20px;"><a style="color:white;" href="login.php">Already have an account?</a></span><br>
                <br>
                <input type="hidden" name="signUp" value="1">
                <button class="butn" onclick="validate()" name="submit">Sign Up</button>
                <div id="error"><?php echo $error; ?></div>
                <div id="succ"><?php echo $success; ?></div>
            </div>
            </form>

            
        </div>
       
    </body>
</html>



