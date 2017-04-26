<?php
/*
 * (footer)
 * Written by: Barsemian
 * For SOEN 287 Section W – Winter 2017
 *
 * This program contains the footer part of the project page
 * IT only opens a alert box assuring the user that their information
 * is kept safely and wont be used for profit
 *
 * */
echo "<script>function box() {
window.alert(\"WE GUARANTY YOU THAT YOUR INFORMATION WILL NOT BE SOLD OR MISUSED.\");
}</script><div style='width: 300px;
    background: white;
    border: 2px solid black;
    padding: 10px;
    margin: 0px;'>
<a href=\"javascript:box();\">Privacy/DisclaimerStatement</a></div>";
?>
