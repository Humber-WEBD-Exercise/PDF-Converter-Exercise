<?php require_once __DIR__.'/receipt.php'; ?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>invoice #<?php echo $invoice['id'] ?></title>
    <style>
      *{
        padding: 0;
        margin: 0;
      }
      .invoice-box{
        max-width:800px;
        margin: 20px auto;
        padding:30px;
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
      }

      .invoice-box table{
        width:100%;
        text-align:left;
      }

      .invoice-box table td{
        padding:5px;
        vertical-align:top;
      }

      .invoice-box table tr td:nth-child(2), .invoice-box table tr td:nth-child(3), .invoice-box table tr td:nth-child(4){
        text-align:right;
      }

      .invoice-box table tr.top table td{
        padding-bottom:20px;
      }

      .invoice-box .title{
        font-size:45px;
        line-height:45px;
        color:#333;
      }

      .invoice-box table tr.information td{
        padding:40px 0;
      }

      .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
      }

      .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
      }

      .invoice-box table tr.item:last-of-type td{
        border-bottom:none;
      }

      .invoice-box table tr.total.first td:nth-child(2){
        padding-top: 20px;
        border-top:2px solid #eee;
      }
      .invoice-box table tr.total.last td:nth-child(2){
        font-weight:bold;
        padding-bottom: 40px;
      }
    </style>
  </head>
  <body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td class="title" colspan="2">
                    Humber College
                </td>
                <td colspan="2">
                    Invoice #: <?php echo $invoice['id'] ?><br>
                    Status: <?php echo $invoice['status'] ?><br>
                    Date: <?php echo $invoice['date'] ?>
                </td>
            </tr>

            <tr class="information">
              <td colspan="2">
                  <?php echo$invoice['address']['street']; ?>, <?php echo$invoice['address']['postal']; ?><br>
                  <?php echo$invoice['address']['province']; ?>, <?php echo$invoice['address']['country']; ?>
              </td>

              <td colspan="2">
                  <?php echo$invoice['contact']['last']; ?>, <?php echo$invoice['contact']['first']; ?><br>
                  <?php echo$invoice['contact']['email']; ?>
              </td>
            </tr>

            <tr class="heading">
                <td>
                  Product
                </td>
                <td>
                  Quantity
                </td>
                <td>
                  Price
                </td>
                <td>
                  Total
                </td>
            </tr>
          <?php foreach ($invoice['cart'] as $key => $value):?>
            <tr class="item">
              <td>
                <?php echo $value['product']; ?>
              </td>
              <td>
                <?php echo $value['quantity']; ?>
              </td>
              <td>
                <?php echo number_format($value['price'],2); ?>
              </td>
              <td>
                <?php echo number_format($value['total'],2); ?>
              </td>
            </tr>
           <?php endforeach; ?>

            <tr class="total first">
              <td colspan="2">

              </td>
              <td colspan="2">
                Subtotal: $<?php echo number_format($invoice['subtotal'],2); ?>
              </td>
            </tr>

            <tr class="total">
              <td colspan="2">

              </td>
             <td colspan="2">
                Shipping: $<?php echo number_format($invoice['shipping'],2); ?>
             </td>
            </tr>

            <tr class="total">
              <td colspan="2">

              </td>
             <td colspan="2">
                Tax: $<?php echo number_format($invoice['tax'],2); ?>
             </td>
            </tr>

            <tr class="total last">
              <td colspan="2">

              </td>
              <td colspan="2">
                 Total: $<?php echo number_format($invoice['total'],2); ?>
              </td>
            </tr>
        </table>

        <p>
          Template thanks to : <a href="https://github.com/NextStepWebs/simple-html-invoice-template">https://github.com/NextStepWebs/simple-html-invoice-template</a>
        </p>
    </div>
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
  $dompdf->loadHtml($html);
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  // Render the HTML as PDF
  $dompdf->render();
  // Output the generated PDF to Browser
  $dompdf->stream("receipt.pdf", array( 'Attachment' => false ) );
  exit(0);

?>
