<?php
ini_set('default_charset', 'utf-8');
$doc = new DOMDocument;
@$doc->loadHTMLFile('http://blog.sight-management.com');
$data = array();
$nPost = 6;
$xpath = new DOMXPath($doc);
$elements = $xpath->query("//div[@id='theloop']//div//div//div//div//h2[@class='entry-title']//a");

if (!is_null($elements)) {
    $i = 0;
    foreach ($elements as $element) {
        //echo $element->textContent."<br />";
        $data[$i]['title'] = $element->textContent;
        $data[$i]['link'] = $element->getAttribute('href');
        $i++;

        if ($i == $nPost)
            break;
    }
}

$elements = $xpath->query("//div[@id='theloop']//div//div//div//div[@class='post-excerpt']");

if (!is_null($elements)) {
    $i = 0;
    foreach ($elements as $element) {
        $data[$i]['desc'] = trim(strip_tags(html_entity_decode($element->textContent, ENT_QUOTES, "UTF-8")));
        $i++;
        if ($i == $nPost)
            break;
    }
}

$elements = $xpath->query("//div[@id='theloop']//div//div//div//img");

if (!is_null($elements)) {
    $i = 0;
    foreach ($elements as $element) {
        $image = '<img width="116" src="' . $element->getAttribute('src') . '">';

        if (!empty($image)) {
            $data[$i]['img'] = '<img width="116" src="' . $element->getAttribute('src') . '">';
        } else {
            $data[$i]['img'] = '';
        }

        $i++;
        if ($i == $nPost)
            break;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />       
        <link rel='stylesheet' href='http://cdn.modelmanagement.com/stylesheets/cached/public/site/sightmanagement.1363711923.css' />        <style type='text/css'>
            div.hover div.friendship_actions a.user_avatar_unfollow {display:none !important;}
            div:hover div.friendship_actions a.user_avatar_unfollow {display:none !important;}
            #model_preview .stop_following_btn {display:none;}
        </style>
    </head>
    <body>
        <style type="text/css">
            body {width:100%;min-width: 100%;}    
            #blogGet {width:100%; overflow:hidden;height: 232px; scroll-x:none;}    
            #sm_blog li {width:16.6%; overflow:hidden; float:left; height: auto;}
            #sm_blog .img {
                height: auto;
                overflow: hidden;
                width: 100%;
                    position: relative;
                overflow: hidden;
            }

            #sm_blog li:first-child a img {margin-left:0}
            #sm_blog a img {
                min-height: 100%;
                margin: 0 5px;
                position: absolute;
                width: 100%

            }
            #sm_blog .desc {font-size:10px; color:#999;margin:0;height: 23px;}
            #sm_blog h4 {font-size: 12px;
                         margin-top: 5px;
                         max-height: 28px;
                         overflow: hidden;}
            #sm_blog h4 a {color:#444;}
            
            .capaBlog{
            width: 100%;
            height: auto;
            position: relative;
        }
        </style>
         
        <div id="blogGet" style="">
            <ul id="sm_blog">
                <?php foreach ($data as $d) { ?>
                    <li>
                        <div class="img">
                            <a href="<?php echo $d['link']; ?>" target="_blank">
                            <?php echo $d['img']; ?>
                            </a>
                            <img class="capaBlog" src="/public/images/capaBlog.png"/>
                        </div>
                        <h4><a href="<?php echo $d['link']; ?>" target="_blank" title="<?php echo $d['title']; ?>"><?php echo $d['title']; ?></a></h4>
                        <p class="desc"><?php echo $d['desc']; ?></p>
                    </li>  
                <?php } ?>
            </ul>
        </div>
        <div class='clearer'></div>
    </body>
</html>
