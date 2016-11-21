<?php require_once __DIR__.'/receipt.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>invoice #<?php echo $invoice['id'] ?></title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
  </head>
  <body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                Humber College
                            </td>

                            <td>
                                Invoice #: <?php echo $invoice['id'] ?><br>
                                Status: <?php echo $invoice['status'] ?><br>
                                Date: <?php echo $invoice['date'] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?php echo$invoice['address']['street']; ?>, <?php echo$invoice['address']['postal']; ?><br>
                                <?php echo$invoice['address']['province']; ?>, <?php echo$invoice['address']['country']; ?>
                            </td>

                            <td>
                                <?php echo$invoice['contact']['last']; ?>, <?php echo$invoice['contact']['first']; ?><br>
                                <?php echo$invoice['contact']['email']; ?>
                            </td>
                        </tr>
                    </table>
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
               <td></td>

               <td>
                  Subtotal: $<?php echo number_format($invoice['subtotal'],2); ?>
               </td>
            </tr>

            <tr class="total">
               <td></td>

               <td>
                  Shipping: $<?php echo number_format($invoice['shipping'],2); ?>
               </td>
            </tr>

            <tr class="total">
               <td></td>

               <td>
                  Tax: $<?php echo number_format($invoice['tax'],2); ?>
               </td>
            </tr>

            <tr class="total last">
                <td></td>

                <td>
                   Total: $<?php echo number_format($invoice['total'],2); ?>
                </td>
            </tr>
        </table>
    </div>
  </body>
</html>
