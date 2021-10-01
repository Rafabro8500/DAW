<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Driver\Connection;

class Bakery_modelController extends AbstractController
{
	private $connection;	
	public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get_categories(){
        $query = "SELECT * FROM categories";
        return $this->connection->fetchAll($query);
    }

    public function get_products($id = false)
    {
        if($id){
            $products_query  = "SELECT * FROM products WHERE id = '$id'";
            $stmt = $this->connection->prepare($products_query);
            $stmt->execute();
            return $stmt->fetch();
        }
        $products_query  = "SELECT * FROM products";
        return $this->connection->fetchAll($products_query);
    }

    public function get_products_by_category($category_id){
        $products_query  = "SELECT * FROM products WHERE cat_id = '$category_id'";
        return $this->connection->fetchAll($products_query);
    }

    public function login($email, $password_digest)
    {
        $query = "SELECT * FROM users WHERE email = '$email' AND password_digest = '$password_digest'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function register($email, $user_name, $password_digest)
    {
        $present_date = date("Y-m-d H:i:s");
        $sql_insert = "INSERT INTO users(name, email, created_at, updated_at, password_digest)
                 VALUES('$user_name', '$email','$present_date','$present_date', '$password_digest')";
        $stmt = $this->connection->prepare($sql_insert);
        return $stmt->execute();
    }
}
