<?php
session_start();

?>
<!------------------------------------------------------------------------------
// (MAIN PAGE )
// Written by: Barsemian Georgik 
// For SOEN 287 Section W – Winter 2017
//
//This program contains the project. Its a website where the user can login
// the suer can search for an appartment with its own desires
// if the user isnt loged in, the address of the apartments wont be shown
// if the user logs in and does its apartment seaarch, the address and the
// apartment price will show
//
// FOR SEARCH WITH A RESULT: search always by declaring 2 individuals
// put any location with 4 and half size and any price
// ----------------------------------------------------------------------------->
<!DOCTYPE html>

<html>

<head>
    <title>Apartment Search</title>
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

<div style="position: absolute;right: 200px; top:70px; ">
    <form  >
        <input type="button" onclick="location.href='login_page.php';" value="Login" />
    </form>
</div>

<form id="forms"  onclick="experts()" method="GET">

    <?php
    //session_destroy();
    if (isset($_SESSION['varname']))
    {
       echo"Welcome ".$_SESSION["varname"]."!"; //welcoming the user if hes logged in on top left corner of page
    }

    ?>

    <fieldset class="firstfield">
        <legend class="legend1"><strong>Renter(s) Information</strong></legend>

        <label class="text">How many people will live in the apartment?
            <input type="number" name="quantity" min="1" max="20"></label><br/><br/>
        <label class="text"> Smoker?</label>
        <label > <input type="radio" name="smoking" value="yes">Yes</label>
        <label> <input type="radio" name="smoking" value="no">No</label><br/><br/>
        <label class="text">Any pets?<br/></label>
        <label > <input type="checkbox" name="animal[]" value="cat">Cat(s)</label><br/>
        <label > <input type="checkbox" name="animal[]" value="dog">Dog(s)</label><br/>
        <label > <input type="checkbox" name="animal[]" value="other">Other <strong>Specify:</strong></label>
        <label > <input type="text" name="animal[]"></label><br/>
        <label > <input type="checkbox" name="animal[]" value="no">No Pets</label><br/>

    </fieldset>
    <br/>
    <fieldset class="secondfield">
        <legend class="legend2"><strong>What are you looking for?</strong></legend>

        <label class="text" id="sizes">Size of apartment:</label><br/>
        <label ><input type="checkbox" name="size[]" value="studio">Studio</label>
        <label ><input type="checkbox" name="size[]" value="3 and half">3&frac12;</label>
        <label ><input type="checkbox" name="size[]" value="4 and half">4&frac12;</label>
        <label ><input type="checkbox" name="size[]" value="5 and half">5&frac12;</label>
        <label ><input type="checkbox" name="size[]" value="more than 5 and half">more than 5&frac12;</label>
        <br/><br/>
        <label class="text">Do you have prefered locations ?</label><br/>
        <label ><input type="checkbox" name="location[]" value="westIsland">West Island</label>
        <label ><input type="checkbox" name="location[]" value="downtown">Downtown</label>
        <label ><input type="checkbox" name="location[]" value="lowmount">Lower Westmount</label>
        <label ><input type="checkbox" name="location[]" value="NDG">NDG</label>
        <label ><input type="checkbox" name="location[]" value="estend">East end of Island</label>
        <label ><input type="checkbox" name="location[]" value="idc">Don't care</label>
        <br/><br/>
        <label class="text">Price Range/month:<br/>
            <select name="price" id="cost">
                <option value="500">&lt;$500</option>
                <option value="700">&gt;500 and &lt;$700</option>
                <option value="1000">&gt;700 and &lt;$1000</option>
                <option value="no" selected="selected">No price limit</option>
            </select></label>
        <br/><br/>
        <label class="text">Would be nice to have</label><br/>
        <label ><input type="checkbox" name="have[]" value="fireplace">Fireplace</label>
        <label ><input type="checkbox" name="have[]" value="pool">Swimming pool in the building</label>
        <label ><input type="checkbox" name="have[]" value="parking">Indoor Parking</label>
        <label ><input type="checkbox" name="have[]" value="gym">Gym in the building</label>
        <label ><input type="checkbox" name="have[]" value="balcony">Balcony</label>
    </fieldset>
    <br/>

    <div id="hide">
    <fieldset id="thirdfield">
        <legend class="legend3">Expert Suggestions</legend>
        <label id="label"></label>
        <label id="label2"></label>
    </fieldset>
    </div>
    <label>Let's see what we can find...</label><br/><br/>
    <?php
    if( isset($_GET['search']) ) { // if the user doesnt check from all categories the code wont progress or output the results
        if(isset($_GET['quantity'])&&isset($_GET['smoking'])&&isset($_GET['animal'])&&isset($_GET['size'])&&isset($_GET['location'])&&isset($_GET['price'])&&$_GET['have'])
        searching();
        else {
            echo '<script language="javascript">';
            echo 'alert("Please complete all the fields of the serach!")';
            echo '</script>';
        }
    }
    ?>
    <input type="submit" name="search" value="Search">
    <input type="reset" value="Start over">

</form>
<script type="text/javascript" src="Expert_Suggestion.js"></script></br>
<?php include 'footer.php';?>

</body>

</html>
<?php
function searching(){

    $quant = $_GET['quantity']; // retrieving all the informations checked by the user in the website
    $smoke = $_GET['smoking'];
    $pet = $_GET['animal'];
    $big = $_GET['size'];
    $place = $_GET['location'];
    $money = $_GET['price'];
    //$wish = $_GET['have'];
    $myfile = fopen("apartment_info.txt", "r");
    $counter=0;
        while (!feof($myfile)) { // reading and comparing from the apartment text file and comparing search results
            $c1=0;
            $c2=0;
            $c3=0;
            $c4=0;
            $c5=0;
            $c6=0;

            $line = fgets($myfile);
            $re = "/person:" . $quant . "/";
            $c1 = preg_match($re, $line); // comparing number of person


            $re="/Smoker:".$smoke."/";
            $c2 = preg_match($re, $line); // seeing if its smoker or not
            if($c2==0)
            {$re="/Smoker:no,".$smoke."/";
                $c2 = preg_match($re, $line);}

            $a1=0;
            $a2=0;
            foreach ($pet as $value) { //comapring what kind of pets the user have
            $re="/Pets:".$value."/";
            $a1= preg_match($re, $line);
            $re="/".$value."/";
            $a2=preg_match($re, $line);
            if($a1>=1||$a2>=1)
                $c3=1;
            }


            foreach ($big as $value) { // comparing the desired size of apartment
                $re="/".$value."/";
                $t4 = preg_match($re, $line);
                if($t4>=1){
                    $c4=1;
                    $bigy=$value;
                }
            }

            $l1=0;
            $l2=0;
            foreach ($place as $value) { //checking the location of the user

                $re = "/location:" . $value . "/";
                $l1 = preg_match($re, $line);
                $re = "/" . $value . "/";
                $l2 = preg_match($re, $line);
                if($l1>=1||$l2>=1){
                    $c5=1;
                    $placy=$value;}
            }


            $m1=0;
            $m2=0;
            $re="/Price:".$money."/"; // verifying the price range of the user
            $m1= preg_match($re, $line);
            $re="/".$money."/";
            $m2=preg_match($re, $line);
            if($m1>=1||$m2>=1)
                $c6=1;




            if($c1>=1&&$c2>=1&&$c3==1&&$c4>=1&&$c5==1&&$c6==1){ // if theres a match with the user's apartment then its printed
                $counter++;
                $needle = "idc";
                if(strcmp($placy,$needle)==0){
                $p=strrpos ( $line , $needle  )+4;
                $d=strrpos ( $line , ";",$p  )-1;
                $placy = substr($line, $p, ($d-$p));}
                if (isset($_SESSION['varname'])) // if the user is logged in the address of the apartments will show
                {
                    $p=strpos($line, "::");
                    echo "Result ".$counter.": ".substr($line, 0,$p)." .Its situated in ".$placy." and the size of the apartment is ".$bigy.". </br></br>" ;

                }
                else{
                    if($counter==1){ // if the user isnt logged in the address of the apartments wont show
                        echo "PLEASE LOGIN TO FIND OUT THE ADRESS !! </br></br>";
                    }

                    echo "Result ".$counter.": Its situated in ".$placy." and the size of the apartment is ".$bigy.".      <input type=\"button\" onclick=\"location . href = 'login_page.php';\" value=\"Login\" /></br></br>";
                }
            }
        }

        if($counter==0)
            echo"No matching results...try again!";
    fclose($myfile);
}
?>