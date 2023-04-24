<?php
include_once("../conn.php");

if(isset($_POST["name"])){
    $attrs = "";
    $values = "";
    $values_array = [];
    $types = "";
    foreach ($_POST as $key => $value) {
        if(strlen($value) != 0){           
            $values .= "?,";
            if(substr($key,-1) == "-"){
                $attrs .= substr($key,0,-1) . ",";
                $types .= "i";
            }
            else{
                $attrs .= $key . ",";
                $types .= "s";                
            }
            array_push($values_array,$value);
        }  
    }
    $attrs = substr($attrs,0,-1);
    $values = substr($values,0,-1);

    // Check entry within table
    $nazev_firmy = $_POST['name'];
    $sql_trim = str_replace(" ", "", $nazev_firmy);
    $sql = "SELECT id FROM firm WHERE name='".$sql_trim."';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo 'Udaj jiz existuje<script>alert("Udaj jiz existuje");history.back()</script>';
            
            
        die;
      } 
    } 
        
        $sql = "INSERT INTO firm ($attrs) values($values)";
            $insert = $conn->prepare($sql);
            $insert->bind_param($types, ...$values_array);
            if($insert->execute()){
                header("Location: /");

      
    }
    
    
     



    $query->close();
    $insert->close();
    $conn->close();
}

?>