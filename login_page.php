<?php
/*
 * (the login page)
 * Written by: Barsemian Georgik 
 * For SOEN 287 Section W – Winter 2017
 *
 * This program contains the file of the page
 * where the user can login into his account or create his account
 * when the user tries to log in the user_info.txt file is acccesed
 * and its verified if the user is entering the right password or not
 * if the username doesnt exists in the file then then a new account is created
 * theres also so restricition to what kind of username and password is allowed
 *
 * */
session_start();
$_SESSION['varname']  = 0;
function user(){

$verify=$_GET['login_name'];
$re = '/[\s\W]/';
$z= preg_match($re,$verify);
if($z==1){ // checked if the username contains other characters than letters and digits
    echo '<script language="javascript">';
    echo 'alert("The username is in wrong format!")';
    echo '</script>';
}
$verify=$_GET['login_pass'];
$z= preg_match($re,$verify);
if($z==1){// checked if the password contains characters other than letters and digits
    echo '<script language="javascript">';
    echo 'alert("The password contains other characters than letters and digits!")';
    echo '</script>';
}
if(strlen($verify)<4) // checks if the  password is at leasst 4 character long
{
    $z=1;
    echo '<script language="javascript">';
    echo 'alert("The password is less than 4 characters")';
    echo '</script>';
}

$re = '/[a-z]/';
$a= preg_match($re,$verify);
$re = '/\d/';
$b= preg_match($re,$verify);

if($a<1||$b<1){ // checks if the password contains at least 1 letter and 1 number
    $z=1;
    echo '<script language="javascript">';
    echo 'alert("The password doesnt contain at least 1 letter and 1 number")';
    echo '</script>';
}
$name="/".$_GET['login_name'];
$name.=":/";
$password = "/:".$_GET['login_pass']."/";
// echo "$name and $password";
$myfile = fopen("user_info.txt", "r");

// Output one character until end-of-file
if(strlen($name)>3&&$z==0) {
    $name_exists = false;
    while (!feof($myfile)) {
        $test = fgets($myfile);
        $y = 0;
        $z = 0;
        $y = preg_match($name, $test);
        if ($y == 1) {
            $name_exists = true;

            $z = preg_match($password, $test); // checking if the username exists in the text file with the password
            if ($z == 1) {
                $_SESSION['varname']  = $_GET['login_name'];
                echo '<script>window.location.href = "Question4.php";</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Wrong Password")';
                echo '</script>';
            }
        }

    }
    fclose($myfile);
    if (!$name_exists) {
        $_SESSION['varname']  = $_GET['login_name']; // if the username doesnt exist in the file a new user name is created with its pasword and strores in the text file
        $myfile = fopen("user_info.txt", "a+");
        fwrite($myfile, $_GET['login_name'] . ":" . $_GET['login_pass'] . "\n");
        fclose($myfile);
        echo '<script>window.location.href = "page_created.php";</script>';
    }

  }
}
?>

<html>

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <style type="text/css">
        head,body{ background-color:rgb(252, 255, 150);}
        .firstfield{ color:blue;background-color:#ccccff; }
        .secondfield{color:#00b300;background-color:#ccffcc;}
        #thirdfield{color:darkred;background-color:#F58888}
        .legend1{color:blue}
        .legend2{color:#00b300}
        .legend3{color:darkred;}

        label{ color:black;  font-weight: lighter;}
        .text{ color:black;font-weight: bold; }
    </style>
    <script type="text/javascript" src="Expert_Suggestion.js"></script>
</head>
<body onload="updateClock(); setInterval('updateClock()', 1000 )">
<?php include 'header.php';?>
<form id="forms"  onclick="experts()"action="" method="GET">

</br></br></br>

        Username : <input type="text" name="login_name"></br><label style="color:red">A username can contain letters (both upper and lower case) and digits only</label></br></br></br>
        Password : <input type="password" name="login_pass"></br><label style="color:red">A password must be at least 4 characters long (characters are to be letters and digits only)
</label></br></br></br><input type="submit" name="func1">
  </div>
    <?php
    if( isset($_GET['func1']) )
       user();
    ?>
</br></br></br></br>
</form>
<?php include 'footer.php';?>
</body>

</html>