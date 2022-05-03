<?php

declare(strict_types=1);
use App\Model\Product;

/** @var Devanych\View\Renderer $this */
/** @var array $data */
/** @var Product $product */


$product = $data['product'];

$this->layout('../layouts/main.php');
$this->block('title', (!isset($data['title'])) ? 'Add new product' : $data['title']);
?>

<?= ($data['info']) ? '<div class="info">' . $data['info'] . '</div>' : '' ?>
<h1>
    <?= (!isset($data['title'])) ? 'Add new product' : $data['title'] ?>
</h1>
<form action="<?= ($product != null) ? '/product-modify' : '/product-create' ?>" method="post" name="product_form">
    <?php if($product != null): ?>
        <div>
            <span>Id:</span>
            <span><?= $product->getId() ?></span>
        </div>
    <?php endif; ?>
    <div>
        <?= ($product != null) ? '<input type="hidden" name="product_form[id]" value="' . $product->getId() . '">' : '' ?>
        <span>Title:</span>
        <input name="product_form[title]" type="text" <?= ($product != null) ? 'value="' . $product->getTitle() . '"' : '' ?> required>
    </div>
    <div>
        <span>Description:</span>
        <input name="product_form[description]" type="text" <?= ($product != null) ? 'value="' . $product->getDescription() . '"' : '' ?> required>
    </div>
    <div>
        <span>Status:</span>
        <select name="product_form[status_id]" <?= ($product != null) ? 'value="' . $product->getStatusId() . '"' : '' ?> required>
            <option value="1">enabled</option>
            <option value="2">disabled</option>
        </select>
    </div>
    <input type="submit" value="<?= ($product != null) ? 'update' : 'create' ?>">
</form>

<?php $this->beginBlock('meta');?>
<meta name="description" content="Page Description">
<?php $this->endBlock();?>
