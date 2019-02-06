<?php

/**
 * Written by Nair
 */

namespace controllers;
include_once 'utils/ViewMain.php';
include_once 'utils/ControllerAbstract.php';
include_once 'Controller.php';


class UserController extends \ControllerAbstract
{

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
        return new \View('register');
    }


    /**
     *  Registration method for user handling
     */
    public function doRegister()
    {
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
        $user = $this->conn->selectFreeRun("SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1");
        $user = $user[0];
        if ($user) { // if user exists
            if ($user['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password);//encrypt the password before saving in the database
            $table = "users";
            $field = array("username", "email", "password", "is_admin");
            $data = array($username, $email, $password, 0);
            $result = $this->conn->Insertdata($table, $field, $data);
            if ($result) {
                $success = [];
                array_push($success, "Successfully signed up");
                $view = new \View('register');
                $view->assign('success', $success);
            } else {
                array_push($errors, "Something went wrong");
                $view = new \View('register');
                $view->assign('data', $errors);
            }

        } else {
            $view = new \View('register');
            $view->assign('data', $errors);
        }

    }

    /**
     * Login method
     */
    public function doLogin()
    {
        $email = mysqli_real_escape_string($this->db, $_POST['user_email']);
        $password = mysqli_real_escape_string($this->db, $_POST['user_pass']);
        $errors = [];

        if (empty($email)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0) {
            $password = md5($password);
            // Checking for the specific user
            $results = $user = $this->conn->selectFreeRun("SELECT * FROM users WHERE email='$email' AND password='$password' limit 1");;
            $results = $results[0];
            if ($results) {
                $isAdmin = $results['is_admin'];
                $id = $results['id'];
                setcookie("id", $id, time() + 3600);
                setcookie("type", $isAdmin, time() + 3600);
                if ($isAdmin) {
                    header('location: /admin');
                    return false;
                }
                header('location: /home');
            } else {
                array_push($errors, "Wrong username/password combination");
                $view = new \View('register');
                $view->assign('data', $errors);
            }
        }

    }

    
    /**
     * Doing logout
     */
    public function doLogout()
    {
        setcookie("id", "", time() - 3600);
        setcookie("type", "", time() - 3600);
        header("location:/");
    }
}