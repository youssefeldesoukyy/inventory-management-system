<?php

//mariam

session_start();

use App\Product;

require_once('../vendor/autoload.php');

$authObj = new \App\Authenticate();
$authObj->redirectIfNotAuth();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="\viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time() ?>">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <title>Update Product</title>
    <style>
        input,
        textarea {
            unicode-bidi: plaintext;
        }
    </style>
</head>
<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/IA/pages/Layout/Navbar.php') ?>

<?php
if(empty($_GET['productId'])){
    \App\Alert::PrintMessage("Cannot Access This Page", "Danger");
    exit();
}

$productId = $_GET['productId'];

$productObject = new Product();

$productToUpdate = $productObject->getProductById($productId);

$productObject->updateProduct($productId);
?>

<br>

<!-- Product Update Container Start -->
<div class="To-Do-List Container">
    <h1 style="font-style: italic;margin:15px auto">Update Product</h1>
    <div class="container col-4">
        <form action="" method="post">
            <div class="col">
                <div class="col">
                    <label style="font-weight: bold;" for="ProductName">Product Name:</label>
                    <input required value="<?php echo htmlspecialchars($productToUpdate['name']) ?>" class="form-control" type="text" name="ProductInput" id="ProductName" placeholder="Enter product name">
                </div>
                <div class="col" style="margin-top: 15px;">
                    <label style="font-weight: bold;" for="ProductPrice">Price:</label>
                    <input required value="<?php echo htmlspecialchars($productToUpdate['price']) ?>" class="form-control" type="number" step="0.01" name="ProductPrice" id="ProductPrice" placeholder="Enter price">
                </div>
                <div class="col" style="margin-top: 15px;">
                    <label style="font-weight: bold;" for="ProductQuantity">Stock Quantity:</label>
                    <input required value="<?php echo htmlspecialchars($productToUpdate['stock_quantity']) ?>" class="form-control" type="number" name="ProductQuantity" id="ProductQuantity" placeholder="Enter quantity">
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <button style="margin-top: 20px;" type="submit" name="updateProductBtn" class="btn btn-outline-primary text-center">
                        Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Product Update Container End -->

</body>
</html>