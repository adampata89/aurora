<?php

declare(strict_types=1);

/** @var Devanych\View\Renderer $this */

$this->layout('../layouts/main');
$this->block('title', 'Registration');
?>
<h1>
    Create account:
</h1>
<form action="/register" method="post">
    <div>
        <span>User name:</span>
        <input type="text" name="user_register_form[username]" required/>
    </div>
    <div>
        <span>Email:</span>
        <input type="text" name="user_register_form[email]" required/>
    </div>
    <div>
        <span>Password:</span>
        <input type="password" name="user_register_form[password]" required/>
    </div>
    <input type="submit" value="create"/>
</form>
<?php if(isset($_COOKIE['info'])): ?>
    <span><?= $_COOKIE['info']?></span>
<?php endif; ?>
<a href="/login">Przejdź do logowania</a>
<?php $this->beginBlock('meta');?>
<meta name="description" content="Page Description">
<?php $this->endBlock();?>
