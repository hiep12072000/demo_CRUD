<?php
require_once 'models/Model.php';

class Product extends Model
{

  public $id;
  public $category_id;
  public $title;
  public $avatar;
  public $price;
  public $amount;
  public $summary;
  public $content;
  public $status;
  public $created_at;
  public $updated_at;

  
  public function getAll()
  {
    $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        ORDER BY products.created_at DESC
                        ");

    $arr_select = [];
    $obj_select->execute($arr_select);
    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

    return $products;
  }

  
  public function getAllPagination()
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id    
                        ORDER BY products.updated_at DESC, products.created_at DESC
                        ");

    $obj_select->execute();
    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

    return $products;
  }

  
  public function countTotal()
  {
    $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products");
    $obj_select->execute();

    return $obj_select->fetchColumn();
  }

  
  public function insert()
  {
    $obj_insert = $this->connection
      ->prepare("INSERT INTO products(category_id, title, avatar, price, amount, summary, content, status) 
                                VALUES (:category_id, :title, :avatar, :price, :amount, :summary, :content, :status)");
    $arr_insert = [
      ':category_id' => $this->category_id,
      ':title' => $this->title,
      ':avatar' => $this->avatar,
      ':price' => $this->price,
      ':amount' => $this->amount,
      ':summary' => $this->summary,
      ':content' => $this->content,
      ':status' => $this->status,
    ];
    return $obj_insert->execute($arr_insert);
  }

  
  public function getById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

    $obj_select->execute();
    return $obj_select->fetch(PDO::FETCH_ASSOC);
  }


  public function update($id)
  {
    $obj_update = $this->connection
      ->prepare("UPDATE products SET category_id=:category_id, title=:title, avatar=:avatar, price=:price,amount=:amount 
            summary=:summary, content=:content, status=:status, updated_at=:updated_at WHERE id = $id
");
    $arr_update = [
      ':category_id' => $this->category_id,
      ':title' => $this->title,
      ':avatar' => $this->avatar,
      ':price' => $this->price,
      ':amount' => $this->amount,
      ':summary' => $this->summary,
      ':content' => $this->content,
      ':status' => $this->status,
      ':updated_at' => $this->updated_at,
    ];
    return $obj_update->execute($arr_update);
  }

  public function delete($id)
  {
    $obj_delete = $this->connection->prepare("DELETE FROM products WHERE id = $id");
    return $obj_delete->execute();
  }
}