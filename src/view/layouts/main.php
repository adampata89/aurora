<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->renderBlock('title');?></title>
    <?=$this->renderBlock('meta');?>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body class="main">
<?php if (isset($_SESSION['user'])):?>
<div class="header-nav-bar">
    <a href="/product-form"><div class="header-nav-bar-button">Add product</div></a>
    <a href="/products"><div class="header-nav-bar-button">Product list</div></a>
    <a href="/logout"><div class="header-nav-bar-button">logout</div></a>
</div>
<?php endif; ?>
<?=$this->renderBlock('content');?>
</body>
</html>
