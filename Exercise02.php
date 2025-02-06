<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>Modify array saved in session</h1>
        
        <select name="position" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select> <br><br>

        New Value: <input type="text" name="value" id="">
<br>

        <button type="submit" name="modify">Modify</button>
        <button type="submit" name="average">Average</button>
        <button type="submit" name="reset">Reset</button>

        <br><br>
    </form>




    <?php
    

    session_start();




    if ($_SERVER['REQUEST_METHOD']=="POST") {
        

        $position = $_POST['position']-1;
        $newvalue = $_POST['value'];

        if (isset($_POST['modify'])) {
            $_SESSION['numbers'][$position] = $newvalue; 

           

        } else if (isset($_POST['average'])) {
            $average = ($_SESSION['numbers'][0] + $_SESSION['numbers'][1] + $_SESSION['numbers'][2])/3;
            
            
        } else if (isset($_POST['reset'])) {
            if ($position == 0) {
                $_SESSION['numbers'][$position] = 10;
            } else if ($position == 1) {
                $_SESSION['numbers'][$position] = 20;
            } else if ($position == 2) {
                $_SESSION['numbers'][$position] = 30;
            }
            
            
        }

    }

    if (!isset($_SESSION['numbers'])) {
        $_SESSION['numbers'] = array(10,20,30);
    }

    echo 'Current array: '.$_SESSION['numbers'][0].','.$_SESSION['numbers'][1].','.$_SESSION['numbers'][2];

    if (isset($average)) {
        echo '</br>';   
        echo 'Average: '.$average;
    }


    

    
    ?>
</body>
</html>