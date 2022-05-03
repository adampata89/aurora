<?php

namespace App\Model;

class Product extends Model
{
    public $id;

    public $title;

    public $description;

    public $status_id;

    public $date;


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title)
    {
        $this->title = $title;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getStatusId()
    {
        return $this->status_id;
    }


    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    // the name of your model (and table)
    public static function getName() : string
    {
        return "product";
    }


    /**
     * Return last insert product
     * @return Product[]|\Aternos\Model\Query\QueryResult
     */
    public static function lastInsertProduct(){
        return Product::query((new \Aternos\Model\Query\SelectQuery)->orderBy(['id' => 'DESC'])->limit(1));
    }

}
