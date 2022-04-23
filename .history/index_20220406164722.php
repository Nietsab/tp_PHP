<?php
    error_reporting(E_ERROR | E_PARSE);

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $experience = $_POST["experience"];
    $diplome = $_POST["diplome"];

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
    if(!is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($experience) && !is_null($diplome)){
        $sql = "INSERT INTO information (nom, prenom, mail, experience, diplome) VALUES ('".$nom."','".$prenom."','".$mail."', '".$experience."','".$diplome."')";
        if ($conn->query($sql) === TRUE) {
            require('fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',11);
            $pdf->Image('background.jpg',30,6,150);
            $pdf->Ln(3);
            $pdf->Cell(90);
            $pdf->Cell(1,20,'Nom:'.$nom);
            $pdf->Ln(1);
            $pdf->Cell(90);
            $pdf->Cell(1,30,'Prenom:'.$prenom);
            $pdf->Ln(1);
            $pdf->Cell(90);
            $pdf->Cell(1,40,'Mail:'.$mail);
            $pdf->Ln(32);
            $pdf->Cell(75);
            $pdf->Cell(1,50,$experience);
            $pdf->Ln(36);
            $pdf->Cell(75);
            $pdf->Cell(1,60,'Diplomes:'.$diplome);
            $pdf->Output();
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            margin:0;
            padding:0;
        }
        form {
            background-color: #89a8ed;
            padding: 20px;
            width: 50%;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 20px;
            margin-top: 20px;
        }
        form div{
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        button{
            margin-top: 20px;
            padding: 10px;
            background-color: white;
            border: none;
            border-radius:50px;
            transition:0.2s;
        }
        button:hover{
            transform: scale(1.1) rotate(180deg);
        }
        input{
            transition:0.2s;
        }
        input:focus{
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
<form action="./index.php" method="post">
Expérience pro : <input type="text" name="experiencePro"/><br>
Education Employé : <input type="text" name="educationEmp"/><br>
Nom entreprise : <input type="text" name="NomEntreprise"/><br>
</form>
</body>
</html>