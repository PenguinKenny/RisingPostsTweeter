<?php

include "Database.class.php";
include "Post.class.php";
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$rss = simplexml_load_file("https://reddit.com/r/Gunners/rising.rss");
$posts = array();
$database = new Database();


// Load all rising posts into an array
// and discard if already tweeted
foreach ($rss->entry as $entry)
{
    if ($database->isNewTweet($entry->id))
    {
        $new_post = new Post();

        $new_post->setID($entry->id);
        $new_post->setLink($entry->link["href"]);
        $new_post->setTitle($entry->title);

        array_push($posts, $new_post);
        echo " is a new post and has not been tweeted.<br>";
    }
}

//----------------------------//
// ATTEMPT TO CONNECT         //
//----------------------------//
$connection = new TwitterOAuth("", "", "", "");
$content = $connection->get("account/verify_credentials");

if (!lastCallSuccessful($connection))
{
    echoErrorMessage("Could not verify");
}

//----------------------------//
// POST TWEET                 //
//----------------------------//
foreach ($posts as $post)
{
    $id = substr($post->getID(), 3);
    $title = $post->getTitle();
    $link = "https://redd.it/".$id;
    $remaining_length = 140 - strlen($link) - 1; // Total tweet minus the link and a space
    
    if (strlen($title) > $remaining_length)
    {
        $title = substr($title, 0, $remaining_length + 3);
        $title = substr_replace($title, "...", -3);
    }
    else
    {
        $title = $post->getTitle();
    }

    echo "<p>".$title." ".$link."</p>";

    $final_message = $title." ".$link;
    $status = $connection->post("statuses/update", ["status" => $final_message]);
    
    $tweet_success = false;
    if (!lastCallSuccessful($connection))
    {
        echoErrorMessage("Tweet was unsuccessful");
        print_r($status);
    }
    else
    {
        $tweet_success = true;
        $database->tweetPosted($id);
    }
}

// Functions
function lastCallSuccessful($connection)
{
    return ($connection->getLastHttpCode() == 200);
}

function echoErrorMessage($message)
{
    echo "<p><b>ERROR!</b> - ".$message."</p>";
}
?>
