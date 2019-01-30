<?php

/**
 * Written by Nair, 29/1/19 8:41 PM
 */

namespace controllers;
include_once 'utils/ViewMain.php';
include_once 'utils/SessionAbstract.php';
include_once 'utils/DBConnection.php';

class UserController extends \SessionAbstract
{
    private $db;


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index method for root route
     */
    public function index()
    {
        $view = new \View('register');
        $view->assign('variablename', 'variable content');
    }

    /**
     *  Registration method for user handling
     */
    public function doRegister()
    {

        $this->db = mysqli_connect('127.0.0.1', 'root', '', 'Guestbook');
        // receive all input values from the form
        $username = mysqli_real_escape_string($this->db, $_POST['user_name']);
        $email = mysqli_real_escape_string($this->db, $_POST['user_email']);
        $password = mysqli_real_escape_string($this->db, $_POST['user_pass']);

        $errors = [];
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($this->db, $user_check_query);
        $user = mysqli_fetch_assoc($result);


        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            echo "dd";
            die;
            $password = md5($password);//encrypt the password before saving in the database

            $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
            mysqli_query($this->db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
//            header('location: index.php');
        } else {
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
            die;
        }

    }

    /**
     * Login method
     */
    public function doLogin()
    {
        $username = mysqli_real_escape_string($this->db, $_POST['user_email']);
        $password = mysqli_real_escape_string($this->db, $_POST['user_pass']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($this->db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
//                header('location: index.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }

    }
}