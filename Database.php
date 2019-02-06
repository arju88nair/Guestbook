<?php
/**
 * Written by Nair
 */

$config = parse_ini_file('config.ini');

$serverName = $config['server'];
$username = $config['username'];
$password = $config['password'];
$database = $config['db'];


// Create connection
$conn = mysqli_connect($serverName, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . $config['db'];
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";

    // Creating Users table
    $usersSql = "CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(155) NULL,
  `email` VARCHAR(155) NOT NULL,
  `password` VARCHAR(155) NOT NULL,
  `is_admin` TINYINT(2) NULL,
  PRIMARY KEY (`id`));
";
    mysqli_select_db($conn, $config['db']);

    if (mysqli_query($conn, $usersSql)) {
        echo "Table Users created successfully";
    } else {
        die("Error creating table: " . mysqli_error($conn));
    }

    // Creating Posts table
    $postsSql = "CREATE TABLE `posts` (
  `id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(155) NULL,
  `summary` VARCHAR(255) NULL,
  `approved` TINYINT(2) NULL,
  `deleted` TINYINT(2) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `image` VARCHAR(155) NULL,
  `user_id` INT(10) NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES users(`id`))";


    if (mysqli_query($conn, $postsSql)) {
        echo "Table Posts created successfully";

    } else {
        die("Error creating table: " . mysqli_error($conn));
    }

    // Inserting a dummy admin account
    $password = md5("admin");
    $adminSql = "INSERT INTO users (username, email, password,is_admin)
VALUES ('admin ', 'admin@yopmail.com', $password,1)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }


} else {
    die("Error creating database: " . mysqli_error($conn));
}

mysqli_close($conn);


