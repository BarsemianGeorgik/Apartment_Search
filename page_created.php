<html>
<!--
/*
 * 
 * Written by: Barsemian Georgik 
 * For SOEN 287 Section W – Winter 2017
 *
 * The program shows a page of confirmation
 * when the user succefully creates a account!
 * *-->
<head>
    <title>Page Created!</title>
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

    <h2>A new account has been created!</h2>
    </br></br></br></br>
    <input type="submit" name="func1"value="Back to search page">
    <?php
    if( isset($_GET['func1']) )
        // user();
        echo '<script>window.location.href = "Question4.php";</script>';

    ?>
    </br></br></br></br>
</form>
<?php include 'footer.php';?>
</body>

</html>