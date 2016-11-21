<?php

ob_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt PDF</title>
</head>
<body>

    <h1>Receipt PDF</h1>

    <p>This is a PDF generated using PHP!</p>

</body>
</html>

<?php

$html = ob_get_contents();
ob_end_clean();

// include autoloader
require( 'dompdf-master/autoload.inc.php' );
//reference the Dompdf namespace
use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml( $html );
// Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait')
//Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream( "receipt.pdf", array( 'Attachment' => false ) );
exit(0);

?>
