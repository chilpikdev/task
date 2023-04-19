<?php

require_once "../../config/db_connect.php";

if (isset($_POST['CatalogId'])) {
    $id = $_POST['CatalogId'];
    $categories = mysqli_query($connect, "SELECT id, title FROM categories WHERE catalog_id = '$id'");
    $categories = $categories->fetch_all();
    
    foreach ($categories as $value)
    {
        printf("<option value='%s'>%s</option>", $value[0], $value[1]);
    }
}

if (isset($_POST['create']))
{
    $title = $_POST['title'];
    $catalog_id = $_POST['catalog_id'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $promoprice = $_POST['promoprice'];
    $promostart = $_POST['promostart'];
    $promoend = $_POST['promoend'];

    $query = mysqli_query($connect, "INSERT INTO products (title, catalog_id, category_id, price, promoprice, promostart, promoend) VALUES ('$title', '$catalog_id', '$category_id', '$price', '$promoprice', '$promostart', '$promoend');");
    
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
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $promoprice = $_POST['promoprice'];
    $promostart = $_POST['promostart'];
    $promoend = $_POST['promoend'];

    $query = mysqli_query($connect, "UPDATE products SET title = '$title', catalog_id = '$catalog_id', category_id = '$category_id', price = '$price', promoprice = '$promoprice', promostart = '$promostart', promoend = '$promoend' WHERE id = $id;");
    
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
    $query = mysqli_query($connect, "DELETE FROM products WHERE id = '$id'");

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