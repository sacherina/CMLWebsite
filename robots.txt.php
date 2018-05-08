<?php

/*
    Robots.txt Shadow Request Generator

    @version 0.5
    @author  Sean Nieuwoudt
    @date      11/01/09

    Notes:
    Router should be accepting requests made to robots.txt and routing to router::robots_txt,
    this should call the sitemap.txt.php file in the base dir for the shadow request.

    @TODO: improve error handling failover

*/

/**
* Get symantically correct url
*
* @return string
*/
function full_url() {
    try {

        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];

    } catch(Exception $e) {
        return 'sitemap.xml';
    }
}

# Determine Url
$url = str_replace('/robots.txt', '/sitemap.xml', full_url());

header("Content-Type: text/plain; charset=utf-8");
header('Cache-Control: no-cache');
header('Expires: -1');
header('Pragma: no-cache');

echo "User-agent: * \n";
echo "Sitemap: ". $url ."\n";
// fix for http://forum.yola.com/yola/topics/serious_health_issue
// echo "Disallow: /classes/ \n";
echo "Disallow: /definitions/ \n";

?>
