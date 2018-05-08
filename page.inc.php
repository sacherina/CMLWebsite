<?php

global $systemProperties;

header('Content-type: text/html; charset=utf-8');

require_once(_ENV_PROJECT_BASE . '/classes/commons/includes/Common.inc.php');

checkPreviewAuthorization();

checkNotModified();

require_once(_PAGE_SMARTYINIT);

checkAuthorization();

setCacheHeaders();

// SYNTHBLOG-142 Fix
$smarty->assign('system', $systemProperties['system']);

if (_MOBILE) {
    $mobileStyleName = $systemProperties['system']['template']['mobile']['name'];
    $smarty->display('templates' . DIRECTORY_SEPARATOR . $mobileStyleName . DIRECTORY_SEPARATOR . 'style.html');
} else {
    $styleName = $systemProperties['system']['template']['name'];
    $smarty->display('templates' . DIRECTORY_SEPARATOR . $styleName . DIRECTORY_SEPARATOR . 'style.html');
}
?>
