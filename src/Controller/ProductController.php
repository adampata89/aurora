<?php

namespace App\Controller;

use App\Model\Product;
use Devanych\View\Renderer;
use http\QueryString;

class ProductController extends Controller
{
    public function view(){
        $productCollection = Product::select();
        $data['info'] = $_COOKIE['info'];

        if (count($productCollection) == 0) {
            $data['info'] = 'There is no product in your collection';
        }

        $renderer = new Renderer($this->path);
        $content = $renderer->render('product/index', [
            'products' => $productCollection,
            'data' => $data
        ]);

        echo $content;
    }

    public function productForm(){
        if (isset($_GET['id'])) {
            $data['title'] = 'Edit product';
            $data['product'] = Product::get($_GET['id']);
        }

        $renderer = new Renderer($this->path);
        $data['info'] = $_COOKIE['info'];

        $content = $renderer->render('product/form-product',[
            'data' => $data
        ]);

        echo $content;
    }

    public function productCreate(){
        $product = $_POST['product_form'];
        $title = $product['title'];
        $description = $product['title'];
        $statusId = $product['status_id'];

        $product = new Product();
        $product->setDescription($description);
        $product->setTitle($title);
        $product->setStatusId($statusId);
        $product->setDate(date('Y-m-d H:i:s'));
        try {
            $product->save();
            setcookie("info", "Product created successfully!", time() + 5);
        } catch (\Exception $e) {
            setcookie('info', 'Ups... product creation failed!', time() + 5);
        }
        return header('Location: /product-form');
    }

    public function productModify(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = $_POST['product_form'];
            $fields = array();

            foreach ($product as $index => $value){
                if ($index == 'id') continue;
                $fields[$index] = $value;
            }

            $condition = ['id' => $product['id']];

            try {
                Product::query((new \Aternos\Model\Query\UpdateQuery())
                    ->fields(($fields))
                    ->where($condition));
                setcookie("info", "Product updated successfully!", time() + 5);
            } catch (\Exception $e) {
                setcookie('info', 'Ups... product update failed!');
            }

            returnheader('Location: /product-form?id='.$product['id']);
        }
    }

    public function productDelete(){
        if (isset($_GET['id'])) {
            try {
                Product::query((new \Aternos\Model\Query\DeleteQuery())->where(['id'=>$_GET['id']]));
                setcookie("info", "Product removed successfully!", time() + 5);
            } catch (\Exception $e) {
                setcookie('info', 'Ups... product removing failed!');
            }
        }
        return header('Location: /products');
    }

}
