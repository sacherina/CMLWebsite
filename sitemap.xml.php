<?php

/**
 * Return absolute url (with page name)
 *
 * @return string
 */
function getAbsoluteUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['SERVER_NAME'] . getPage();
}

/**
 * Return canonical request url
 *
 * @return string
 */
function getPage() {
    $urlBits = explode("/", $_SERVER['REQUEST_URI']);
    array_pop($urlBits);
    return implode("/",$urlBits);
}

header("Content-Type: text/xml");
header('Cache-Control: no-cache');
header('Expires: -1');
header('Pragma: no-cache');
print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");

$baseURL = getAbsoluteUrl();

?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

            <url>
                            <loc><?php echo $baseURL; ?>/</loc>
                <lastmod>2018-05-01T05:56:25+00:00</lastmod>
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>
                    </url>
            
    </urlset>
