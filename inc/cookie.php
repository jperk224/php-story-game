<?php
// Write, read, and delete cookies
session_start();

// write a cookie
if(isset($_GET["save"])) {  // FIXME: When use clicks 'save story' href includes save parameter in the query string
    // name must be unique; if it's not it will be overwritten
    // here, we'll use name + timestamp
    // urlencode is convenient when encoding a string to be used in a query part of a URL
    // choose session variable at index 2, that is the name and therefore most logical value to store
    $key = urlencode($_SESSION["word"][2]) . time();   // return current UNIX timestamp
    setcookie   ($key, 
                implode(":", $_SESSION["word"]),    // value
                strtotime('+30 days'),              // time to expiration
                "/");                               // path used here is the root or our site
    // after setting the cookie, redirect to the home page
}
else if(isset($_GET["read"])) {
    $_SESSION["word"] = array_combine(range(1,5), explode(":", $_COOKIE[$_GET["read"]]));
    header("location: /story.php");
    exit;
}
else if(isset($_GET["delete"])) {
    setcookie($_GET["delete"], "", time() - 3600, "/");

}
header("location: /index.php");
exit;
