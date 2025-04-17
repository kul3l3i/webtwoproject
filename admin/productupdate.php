<?php
session_start();
// Admin check code...

$storeXml = simplexml_load_file('../data/store_data.xml');
$productId = $_GET["id"];
$product = null;

foreach ($storeXml->products->product as $p) {
    if ((string)$p->id === $productId) {
        $product = $p;
        break;
    }
}

if ($product === null) {
    header("Location: products.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_product"])) {
    // Update product details
    $product->name = $_POST["name"];
    $product->category = $_POST["category"];
    $product->price = $_POST["price"];
    $product->description = $_POST["description"];
    $product->stock = $_POST["stock"];
    
    // Handle image update if provided
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        // Image handling code like the add product function
    }
    
    // Update sizes
    unset($product->sizes);
    $sizes = $product->addChild('sizes');
    foreach ($_POST["sizes"] as $size) {
        $sizes->addChild('size', $size);
    }
    
    // Update colors
    unset($product->colors);
    $colors = $product->addChild('colors');
    foreach ($_POST["colors"] as $color) {
        $colors->addChild('color', $color);
    }
    
    $product->featured = $_POST["featured"] ? 'true' : 'false';
    $product->on_sale = $_POST["on_sale"] ? 'true' : 'false';
    
    // Save XML file
    $storeXml->asXML('../data/store_data.xml');
    $success = "Product updated successfully";
}
?>