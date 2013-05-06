<?php
// make WordPress treat these as partial posts
$more = 0;
$theme->aggregatePosts();
locate_template('index.php', true);