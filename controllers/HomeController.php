<?php

/**
 * Written by Nair
 */


namespace controllers;
include_once 'utils/ControllerAbstract.php';

class HomeController extends \ControllerAbstract
{

    public $userId;


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userId = $_COOKIE['id'];
    }


    /**
     * Home route
     */
    public function index()
    {
        $approvedPosts = $this->conn->selectFreeRun("select * from posts where deleted=0 and approved=1");
        $userPosts = $this->conn->selectFreeRun("select * from posts where deleted=0  and user_id=" . $this->userId);
        $view = new \View('home');
        $view->assign('approvedPosts', $approvedPosts);
        $view->assign('userPosts', $userPosts);

    }


    /**
     * Admin route
     */
    public function adminHome()
    {
        $userController = new UserController();
        $isAdmin = $userController->isAdmin();
        if (!$isAdmin || !isset($_COOKIE['id'])) {
            die("You need a bit more permission to ride this page");
        }
        $pendingPosts = $this->conn->selectFreeRun("select * from posts where deleted=0 and approved=0");
        $approvedPosts = $this->conn->selectFreeRun("select * from posts where deleted=0  and approved=1");
        $view = new \View('admin');
        $view->assign('approvedPosts', $approvedPosts);
        $view->assign('pendingPosts', $pendingPosts);
    }


    /**
     * Adding a new post
     */

    public function addPost()
    {

        $title = mysqli_real_escape_string($this->db, $_POST['title']);
        $summary = mysqli_real_escape_string($this->db, $_POST['summary']);

        $errors = [];
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($summary)) {
            array_push($errors, "Title is required");
        }
        if (empty($title)) {
            array_push($errors, "Summary is required");
        }
        $image_name = "https://www.foot.com/wp-content/uploads/2017/06/placeholder-square.jpg"; // Placeholder

        // Uploading file
        if (isset($_POST) && !empty($_FILES['image']['name'])) {
            $name = $_FILES['image']['name'];
            list($txt, $ext) = explode(".", $name);
            $image_name = time() . "." . $ext;
            $tmp = $_FILES['image']['tmp_name'];
            // Checking file type
            $file_type = $_FILES['image']['type']; //returns the mimetype
            $allowed = array("image/jpeg", "image/gif", "image/png");
            if (!in_array($file_type, $allowed)) {
                die("Only jpg, gif, and png files are allowed.");
            }
            if (move_uploaded_file($tmp, 'uploads/' . $image_name)) {
                $image_name = "/uploads/" . $image_name;
            } else {
                die("Something went wrong while uploading image");
            }
        }
        $this->userId = $_COOKIE['id'];
        $date = date('Y-m-d H:i:s');
        // Insert the data to the post table
        $table = "posts";
        $field = array("title", "summary", "image", "approved", "deleted", "user_id", "created_at", "updated_at");
        $data = array($title, $summary, $image_name, 0, 0, $this->userId, $date, $date);
        $result = $this->conn->insertData($table, $field, $data);
        if ($result) {
            header("Location: /home");
        } else {
            die("Something went wrong");
        }
    }


    /**
     * Detail view for individual item
     */
    public function detailView()
    {
        $id = $_REQUEST['id'];
        $post = $this->getPost($id);
        $view = new \View('detail');
        $view->assign('post', $post);
    }


    /**
     * Editing route for admins
     */

    public function editPost()
    {
        $id = (int)$_POST['postId'];
        $title = mysqli_real_escape_string($this->db, $_POST['title']);
        $summary = mysqli_real_escape_string($this->db, $_POST['summary']);
        $approved = (boolean)mysqli_real_escape_string($this->db, $_POST['approved']);


        // form validation: ensure that the form is correctly filled ...

        if (empty($title)) {
            die("Title is required");
        }
        if (empty($summary)) {
            die("Summary is required");
        }
        $date = date('Y-m-d H:i:s');

        $sql = "";
        if (isset($_POST) && !empty($_FILES['image']['name'])) {
            $name = $_FILES['image']['name'];
            list($txt, $ext) = explode(".", $name);
            $image_name = time() . "." . $ext;
            $tmp = $_FILES['image']['tmp_name'];
            // Checking file type
            $file_type = $_FILES['image']['type']; //returns the mimetype
            $allowed = array("image/jpeg", "image/gif", "image/png");
            if (!in_array($file_type, $allowed)) {
                die("Only jpg, gif, and png files are allowed.");
            }

            if (move_uploaded_file($tmp, 'uploads/' . $image_name)) {
                $image_name = "/uploads/" . $image_name;
                $data = array("title" => $title,
                    "summary" => $summary,
                    "updated_at" => $date,
                    "image" => $image_name,
                    "approved" => $approved);

            } else {
                die("Something went wrong while updating image");
            }
        } else {
            $data = array("title" => $title,
                "summary" => $summary,
                "updated_at" => $date,
                "approved" => $approved);
        }

        $this->conn->updateData('posts', $data, "id =" . $id);
        mysqli_query($this->db, $sql);
        header('Location: /admin');
    }


    /**
     * Common method for retrieving a post
     * @param $id
     * @return mixed
     */
    private function getPost($id)
    {
        if (!$id) {
            throw new Exception('Id not found');
        }
        $post = $this->conn->selectFreeRun("select p.id,p.title,p.image,p.summary,p.approved,p.created_at,u.username from posts p join users u on u.id=p.user_id where p.id =" . $id . "  limit 1");
        if (count($post) < 1) {
            throw new Exception('Post not found');
        }
        return $post[0];

    }

}