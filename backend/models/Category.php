<?php
//models/Category
require_once 'models/Model.php';

class Category extends Model
{
  
  public $id;
  public $name;
  public $avatar;
  public $description;
  public $status;
  public $created_at;
  public $updated_at;

  
  public function insert()
  {
    $sql_insert ="INSERT INTO categories(`name`, `avatar`, `description`, `status`)VALUES (:name, :avatar, :description, :status)";
    
    $obj_insert = $this->connection->prepare($sql_insert);
    
    $arr_insert = [
      ':name' => $this->name,
      ':avatar' => $this->avatar,
      ':description' => $this->description,
      ':status' => $this->status
    ];
    return $obj_insert->execute($arr_insert);
  }

  
  public function getAll()
  {
    
    $sql_select_all = "SELECT * FROM categories";
    
    $obj_select_all = $this->connection->prepare($sql_select_all);
    $obj_select_all->execute();
    $categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
  }

  public function getById($id)
  {
    $sql_select_one = "SELECT * FROM categories WHERE id = $id";
    $obj_select_one = $this->connection->prepare($sql_select_one);
    $obj_select_one->execute();
    $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
    return $category;
  }

 
  public function getCategoryById($id)
  {
    $obj_select = $this->connection->prepare("SELECT * FROM categories WHERE id = $id");
    $obj_select->execute();
    $category = $obj_select->fetch(PDO::FETCH_ASSOC);

    return $category;
  }

 
  public function update($id)
  {
    $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at WHERE id = $id");
    $arr_update = [
      ':name' => $this->name,
      ':avatar' => $this->avatar,
      ':description' => $this->description,
      ':status' => $this->status,
      ':updated_at' => $this->updated_at,
    ];

    return $obj_update->execute($arr_update);
  }

 
  public function delete($id)
  {
    $obj_delete = $this->connection->prepare("DELETE FROM categories WHERE id = $id");
    $is_delete = $obj_delete->execute();
    $obj_delete_product = $this->connection->prepare("DELETE FROM products WHERE category_id = $id"); //xóa cả product
    $obj_delete_product->execute();

    return $is_delete;
  }

  public function getAllPagination()
  {
    $obj_select = $this->connection->prepare("SELECT * FROM categories");
    $obj_select->execute();
    $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
  }
}