<?php

declare(strict_types=1);

/** @var Devanych\View\Renderer $this */
/** @var array $products */
/** @var array $data */

$this->layout('../layouts/main.php');
$this->block('title', 'Product list');
?>

<h1>Products:</h1>
<?php if($data['info']):?>
 <div class="info"><?= $data['info'] ?></div>
<?php endif; ?>
<div class="article-list">
    <?php foreach ($products as $product):?>
        <div class="article">
            <div class="title">
                <?= $product->title ?>
            </div>
            <div class="description">
                <?= $product->description ?>
            </div>
            <div class="status">
                <?= $product->status_id ?>
            </div>
            <div class="actions">
                <a href="/product-form?id=<?= $product->id?>"><button>Edit</button></a>
                <a href="/product-delete?id=<?= $product->id?>"><button>Delete</button></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $this->beginBlock('meta');?>
    <meta name="description" content="Page Description">
<?php $this->endBlock();?>

<style>
    body{
        background: mintcream;
    }
    .article-list{
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin: 0 50px;
        width: 50%;
    }
    .article{
        background: white;
    }
    .info{
        margin: 20px;
        height: 20px;
        width: 50%;
        border: 1px solid black;
    }
    .title{
        font-weight: bold;
    }
</style>
