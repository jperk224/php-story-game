<?php
// Call session start b/f anything is output to the browser; this starts the user's session
session_start();

$total = 5;
// Take the p value passed in the form submission from the hidden form input field, and set $page
// equal to it to drive the switch statement that renders a specific page number
// filter incoming data
// use filter sanitize number int to remove all characters except digits, plus and minus sign.
// use INPUT_GET b/c we're filtering data pulled from the query string even though we changed form method to POST
$page = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);

// If the p value from form submittion to play.php is empty (i.e. not part of form submission)
// $page will be empty, so set to 1 to start the game from the beginning
if(empty($page)) {      // page was arrived at w/o a post from a previous page
    // clear session variables
    session_destroy();  // unset all session variables at once
    $page = 1;
}

// Check is a word has been posted, per the forms below, method is post and input text box has
// id word as the attribute identifying the user's input
if(isset($_POST["word"])) {
    // add a session variable using the $_SESSION superglobal (can't be used unless session is started as above)
    // create an array of session variables
    // since we post to the page number after the word we should use $page-1 to associate
    // the word with the appropriate page is was entered
    // filter input via filter sanitize string --> Strip tags, optionally strip or encode special characters.
    $_SESSION["word"][($page - 1)] = filter_input(INPUT_POST, "word", FILTER_SANITIZE_STRING);
    //var_dump($_SESSION); // var_dump test
}

if ($page > $total) {
    header('location: story.php');
    exit;
}

include 'inc/header.php';

echo "<h1>Step $page of $total</h1>";

// pass a the url parameter (i.e. p for $page) with a from POST and keep everything 
// else out of the query string
echo '<form method="post" action="play.php?p=' . ($page + 1) . '">';
//echo '<input type="hidden" name="p" value="'. ($page+1) . '" />';
echo '<div class="form-group form-group-lg">';

switch ($page) {
    case 2:
        echo '
            <label class="control-label h2" for="word">Enter a name</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="Name">
            ';
        break;
    case 3:
        echo '
            <label class="control-label h2" for="word">Enter a verb ending in -ing</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="verb-ing">
            <p class="help-block">An verb is a word used to describe an action, state, or occurrence.</p>
            ';
        break;
    case 4:
        echo '
            <label class="control-label h2" for="word">Enter a verb</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="verb">
            <p class="help-block">An verb is a word used to describe an action, state, or occurrence.</p>
            ';
        break;
    case 5:
        echo '
            <label class="control-label h2" for="word">Enter a noun</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="noun">
            <p class="help-block">An noun is a word (other than a pronoun) used to identify any of a class of people, places, or things.</p>
            ';
        break;
    default:
        echo '
            <label class="control-label h2" for="word">Enter an adjective</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="adjective">
            <p class="help-block">An adjective is a word or phrase naming an attribute, added to a noun to modify or describe it.</p>
            ';
        break;
}
echo '</div>
  <button type="submit" class="btn btn-default btn-lg">Submit</button>
</form>
';
include 'inc/footer.php';