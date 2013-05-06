<?php
// make WordPress treat these as partial posts
$more = 0;
$theme->aggregatePosts();
// force WP to see this as a front page
$frontpage = true;
locate_template('index.php', true);