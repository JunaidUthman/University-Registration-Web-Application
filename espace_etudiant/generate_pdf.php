<?php
require 'vendor/autoload.php'; // Composer's autoloader
use setasign\Fpdi\Fpdi;


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Ajouter les logos
$pdf->Image('images/FST-Tanger-modified.png', 10, 10, 30); // Logo gauche
$pdf->Image('images/logopuae.png', 170, 10, 30); // Logo droit

// Ajouter un titre centré entre les logos
$pdf->Cell(0, 20, 'Fiche de Preinscription', 0, 1, 'C');
$pdf->Ln(5);

/////////////////////////////  photo detudiant   ///////////////////////////

$pdf->Rect(150, 40, 40, 50); // Cadre pour la photo
$pdf->SetFont('Arial', 'I', 10);

// Assurez-vous que vous avez le chemin correct de l'image
$imagePath = 'images/my pic.jpg'; // Remplacez ceci par le chemin de l'image réelle

// Ajouter l'image dans la zone définie
$pdf->Image($imagePath, 150, 40, 40, 50); // Position x, y, largeur, hauteur

// Si vous souhaitez ajouter un texte dans la même zone après l'image, vous pouvez le faire comme suit :
$pdf->SetXY(150, 90); // Vous pouvez ajuster la position de texte
$pdf->Cell(40, 10, 'Photo Etudiant', 0, 1, 'C');

///////////////////////////////////////////////////////////////////////////////

// Informations personnelles
$pdf->SetXY(10, 40); // Positionnement à côté de la photo
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Informations Personnelles', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);

// Exemple de données de l'étudiant
$infos_perso = [
    'Nom complet' => 'John Doe',
    'CNE' => 'G123456789',
    'CIN' => 'AB123456',
    'Date naissance' => '1995-10-15',
    'Lieu naissance' => 'Tanger',
    'Email' => 'johndoe@example.com'
];

foreach ($infos_perso as $key => $value) {
    $pdf->Cell(50, 8, utf8_decode($key) . ':', 0, 0);
    $pdf->Cell(0, 8, utf8_decode($value), 0, 1);
}

// Informations du baccalauréat
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Informations sur le Bac', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 8, 'Serie:', 0, 0);
$pdf->Cell(0, 8, 'Sciences Mathematiques A', 0, 1);
$pdf->Cell(50, 8, 'Mention:', 0, 0);
$pdf->Cell(0, 8, 'Tres Bien', 0, 1);

// Diplômes Bac+2 / Bac+3
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Diplomes Bac+2 / Bac+3', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 8, 'DEUST Sciences et Techniques', 0, 1);
$pdf->Cell(0, 8, 'Licence Mathematiques et Informatique', 0, 1);

// Notes des semestres
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Notes des Semestres (S1 - S6)', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);



for ($i = 1; $i <= 6; $i++) {
    $pdf->Cell(15, 8, 'S' . $i, 1, 0, 'C');
}
$pdf->Ln();
for ($i = 1; $i <= 6; $i++) {
    $pdf->Cell(15, 8, rand(10, 20), 1, 0, 'C');
}
$pdf->Ln(10);

///////////////////////////////filiere choisit ///////////////////
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Choix des Filieres', 0, 1, 'L');
$filieres = [
    'Génie Electrique',
    'Informatique Industrielle',
    'Génie Mécanique',
    'Télécommunications',
    'Biotechnologie',
    'Ingénierie Logicielle',
    // Vous pouvez ajouter d'autres filières ici
];

// Boucle pour afficher chaque filière

foreach ($filieres as $filiere) {
    $pdf->Cell(0, 8, $filiere, 1, 1); // Affichage de chaque filière dans une nouvelle ligne
}

////////////////////////////////////////////////////////////////////////////////

// Signature
$pdf->Ln(5);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Signature du candidat:', 0, 1, 'R');

// Générer le PDF
$pdf->Output('I', 'preinscription.pdf');
?>



