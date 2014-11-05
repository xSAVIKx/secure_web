<?php
include_once('utils/include_dependencies.php');
$dbManager = new DbManager();
$web_sites = $dbManager->get_all_websites();

$rnd = rand(0, $web_sites->count() - 1);

$random_web_site = $web_sites[$rnd];

redirect($random_web_site->getUrl());