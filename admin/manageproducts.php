<?php
session_start();
// Admin check code...

$storeXml = simplexml_load_file('../data/store_data.xml');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $stock = $_POST["stock"];
    
    // Generate a new product ID
    $lastId = 2000; // Default start
    foreach ($storeXml->products->product as $product) {
        $currentId = (int)$product->id;
        if ($currentId > $lastId) {
            $lastId = $currentId;
        }
    }
    $newId = $lastId + 1;
    
    // Handle image upload
    $image = "";
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        $target_dir = "../assets/images/";
        $extension = pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);
        $filename = "product_" . $newId . "." . $extension;
        $target_file = $target_dir . $filename;
        
        // Add watermark to image
        $source = imagecreatefromjpeg($_FILES["product_image"]["tmp_name"]);
        $watermark = imagecreatefrompng("../assets/images/watermark.png");
        
        imagecopy($source, $watermark, 10, 10, 0, 0, imagesx($watermark), imagesy($watermark));
        imagejpeg($source, $target_file);
        
        $image = "images/" . $filename;
    }
    
    // Add new product to XML
    $newProduct = $storeXml->products->addChild('product');
    $newProduct->addChild('id', $newId);
    $newProduct->addChild('name', $name);
    $newProduct->addChild('category', $category);
    $newProduct->addChild('price', $price);
    $newProduct->addChild('currency', 'PHP');
    $newProduct->addChild('description', $description);
    $newProduct->addChild('image', $image);
    $newProduct->addChild('stock', $stock);
    
    // Add sizes
    $sizes = $newProduct->addChild('sizes');
    foreach ($_POST["sizes"] as $size) {
        $sizes->addChild('size', $size);
    }
    
    // Add colors
    $colors = $newProduct->addChild('colors');
    foreach ($_POST["colors"] as $color) {
        $colors->addChild('color', $color);
    }
    
    $newProduct->addChild('rating', '0');
    $newProduct->addChild('review_count', '0');
    $newProduct->addChild('featured', 'false');
    $newProduct->addChild('on_sale', $_POST["on_sale"] ? 'true' : 'false');
    
    // Save XML file
    $storeXml->asXML('../data/store_data.xml');
    $success = "Product added successfully";
}
?>