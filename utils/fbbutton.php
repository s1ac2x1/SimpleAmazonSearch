<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Share</title>
</head>
<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=293090604143643";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?
$url = $_GET['url'];
?>
<center>
    <div id="fb-button" class="fb-like" data-href="<? echo "http://simpleamazonsearch.com/index.php?external=$url"; ?>"
         data-send="false" data-width="450" data-show-faces="false" data-font="tahoma"></div>
</center>
</body>
</html>