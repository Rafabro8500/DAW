<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Driver\Connection;

class Elearn_modelController extends AbstractController
{
	private $connection;	
	public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public function get_courses()
    {
        $query  = "SELECT courses.* , teachers.name AS t_name, teachers.image AS t_image, coursecategories.name AS cat_name
        FROM courses
        INNER JOIN teachers ON ( courses.teacher_id = teachers.id )
        INNER JOIN coursecategories ON ( courses.cat_id = coursecategories.id )";
        return $this->connection->fetchAll($query);
    }

    public function create_enroll($user_id, $course_id){
        $sql_insert = "INSERT INTO enrolls(user_id, course_id, enroll_date) 
        VALUES ('$user_id', '$course_id', NOW())";
        $stmt = $this->connection->prepare($sql_insert);
        return $stmt->execute();
    }

    public function get_enrolls($user_id){
        $query = "SELECT courses.name, courses.description, enrolls.enroll_date, teachers.name AS t_name
        FROM courses 
        INNER JOIN enrolls ON ( courses.id = enrolls.course_id )
        INNER JOIN teachers ON ( courses.teacher_id = teachers.id )
        WHERE enrolls.user_id = '$user_id' ";
        return $this->connection->fetchAll($query);
    }

    public function register($email, $user_name, $password_digest)
    {
        $present_date = date("Y-m-d H:i:s");
        $sql_insert = "INSERT INTO users(name, email, created_at, updated_at, password_digest)
                 VALUES('$user_name', '$email','$present_date','$present_date', '$password_digest')";
        $stmt = $this->connection->prepare($sql_insert);
        return $stmt->execute();
    }

    public function get_email($email)
    {
        $query = " SELECT * FROM users WHERE email = '$email' ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function login($email, $password_digest)
    {
        $query = "SELECT * FROM users WHERE email = '$email' AND password_digest = '$password_digest'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }
}
