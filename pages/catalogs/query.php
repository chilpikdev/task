<?php

require_once "../../config/db_connect.php";

if (isset($_POST['create']))
{
    $title = $_POST['title'];

    $query = mysqli_query($connect, "INSERT INTO catalogs (title) VALUES ('$title');");
    
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

    $query = mysqli_query($connect, "UPDATE catalogs SET title = '$title' WHERE id = $id;");
    
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
    $query = mysqli_query($connect, "DELETE FROM catalogs WHERE id = '$id'");

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