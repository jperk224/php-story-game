<?php
session_start();

// check that all session variables are set and not simply empty strings
// if so, redirect the user back to that page to capture input
// the below loop did not work as expected, but on the right track?

// for ($i = 1; $i <= count($_SESSION); $i++) {
//     if((empty($_SESSION["word"][$i])) || (empty(trim($_SESSION["word"][$i])))) {
//         header("location:play.php?p=" . $i);
//         break;
//     }
// }

// session variables
$word1 = htmlspecialchars($_SESSION["word"][1]);
$word2 = htmlspecialchars($_SESSION["word"][2]);
$word3 = htmlspecialchars($_SESSION["word"][3]);
$word4 = htmlspecialchars($_SESSION["word"][4]);
$word5 = htmlspecialchars($_SESSION["word"][5]);

// need to make sure the session variables are set before attempting to write the story

include 'inc/header.php';

echo '<h1>My Treehouse Story</h1>';

echo '<p>There once was a(n) ' . $word1;
echo ' programmer named ' . $word2; 
echo '. </p>';
echo '<p>This ' .  $word3; 
echo ' programmer used Treehouse to learn to ' . $word4;
echo ' the ' . $word5 . '.</p>';

echo ' <a class="btn btn-default btn-lg" href="inc/cookie.php?save" role="button">Save Story</a>';
echo ' <a class="btn btn-default btn-lg" href="play.php" role="button">Play Again</a>';
echo ' <a class="btn btn-default btn-lg" href="index.php" role="button">Other Stories</a>';


include 'inc/footer.php';