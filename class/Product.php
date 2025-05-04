<?php

namespace App;

class Product
{

    // youssef
    public function createNewProduct()
    {
        if (isset($_POST['addNewProductBtn'])) {
            $product = $_POST['ProductInput'];
            $price = $_POST['ProductPrice'];
            $quantity = $_POST['ProductQuantity'];
            
            $insertStatement = 'INSERT INTO `product` VALUES(NULL,?,?,?)';
            $myDBObject = new \App\DB();
            $queryObject = $myDBObject->Connection->prepare($insertStatement);
            $queryObject->bind_param('sii', $product, $price, $quantity);
            $checkQuery = $queryObject->execute();
            
            if ($checkQuery)
                \App\Alert::PrintMessage("Product Added Successfully", "Normal");
            else
                \App\Alert::PrintMessage("Failed To Add Product", "Danger");
        }
    }

    // jana
    public function getAllProducts()
    {
        $selectStatement = 'SELECT * FROM `product` ORDER BY name ASC';
        $myDBObject = new \App\DB();
        $queryStmtObject = $myDBObject->Connection->prepare($selectStatement);
        $queryStmtObject->execute();
        return $queryStmtObject->get_result();
    }

    public function getProductById($productId)
    {
        $selectStatement = 'SELECT * FROM `product` WHERE id = ?';
        $myDBObject = new \App\DB();
        $queryStmtObject = $myDBObject->Connection->prepare($selectStatement);
        $queryStmtObject->bind_param('i', $productId);
        $queryStmtObject->execute();
        return ($queryStmtObject->get_result())->fetch_assoc();
    }


    // mariam
    public function updateProduct($productId)
    {
        if (isset($_POST['updateProductBtn'])) {
            $name = $_POST['ProductInput'];
            $price = (int)$_POST['ProductPrice'];
            $quantity = (int)$_POST['ProductQuantity'];
            
            $updateStatement = 'UPDATE `product` SET name = ?, price = ?, stock_quantity = ? WHERE id = ?';
            $myDBObject = new \App\DB();
            $queryObject = $myDBObject->Connection->prepare($updateStatement);
            $queryObject->bind_param('siii', $name, $price, $quantity, $productId);
            $checkQuery = $queryObject->execute();
            
            if ($checkQuery) {
                header('Location: ProductView.php');
                exit();
            } else {
                \App\Alert::PrintMessage("Failed To Update Product", "Danger");
            }
        }
    }


    // basmala
    public function deleteProduct()
    {
        if (isset($_GET['productToDelete'])) {
            $productId = $_GET['productToDelete'];
            $deleteStatement = 'DELETE FROM `product` WHERE id = ?';
            $myDBObject = new \App\DB();
            $queryObject = $myDBObject->Connection->prepare($deleteStatement);
            $queryObject->bind_param('i', $productId);
            $checkQuery = $queryObject->execute();
            
            if ($checkQuery) {
                header('Location: ProductView.php');
            } else 
                Alert::PrintMessage("Failed To Delete Product", "Danger");
        }
    }
}