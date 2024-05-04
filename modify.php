<?php
$servername = "localhost";
$username = "root";
$password = null;
$database = "aqark";


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM buildings";
$stmt = $conn->prepare($sql);
// Execute query
$stmt->execute();
$result = $stmt->get_result();

// Fetch results
while ($row = $result->fetch_assoc()) {
    $searchResults[] = $row;
}

// Close statement
$stmt->close();


$isNamed = false;
$nameChosen = '';
$type = '';
//what type of modification? insert, update or delete



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modify</title>
     <!-- name number_of_rooms no_business_contracts cost -->
</head>
<body>
<?php if($type == ''){
    echo "<h1>What do you want to do?</h1>
    <form>
    <button type='submit' name='edit'>edit a building's information</button>
    <button type='submit' name='add'>add a building</button>
    <button type='submit' name = 'delete'>delete a building</button>
    </form>";
    }
    echo "<table border=1> 
        <tr>
            <th>Name of building</th>
            <th>Cost</th>
            <th>Number of rooms</th>
            <th>number of contracts</th>
        </tr>"; 
        
        foreach ($searchResults as $i) {echo "<tr>
            <td>", $i['name']," </td>
            <td>", $i['cost'], " </td>
            <td>", $i['number_of_rooms'], " </td>
            <td>", $i['no_business_contracts'], "</td>
            </tr>";} 
        echo "</table>";
if(isset($_GET['edit'])){
        $type = '1';
        echo "<form method='get' action='modify.php' id='nameForm'>
        <label for='buildings'>Choose a building to edit:</label>
        <select name='buildings' id='buildings'>";

        foreach ($searchResults as $q) { echo '<option value=', $q["name"], '>', $q["name"],'</option>';};

        echo ' </select>
        <br><br>
        <input type="submit" value="Submit">
        </form>';
        if (isset($_GET['buildings'])){
        $nameChosen = $_GET['buildings'];
        echo $nameChosen;
        }
    }elseif (isset($_GET['add'])){
        $type = '1';
    } elseif (isset($_GET['delete'])){
        $type = '1';
    }


    
    ?>

    <!-- I am gonna put the changing stuff in this form below to happen after committing the name -->
    
    
</body>
</html>