<?php
/*
 * (header)
 * Written by: Barsemian Georgik 
 * For SOEN 287 Section W – Winter 2017
 *
 * This program contains the header part of our project page
 * IT contains the logo picture and the title of the page
 * it alse displays the time with live seconds
 *
 * */
date_default_timezone_set('EST');
echo "<table>
    <tr>
        <td><a href=\"https://static1.squarespace.com/static/5326427ae4b0eeecbb67cf22/t/55e0b0c3e4b075a192d43bc6/1440788675856/\">
            <img src=\"https://static1.squarespace.com/static/5326427ae4b0eeecbb67cf22/t/55e0b0c3e4b075a192d43bc6/1440788675856/\"
                 alt=\"For Rent picture\" style=\"width:150px;height:80px;\"/></a>
        </td>
        <td><h1>Georgik's Apartment Search Form</h1></td>
    </tr>
</table>";
echo "<script type=\"text/javascript\">
function updateClock (){
  var currentTime = new Date ( );

  //Get the hours for updating clock
  var currentHours = currentTime.getHours ();
  
  //Get the minuts for updating clock
  var currentMinutes = currentTime.getMinutes ();
  
  //Get the secconds for updating clock
  var currentSeconds = currentTime.getSeconds ();

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? \"0\" : \"\" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? \"0\" : \"\" ) + currentSeconds;

  // Choose either \"AM\" or \"PM\" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? \"AM\" : \"PM\";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of \"0\" to \"12\"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString = currentHours + \":\" + currentMinutes + \":\" + currentSeconds + \" \" + timeOfDay;

  // Update the time display
  document.getElementById(\"clock\").firstChild.nodeValue =  currentTimeString;
}
</script>";
echo date("D M j ");
echo "<span id=\"clock\">&nbsp;</span>";

?>