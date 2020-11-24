<?php

define("URL", (isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?route=');

define("NB_LAST_ARTICLES", 4);

define("ACTIVE_ARTICLE", '1');
define("INACTIVE_ARTICLE", '0');
define("PENDING_ARTICLE", NULL);

define("MAIN_CATEGORY", '1');
define("ACTIVE_CATEGORY", NULL);
define("INACTIVE_CATEGORY", '0');

define("ACCEPTED_COMMENT", '1');
define("REFUSED_COMMENT", '0');
define("PENDING_COMMENT", NULL);

define("VISITOR_LEVEL", '1');
define("MEMBER_LEVEL", '10');
define("AUTHOR_LEVEL", '100');
define("ADMIN_LEVEL", '1000');

define("ROLE_VISITOR", '1');
define("ROLE_MEMBER", '2');
define("ROLE_AUTHOR", '3');
define("ROLE_ADMIN", '4');
