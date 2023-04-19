<?php

require_once "../../config/db_connect.php";

if (isset($_POST['create']))
{
    $title = $_POST['title'];
    $catalog_id = $_POST['catalog_id'];

    $query = mysqli_query($connect, "INSERT INTO categories (title, catalog_id) VALUES ('$title', '$catalog_id');");
    
    if ($query)
    {
        header("Location: index.php");
        die();
    }
    else
    {
        die("Запись не сохранен");
    }
}

if (isset($_POST['update']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $catalog_id = $_POST['catalog_id'];

    $query = mysqli_query($connect, "UPDATE categories SET title = '$title', catalog_id = '$catalog_id' WHERE id = $id;");
    
    if ($query)
    {
        header("Location: index.php");
        die();
    }
    else
    {
        die("Запись не сохранен");
    }
}

if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $query = mysqli_query($connect, "DELETE FROM categories WHERE id = '$id'");

    if ($query)
    {
        header("Location: index.php");
        die();
    }
    else
    {
        die("Запись удалён");
    }
}