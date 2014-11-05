<?php
require_once("/usr/share/php/smarty3/libs/Smarty.class.php");
$smarty = new Smarty();
$template_dir = "templates";
$compile_dir = "templates_c";
$smarty->setTemplateDir($template_dir);
$smarty->setCompileDir($compile_dir);