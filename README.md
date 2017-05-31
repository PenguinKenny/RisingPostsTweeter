## /r/Gunners Rising Post Tweeter

This PHP application looks through /r/Gunners/rising/ every 15-30 minutes and tweets any new posts on the [@GunnersReddit](https://twitter.com/GunnersReddit) Twitter account.

It works in the following way:

1. A cron job runs the run.php file every so amount of time.
2. /r/Gunners/rising.rss is parsed for posts and new posts are stored.
3. These posts are tweeted and the reddit IDs are added to a database for future checking of already tweeted posts.
4. This database is cleared out every day, although this certainly could be done more frequently.

Please bear in mind that this is by no means a flawlessly coded application! If you wish to improve it then please do.
