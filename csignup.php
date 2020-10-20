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
            
            $query = "SELECT CID FROM cusers WHERE CEID = 
            '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0)
            {
                $error = "The email address is already registered";
            
            }
            else
            {
                $query = "INSERT INTO cusers(CNAME,CEID,CPASS,CPH) 
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
                    $query = "UPDATE cusers SET CPASS = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE CID = ".mysqli_insert_id($link)." LIMIT 1";
                    
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
        <title>COMPANY SIGN UP</title>
        <style>
            body
            {
                background-image: url(images/download.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                justify-content: center;
                align-items: center;
            }
            .login
            {
                width: 700px;
                height: 900px;
                background-color: rgba(254, 254, 255, 0);
                align-items: center;
                justify-content: center;
                margin-top: 10%;
                margin-left: 30px;
                margin-bottom: 20%;
                border-radius: 6px;
            }
            .details{
                opacity: 1;
                width: 350px;
                padding: 15px;
                border-radius: 4px;
            }
            .form{
                padding-left: 165px;
            }
            label
            {
                font-size: 20px;
                color: rgb(255, 255, 255);
            }
            
            .butn
            {
                border-radius: 20px;
                margin-top: 8px;
                margin-left: 80px;
                width: 130px;
                padding: 10px;
                font-size: 15px;
                background-color: rgba(255, 101, 101, 0.836);
            }
            .l{
                color: white;
                font-size: 30px;
                padding-top: 18px;
                padding-left: 10px;
            }
            .forgot
            {
                color: white;
                font-size: 18px;
            }
            #error
            {
                color: white;
                font-size: 20px;
            }
            #succ{
                color:white;
                font-size:20px;
            }
            .btn:hover
            {
                cursor: pointer;
            background-color: rgba(255, 221, 221);
            }
        </style>
        <script type="text/javascript">
            function validate()
            {
                var f = document.getElementById("name").value;
                var l = document.getElementById("lname").value;
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
                    alert("Enter your first name");
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
            
            <form method ="POST" action="csignup.php" class="form" name="form">
                <div class="form-group" name="form">
                <h2 class="l text-light" style="padding-left: 20px;">COMPANY SIGN UP</h2><br>

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
                <input id="phone" name="phone" class="details" type="number" placeholder="Phone Number" required>
                <br>
                

                    <br><br>
                    <span id="ahac" style="color:white;margin-left: 50px;font-size: 20px;"><a style="color:white;" href="clogin.php">Already have an account?</a></span><br>
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



