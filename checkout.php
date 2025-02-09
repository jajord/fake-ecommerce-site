<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    require('ITEMS.php');
    $_SESSION['buying'] = $_POST;
    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checking ya out....</title>
    </head>
    <body>
        <p> 
            your card info will be sent via unsecure channels to our very bad 
            backend. we make absolutely no guarantees as to the quality or
            safety of using our service. 
        </p>
        <hr>
        <p>

            you will buy: 
            <?php
            $subtotal = 0;
            foreach ($ITEMS as $name => $price) {
                $qty = $_SESSION['buying']["qty$name"]; #!read user input directly!
                if ($qty <= 0) {continue;} #skip if user doesnt buy any
                echo "<div>"
                . "$qty of item: "
                . "<img src=$IMAGES[$name] alt='$DESC[$name]' style='width: 80px'"
                . "<br></div><br>";
                $subtotal += $qty * $price;
            }
            $_SESSION['subtotal'] = $subtotal; #lazy, unsafe, bad. always verify
            echo "subtotal: $$subtotal <br> sales tax will be calculated after "
            . "your card information is verified.";
            ?>
        </p>
        <form method='POST' action='buy.php'>
            <br>
            <label for='userCard'>don't think, put your credit card information here:</label>
            <input type="number" name="userCard" id='userCard' placeholder="card number..." required>
            <br>
            <label for='userCardDate'>Expiration Date:</label>
            <input type="month" name="userCardDate" id='userCardDate' required>
            <input type="Submit" value="BUY NOW!">
        </form>
        <a href="." >Go Back</a>
    </body>