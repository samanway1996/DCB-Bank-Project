<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCB bank server</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Internal transaction after getting request through SMS </h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
    <div class="form-group">
      <label for="payfrom">Pay from:</label>
      <input type="text" class="form-control" id="payfrom" placeholder="Enter account number of payer" name="payfrom">
    </div>
    <div class="form-group">
      <label for="payto">Pay to:</label>
      <input type="text" class="form-control" id="payto" placeholder="Enter account number of payee" name="payto">
    </div>
    <div class="form-group">
      <label for="amount">Payable amount:</label>
      <input type="number" class="form-control" id="amount" placeholder="Enter amount to be paid" name="amount">
    </div>
    
    <input type="submit" name="insert" value="SUBMIT">  
  </form>
</div>

</body>

<!.....................................php code.................................>


<?php

if(isset($_POST['insert']))
{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

$r1=$_POST['payfrom'];
$r2=$_POST['payto'];
$r3=$_POST['amount'];



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "UPDATE dcbdb obj set obj.Amount=obj.Amount+$r3 where obj.Acn=$r2 ; " ;
$sql .= "UPDATE dcbdb obj set obj.Amount=obj.Amount-$r3 where obj.Acn=$r1 "; 


if ($conn->multi_query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>

<!..............................................................................>

</html>
