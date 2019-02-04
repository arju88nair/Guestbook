<?php

/**
 * Written by Nair, 31/1/19 9:30 PM
 */


namespace controllers;


class HomeController extends \SessionAbstract
{
    private $db;
    private $conn;


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->conn = new \DBConnection();
        $this->db = $this->conn->getDbConnect();
    }


    public function index()
    {

        $approvedPosts = $this->conn->selectFreeRun("select * from posts where deleted=0 and approved=1");
        $userPosts = $this->conn->selectFreeRun("select * from posts where deleted=0  and user_id=6");
        $view = new \View('home');
        $view->assign('approvedPosts', $approvedPosts);
        $view->assign('userPosts', $userPosts);

    }

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


        if (isset($_POST) && !empty($_FILES['image']['name'])) {

            $name = $_FILES['image']['name'];


            list($txt, $ext) = explode(".", $name);
            $image_name = time() . "." . $ext;
            $tmp = $_FILES['image']['tmp_name'];
            if (move_uploaded_file($tmp, 'uploads/' . $image_name)) {
                $image_name = getcwd() . "/uploads/" . $image_name;
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO posts (title,summary,image,approved,deleted,user_id,created_at,updated_at) VALUES ('" . $title . "','" . $summary . "','" . $image_name . "',1,0,1,'" . $date . "','" . $date . "')";
                mysqli_query($this->db, $sql);
                header("Location: /home");
            } else {
                $_SESSION['error'] = 'image uploading failed';
                header("Location: http://localhost:8000");
            }

        }

    }


    public function adminHome()
    {
        $pendingPosts = $this->conn->selectFreeRun("select * from posts where deleted=0 and approved=0");
        $approvedPosts = $this->conn->selectFreeRun("select * from posts where deleted=0  and approved=1");
        $view = new \View('admin');
        $view->assign('approvedPosts', $approvedPosts);
        $view->assign('pendingPosts', $pendingPosts);
    }


    public function detailView()
    {
        $id = $_REQUEST['id'];
        $post = $this->getPost($id);
        $view = new \View('detail');
        $view->assign('post', $post);
    }

    public function editPost()
    {
        $id = $_GET['id'];
        $title = mysqli_real_escape_string($this->db, $_POST['title']);
        $summary = mysqli_real_escape_string($this->db, $_POST['summary']);
        $approved = mysqli_real_escape_string($this->db, $_POST['approved']);


        $errors = [];
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($summary)) {
            array_push($errors, "Title is required");
        }
        if (empty($title)) {
            array_push($errors, "Summary is required");
        }


        if (isset($_POST) && !empty($_FILES['image']['name'])) {

            $name = $_FILES['image']['name'];
            list($txt, $ext) = explode(".", $name);
            $image_name = time() . "." . $ext;
            $tmp = $_FILES['image']['tmp_name'];
            if (move_uploaded_file($tmp, 'uploads/' . $image_name)) {
                $image_name = "/uploads/" . $image_name;
                $date = date('Y-m-d H:i:s');
                $sql = "update posts set title= '" . $title . "' ,summary = '" . $summary . "' ,updated_at='" . $date . "' ,image='" . $image_name . "',approved='" . $approved . "'  where id=$id";
                mysqli_query($this->db, $sql);
            } else {

            }

        } else {
            $date = date('Y-m-d H:i:s');
            $sql = "update posts set title= '" . $title . "' ,summary = '" . $summary . "' ,updated_at='" . $date . "' ,approved='" . $approved . "' where id=$id";
            mysqli_query($this->db, $sql);
        }

    }

    function getPost($id)
    {
        if (!$id) {
            throw new Exception('Id not found');
        }
        $post = $this->conn->selectFreeRun("select * from posts p join users u on u.id=p.user_id where p.id =" . $id . "  limit 1");
        if (count($post) < 1) {
            throw new Exception('Post not found');

        }
        return $post[0];
        $view = new \View('detail');
        $view->assign('post', $post);
    }

}