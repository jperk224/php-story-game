<?php
include 'inc/header.php';

echo '<h1>Welcome to our<br />Treehouse Story Game</h1>';
echo '<p>Enter the requested words and create your story.</p>';
echo '<p><a class="btn btn-default btn-lg" href="play.php" role="button">Play</a></p>';

echo '<h2>Reread Your Saved Stories</h2>';
// $_COOKIE is an associative arry just as is $_SESSION
// loop thorugh the array and display available cookies to revisit saved stories
if(isset($_COOKIE)) {
    foreach($_COOKIE as $key => $value) {
        if($key != "PHPSESSID") {
            echo "<div class=\"form-group\">";
            echo "<a class=\"btn btn-info\" href=\"inc/cookie.php?read=" . urlencode($key) . "\">";
            echo substr($key, 0, -10);     // timestamps are 10 characters, we're cutting it off just to display the name
            echo " ";
            echo date("d M Y H:i:s", (int) substr($key, -10));
            echo "</a>";
            echo "<a class=\"btn btn-danger\" href=\"inc/cookie.php?delete=" . urlencode($key) . "\">";
            echo "X";
            echo "</a>";
            echo "</div>";
        }
    }
}

include 'inc/footer.php';