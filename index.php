<?php
    error_reporting(E_ALL ^ E_NOTICE);
    $nomPersonne = $_POST["nomPersonne"];
    $prenomPersonne = $_POST["prenomPersonne"];
    $experiencePro = $_POST["experiencePro"];
    $educationEmp = $_POST["formation"];
    $nomEntreprise = $_POST["nomEntreprise"];

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $database = "cv_tp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    if(!is_null($nomPersonne) && !is_null($prenomPersonne) && !is_null($experiencePro) && !is_null($educationEmp) && !is_null($nomEntreprise)){
        $sql = "INSERT INTO cv (nomPersonne, prenomPersonne ,experiencePro, formation, nomEntreprise) VALUES ('".$nomPersonne."','".$prenomPersonne."' ,'".$experiencePro."','".$educationEmp."','".$nomEntreprise."')";
        if ($conn->query($sql) === TRUE) {
            require('fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',11);
            $pdf->Image('formatCv.jpg',30,6,150);
            $pdf->Image('ensitech.png',110,15,50);
            $pdf->Image('avatar.png',43,18,20);
            $pdf->Ln(3);
            $pdf->Ln(1);
            $pdf->Cell(60);
            $pdf->Cell(1,20,'Nom : '.utf8_decode($nomPersonne));
            $pdf->Ln(1);
            $pdf->Cell(60);
            $pdf->Cell(1,30,'Prenom : '.utf8_decode($prenomPersonne));
            $pdf->Ln(32);
            $pdf->Cell(73);
            $pdf->Cell(1,50,utf8_decode($nomEntreprise));
            $pdf->Cell(20);
            $pdf->Cell(1,50,utf8_decode($experiencePro));
            $pdf->Ln(50);
            $pdf->Cell(73);
            $pdf->Cell(1,30,utf8_decode($educationEmp));
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
Nom : <input type="text" name="nomPersonne"/><br>
Prenom : <input type="text" name="prenomPersonne"/><br>
Expérience pro : <input type="text" name="experiencePro"/><br>
Formation : <input type="text" name="formation"/><br>
Nom entreprise : <input type="text" name="nomEntreprise"/><br>
<button>Valider</button>
</form>
</body>
</html>