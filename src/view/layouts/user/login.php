<?php

declare(strict_types=1);

/** @var Devanych\View\Renderer $this */

$this->layout('../layouts/main');
$this->block('title', 'Login');
?>

<form action="/login" method="post">
    <div>
        <span>Email:</span>
        <input type="text" name="user_login_form[email]"/>
    </div>
    <div>
        <span>Password:</span>
        <input type="password" name="user_login_form[password]"/>
    </div>
    <input type="submit" value="Login"/>
</form>
<?php if(isset($_COOKIE['info'])): ?>
    <span><?= $_COOKIE['info']?></span>
<?php endif; ?>
<a href="/register">Create account</a>
<?php $this->beginBlock('meta');?>
<meta name="description" content="Page Description">
<?php $this->endBlock();?>
