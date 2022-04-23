<?php
    error_reporting(E_ERROR | E_PARSE);

    $experiencePro = $_POST["experiencePro"];
    $educationEmp = $_POST["educationEmp"];
    $NomEntreprise = $_POST["NomEntreprise"];

    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    $database = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    if(!is_null($experiencePro) && !is_null($educationEmp) && !is_null($NomEntreprise)){
        $sql = "INSERT INTO test (experiencePro, educationEmp, NomEntreprise) VALUES ('".$experiencePro."','".$educationEmp."','".$NomEntreprise."')";
        if ($conn->query($sql) === TRUE) {
            require('fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',11);
            $pdf->Image('background.jpg',30,6,150);
            $pdf->Ln(3);
            $pdf->Cell(90);
            $pdf->Cell(1,20,'Expérience pro:'.$experiencePro);
            $pdf->Ln(1);
            $pdf->Cell(90);
            $pdf->Cell(1,30,'Education Employe:'.$prenom);
            $pdf->Ln(1);
            $pdf->Cell(90);
            $pdf->Cell(1,40,'Mail:'.$mail);
            $pdf->Output();
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html>
<body>
<form action="./index.php" method="post">
Expérience pro : <input type="text" name="experiencePro"/><br>
Education Employé : <input type="text" name="educationEmp"/><br>
Nom entreprise : <input type="text" name="NomEntreprise"/><br>
<button>coucou</button>  
</form>
</body>
</html>