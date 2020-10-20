<?php
$error = "";
$success = "";
if(array_key_exists("submit",$_POST))
{
    $link = mysqli_connect("localhost","Puneetha25","Puneetha@25","ospforms");
    if(mysqli_connect_error()){
        die("Database connection Error");
    }

    if(!$_POST['psw'])
    {
        $error .="password is required<br>";
    }
    if(!$_POST['conpsw'])
    {
        $error .="Confirm password is required<br>";
    }
    if($error!="")
    {
        
        $error = "<p>There is an error in your form</p>".$error;
    }
    else
    {
        
            $query = "INSERT INTO changepassword(psw,conpsw) 
            VALUES('".mysqli_real_escape_string($link,$_POST['psw'])."',
            '".mysqli_real_escape_string($link,$_POST['conpsw'])."',)";
            if(!mysqli_query($link,$query))
            {
                $error = "<p>Please try again.</p>";
            }
            else
            {
                
                $success =  "<p>Successfully submitted.</p>";
                echo $success;
            }    
    }
} 
?>

<!DOCTYPE html>
<script>
    function validatepsw()
    {
        var password=document.info.psw.value;
        var cpassword= document.info.conpsw.value;
        var validp = true;
        if(password.toString()=="")
        {
            window.alert("Please enter password.");
            validp=false;
        }
        if(cpassword.toString()=="")
        {
            window.alert("Please enter confirm password.");
            validp=false;
        }
        // if(password==cpassword)
        // {
        //     validp=true;
        // }
        if(password!=cpassword)
        {
            window.alert("Password and Confirm Password don't match.");
            validp=false;

        }
        if(validp)
        {
            window.alert("Password updated Sucessfully!");
        }

    }
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DASHBOARD</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- <script src="form.js"></script> -->
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.html">RECRUITMENTS</a> 
            </div>
  <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> &nbsp; <a href="index.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> &nbsp;  </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a  href="dashboard.html"><i class="fa fa-dashboard fa-3x"></i>DASHBOARD</a>
                    </li>
                      <li>
                        <a  href="profile.php"><i class="fa fa-desktop fa-3x"></i>APPLY FOR A JOB</a>
                    </li>
                    <li>
                        <a  href="jobs.html"><i class="fa fa-qrcode fa-3x"></i>JOBS</a>
                    </li>
                    <li  >
                         <a  href="#" target="_blank"><i class="fa fa-edit fa-3x"></i>INTERVIEW EXPERIENCE</a> 
                    </li>	
                    <!-- <li  > 
                        <a  href="settings.html"><i class="fa fa-edit fa-3x"></i>SETTINGS</a> 
                   </li>				 -->
					
					                   
    
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12"> 
                    
                       
                    </div>
                </div>
                 
                 <hr />
               
    </div>
             
    <div class="container">
        <form name="info" method="post"> 
            <h3>Change your password</h3>
          <label for="psw">Password</label>
        <input type="password" id="psw" name="psw" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <label for="conpsw">Confirm Password</label>
        <input type="password" id="conpsw" name="conpsw" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
          <input type="submit" name="formsubmit"  value="submit" id="submit" onclick="validatepsw()">
          <!-- <input type="submit" name="formsubmit" value="Submit"> -->
          <!-- <div class="err"><?php echo $error; ?></div>
              <div class="succ"><?php echo $success; ?></div> -->
        </form>
      </div>
      
      <div id="message">
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
