<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php session_start(); ?>


    <form action="" method="post">
    <h1>Supermarket management</h1>
    <p>Worker name: <input type="text" name="workername" 
    value="<?php if (isset($_SESSION['nombre'])) { echo htmlspecialchars($_SESSION['nombre']); } ?>"></p>
    <br>
    <h1>Choose product</h1>
    <select name="product" id="">s
        <option value="softdrink">Soft Drink</option>
        <option value="milk">Milk</option>
    </select>
    <br>
    <h1>Product quantity</h1>
    <p><input type="text" name="quantity" id=""></p>
    <button type='submit' name='add'>Add</button>
    <button type='submit' name='remove'>Remove</button>
    <button type='submit' name='reset'>reset</button>
    </form>
    

    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

    $_SESSION['nombre'] = $_POST['workername'];
    $quantity = $_POST['quantity'];
    $product = $_POST['product'];

    if (!isset($_SESSION['product'])) {
        $_SESSION['product'] = array("milk" => 0, "softdrink" => 0);
    }

    

    


    if(isset($_POST['add'])){
        $_SESSION['product'][$product] += $quantity;
    } else if(isset($_POST['remove'])){
        if ($quantity > $_SESSION['product'][$product]) {
            echo '<p>Error! No se puede quitar más unidades de las que hay</p>';
        } else{
            $_SESSION['product'][$product] -= $quantity;
        }
        
    } else if(isset($_POST['reset'])){
        $_SESSION['product'][$product] = 0;
    }


    echo '<h1>Inventary:</h1>';
    echo '</br>';
    echo '<p>worker: ' . $_SESSION['nombre']. '</p>';
    echo '<p>units milk: '.$_SESSION['product']['milk'].'</p>';
    echo '<p>units soft drink: '.$_SESSION['product']['softdrink'].'</p>';


}

?>


</body>
</html>