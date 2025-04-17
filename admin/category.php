<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

$storeXml = simplexml_load_file('../data/store_data.xml');

// Process category addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
    $categoryName = $_POST["category_name"];
    $categoryDesc = $_POST["category_description"];
    
    // Check if category already exists
    $exists = false;
    foreach ($storeXml->categories->category as $category) {
        if ((string)$category->name === $categoryName) {
            $exists = true;
            break;
        }
    }
    
    if (!$exists) {
        // Add new category
        $newCategory = $storeXml->categories->addChild('category');
        $newCategory->addChild('name', $categoryName);
        $newCategory->addChild('description', $categoryDesc);
        
        // Save XML file
        $storeXml->asXML('../data/store_data.xml');
        $success = "Category added successfully";
    } else {
        $error = "Category already exists";
    }
}
?>