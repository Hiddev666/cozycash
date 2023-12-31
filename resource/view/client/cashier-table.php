<?php
include "../../../config/database.php";
session_start();

$invoice_id = (int)$_SESSION['invoice_id'];

$rows = mysqli_query($conn, "SELECT sales.sales_id, invoices.invoice_id, products.product_id, products.product_code, products.product_name, products.unit_price, products.discount_percentage, COUNT(products.product_code) as quantity, SUM(products.unit_price) as subtotal, CEILING(SUM(products.unit_price) - products.discount_percentage*SUM(products.unit_price)) as discounted FROM products INNER JOIN sales ON sales.product_id = products.product_id INNER JOIN invoices ON invoices.invoice_id = sales.invoice_id WHERE invoices.invoice_id=$invoice_id GROUP BY products.product_code order by sales.sales_id DESC;");

?>


    <table>
        <thead>
            <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Sub Total</th>
            </thead>
            <tbody>
                <?php 
                foreach($rows as $row) {
                    $incrementURL = "cashier-increment.php?invoice_id=" . $row['invoice_id'] . "&product_id=" . $row['product_id'];
                    $decrementURL = "cashier-decrement.php?sales_id=" . $row['sales_id'] . "&product_id=" . $row['product_id'];
                ?>
                <tr>
                    <td><?= $row['product_code']?></td>
                    <td class="nama-barang"><?= $row['product_name']?></td>
                    <td><?= "Rp." . number_format($row['unit_price'],0,',','.')?></td>
                    <td style="display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?= $decrementURL?>">
                            <button class="btn-decrement">-</button>
                        </a>    
                        <p><?= $row['quantity']?></p>
                        <a href="<?= $incrementURL?>">
                            <button class="btn-increment">+</button>
                        </a>
                    </td>
                    <td><?= $row['discount_percentage']*100?>%</td>
                    <td><?php
                    if($row['discount_percentage'] != 0) {
                        echo "<s style='color: red;'>Rp." . number_format($row['subtotal'],0,',','.') . "</s>";
                    }
                    echo "<br/>";
                    echo " Rp." . number_format($row['discounted'],0,',','.');
                    ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        </div>

        