<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
            width: 30%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }




    </style>


</head>



<body>
    

    <?php

$valuename = "";
$valuequantity = "";
$valueprice = "";



    session_start();



    if (!isset($_SESSION['itemsquantity'])) {
        $_SESSION['itemsquantity'] = 0;
        $_SESSION['calculatetotal'] = 0;
    }


    if ($_SERVER['REQUEST_METHOD']=="POST") {
        
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
        }



        if (isset($_POST['update'])) {
            $_SESSION['shopping'][$_SESSION['editposition']]['name'] = $name;
            $_SESSION['shopping'][$_SESSION['editposition']]['price'] = $price;
            $_SESSION['shopping'][$_SESSION['editposition']]['quantity'] = $quantity;

            $_SESSION['shopping'][$_SESSION['editposition']]['cost'] = $_SESSION['shopping'][$_SESSION['editposition']]['quantity'] * $_SESSION['shopping'][$_SESSION['editposition']]['price'];
        }

        if (isset($_SESSION['shopping'])) {
            for ($i=0; $i < count($_SESSION['shopping']); $i++) { 
                if (isset($_POST['remove'.$i])) {
                    unset($_SESSION['shopping'][$i]);
                    $_SESSION['shopping'] = array_values($_SESSION['shopping']);
                    $_SESSION['itemsquantity']--;
                }
            }

            for ($i=0; $i < count($_SESSION['shopping']); $i++) { 
                if (isset($_POST['edit'.$i])) {
                    $valuename = $_SESSION['shopping'][$i]['name'];
                    $valuequantity = $_SESSION['shopping'][$i]['quantity'];
                    $valueprice = $_SESSION['shopping'][$i]['price'];
                    $_SESSION['editposition'] = $i;
                }
            }

            if (isset($_POST['reset'])){

                unset($_SESSION['shopping']);

            }
        }
        

        
       

        if (isset($_POST['add'])) {
            $_SESSION['shopping'][$_SESSION['itemsquantity']] = array("name" => $name, "quantity" => $quantity, "price" => $price);
            $_SESSION['shopping'][$_SESSION['itemsquantity']]['cost'] = $_SESSION['shopping'][$_SESSION['itemsquantity']]['quantity'] * $_SESSION['shopping'][$_SESSION['itemsquantity']]['price'];
            $_SESSION['itemsquantity']++;
        }

        

        if (isset($_POST['calculatetotal'])) {
            $_SESSION['calculatetotal'] = 0;
            for ($i=0; $i < count($_SESSION['shopping']); $i++) { 
                
                $_SESSION['calculatetotal']+=$_SESSION['shopping'][$i]['cost'];
            }

        }

    }




echo '    <form action="" method="post">';
echo '        <h1>Shopping list</h1>';
echo '        Name:<input type="text" name="name" value="'.$valuename.'"></br>';
echo '        Quantity: <input type="text" name="quantity" value="'.$valuequantity.'"></br>';
echo '        Price: <input type="text" name="price" value="'.$valueprice.'"></br>';
echo '';
echo '        <button type="submit" name="add">Add</button>';
echo '        <button type="submit" name="update">Update</button>';
echo '        <button type="submit" name="reset">Reset</button>';
echo '    </form>';

var_dump($_SESSION);
echo '<form action="" method="post">';
echo '<table>';
        echo '<thead>';
            echo '<tr>';
                echo '<th>name</th>';
                echo '<th>quantity</th>';
                echo '<th>price</th>';
                echo '<th>cost</th>';
                echo '<th>actions</th>';
            echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
                if (isset($_SESSION['shopping'])) {
                    $_SESSION['shopping'] = array_values($_SESSION['shopping']);
                    for ($i=0; $i < count($_SESSION['shopping']); $i++) { 
                        echo '<tr>';
                    echo '<td>'.$_SESSION['shopping'][$i]['name'].'</td>';
                    echo '<td>'.$_SESSION['shopping'][$i]['quantity'].'</td>';
                    echo '<td>'.$_SESSION['shopping'][$i]['price'].'</td>';
                    echo '<td>'.$_SESSION['shopping'][$i]['cost'].'</td>';
                    echo '<td><button type="submit" name="edit'.$i.'" >Edit</button>  <button type="submit" name="remove'.$i.'">Remove</button> </td>';
                    echo '</tr>';
                }

            
            } 
            
        echo '</tbody>';
       echo ' <tfoot>';
           echo ' <tr class="total-row">';
                echo '<td colspan="3">Total:</td>';
                echo '<td>'.$_SESSION['calculatetotal'].'</td>';
                echo '<td><button type="submit" name="calculatetotal">Calculate total</button></td>';
            echo '</tr>';
        echo '</tfoot>';
    echo '</table>';
echo '</form>'


    ?>



</body>



</html>