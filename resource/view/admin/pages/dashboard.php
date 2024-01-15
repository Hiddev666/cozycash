<?php
include "../../../config/database.php";
if (!isset($_GET['statstype'])) {
     $_GET['statstype'] = "months";
}
?>

<div class="dashboard">

     <div class="dashboard-stats-container">

          <div class="stats-container">
               <div class="stats-header">
                    <p>Sales</p>
                    <div class="stats-orderby">
                         <a href="?page=<?= $_GET['page'] ?>&statstype=months">
                              <button class="stats-orderby-btn<?php setActiveStats("months") ?>" name="statstype"
                                   value="months">Months</button>
                         </a>
                         <a href="?page=<?= $_GET['page'] ?>&statstype=years">
                              <button class="stats-orderby-btn<?= setActiveStats("years") ?>" name="statstype"
                                   value="years">Years</button>
                         </a>
                    </div>

                    <div class="statstype-wrapper">

                         <?php

                         $yearsQuery = mysqli_query($conn, "SELECT YEAR(date_recorded) as year from sales GROUP BY year;");


                         if ($_GET['statstype'] == "months") { ?>
                              <form action="" method="POST">
                                   <select name="statsyear" onchange="submit();" class="select-stats">

                                        <?php foreach ($yearsQuery as $year) { ?>

                                             <option value="<?= $year['year'] ?>" <?= checkLastStatsYear($year['year']) ?>>
                                                  <?= $year['year'] ?>
                                             </option>

                                             <?php
                                        }
                                        ?>
                                   </select>


                              <?php }

                         if ($_GET['statstype'] == "years") {

                              $statsYearsQuery = mysqli_query($conn, "SELECT YEAR(date_recorded) as year from sales GROUP BY year;");
                              ?>
                                   <form action="" method="POST">
                                        <select name="statsyear" onchange="submit();" class="select-stats">
                                             <?php
                                             foreach ($statsYearsQuery as $statsYear) {
                                                  ?>

                                                  <option value="<?= $statsYear['year'] ?>"
                                                       <?= checkLastStatsYear($statsYear['year']) ?>>
                                                       <?= $statsYear['year'] ?>
                                                  </option>


                                             <?php } ?>
                                        </select>
                                   </form>

                              <?php } else { ?>

                                   <select name="stats" onchange="submit();" class="select-stats">
                                        <option value="01" <?= checkLastStats("01") ?>>Jan</option>
                                        <option value="02" <?= checkLastStats("02") ?>>Feb</option>
                                        <option value="03" <?= checkLastStats("03") ?>>Mar</option>
                                        <option value="04" <?= checkLastStats("04") ?>>Apr</option>
                                        <option value="05" <?= checkLastStats("05") ?>>May</option>
                                        <option value="06" <?= checkLastStats("06") ?>>Jun</option>
                                        <option value="07" <?= checkLastStats("07") ?>>Jul</option>
                                        <option value="08" <?= checkLastStats("08") ?>>Aug</option>
                                        <option value="09" <?= checkLastStats("09") ?>>Sep</option>
                                        <option value="10" <?= checkLastStats("10") ?>>Oct</option>
                                        <option value="11" <?= checkLastStats("11") ?>>Nov</option>
                                        <option value="12" <?= checkLastStats("12") ?>>Dec</option>
                                   </select>

                              <?php }

                         ?>


                         </form>
                    </div>
               </div>
               <?php

               // $yearsQuery = mysqli_query($conn, "SELECT date_recorded, YEAR(date_recorded) as year, COUNT(sales_id) as total from sales GROUP BY year;");
               

               include "../../../config/database.php";


               $now = date('Y-m-d');
               $nowYear = date('Y');

               $statsType = $_GET["statstype"];
               $statsYear = $_POST['statsyear'];

               if ($_POST['statsyear'] != NULL) {
                    $statsSelected = $_POST['stats'];
               } else {
                    $statsYear = $nowYear;
                    $statsSelected = "01";
               }



               $queryStatsMonth = mysqli_query($conn, "SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as sumamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%$statsYear-$statsSelected%' GROUP BY date_recorded ORDER BY sales_id) sales;");
               $queryStatsMonthArr = mysqli_fetch_array($queryStatsMonth);
               $queryStatsMonthMost = mysqli_query($conn, "SELECT product_code, MAX(sumproductid) from (SELECT sales.date_recorded, sales.product_id, products.product_code, COUNT(sales.product_id) as sumproductid from sales inner join products on sales.product_id = products.product_id where sales.date_recorded like '%2024-$statsSelected%' GROUP BY product_id) sales;");
               $queryStatsMonthMostArr = mysqli_fetch_array($queryStatsMonthMost);

               $selectedMonth = $queryStatsMonthArr['date_recorded'];

               $queryStatsToday = mysqli_query($conn, "SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as sumamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%$now%' GROUP BY date_recorded ORDER BY sales_id) sales;");
               $queryStatsTodayArr = mysqli_fetch_array($queryStatsToday);
               $queryStatsTodayMost = mysqli_query($conn, "SELECT product_code, MAX(sumproductid) from (SELECT sales.date_recorded, sales.product_id, products.product_code, COUNT(sales.product_id) as sumproductid from sales inner join products on sales.product_id = products.product_id where sales.date_recorded like '%$now%' GROUP BY product_id) sales;");
               $queryStatsTodayMostArr = mysqli_fetch_array($queryStatsTodayMost);



               $statsMax = 31;
               $tableInvoiceQuery = "SELECT * FROM invoices WHERE date_recorded like '%$statsYear-$statsSelected%' ORDER BY invoice_id desc";
               $statsQuery = "SELECT date_recorded, COUNT(sales_id) as total from sales where date_recorded LIKE '%$statsYear-$statsSelected%' GROUP BY date_recorded;";
               if ($statsType == "years") {
                    $statsMax = 12;
                    $statsQuery = "SELECT date_recorded, MONTH(date_recorded) as month, COUNT(sales_id) as total from sales where date_recorded LIKE '%$statsYear%' GROUP BY month;";
               }

               $queryTableInvoice = mysqli_query($conn, $tableInvoiceQuery);
               $queryStats = mysqli_query($conn, $statsQuery);
               $queryStatsCount = mysqli_num_rows($queryStats);

               $dataPoints = array(
               );

               $i = 1;
               foreach ($queryStats as $row) {
                    $dateFormated = substr($row['date_recorded'], 8);
                    if ($statsType == "years") {
                         $dateFormated = $row['month'];
                    }
                    array_push($dataPoints, array("x" => $dateFormated, "y" => $row['total']));
                    $i++;
               }
               $tooltip = "Date";
               $time = " " . date("M", strtotime($row['date_recorded']));
               if ($statsType == "years") {
                    $time = " | " . $statsYear;
                    $tooltip = "Month";
               }

               ?>

               <?php
               if ($queryStatsCount == 0) {
                    ?>

                    <div class="no-stats">
                         <img src="../../img/no-data.svg" alt="">
                         <p>There is no data on this month!</p>
                    </div>

               <?php } ?>

               <script>
                    window.onload = function () {

                         let statsCount = <?= $queryStatsCount; ?>

                         if (statsCount !== 0) {
                              var chart = new CanvasJS.Chart("chartContainer", {
                                   animationEnabled: true,
                                   zoomEnabled: true,
                                   animationDuration: 2000,
                                   axisY: {
                                        // suffix: " Penjualan",
                                        gridColor: "white",
                                        labelFontColor: "white,",
                                        tickColor: "white",
                                        lineColor: "white",
                                   },
                                   axisX: {
                                        suffix: <?php echo json_encode($time); ?>,
                                        lineColor: "white",
                                        lineThickness: 0,
                                        minimum: 1,
                                        maximum: <?php echo $statsMax; ?>,
                                        labelFontColor: "#505050",
                                        tickColor: "white",
                                   },
                                   toolTip: {
                                        fontColor: "#505050",
                                        cornerRadius: 6,
                                        borderColor: "#F49D1A",
                                   },
                                   data: [{
                                        type: "spline",
                                        markerSize: 8,
                                        markerType: "none",
                                        lineColor: "#F49D1A",
                                        markerColor: "#d18513",
                                        lineThickness: 3.5,
                                        toolTipContent: "<?= $tooltip; ?> {x} | {y} Sales",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                   }]
                              });

                              chart.render();
                         }
                    }
               </script>
               <div id="chartContainer" class="stats"></div>
               <script src="../../../js/canvasjs.min.js"></script>
          </div>
          <div class="sales-total-container">
               <div class="sales-month">
                    <div class="sales-month-header">
                         <div>
                              <img src="../../img/calendar-alt-svgrepo-com.svg" alt="">
                              <p>Sales This Month</p>
                         </div>
                         <p class="sales-month-total">
                              <?= $queryStatsMonthArr['sumtotal'] ?>
                         </p>
                    </div>
                    <div class="sales-detail">
                         <div>
                              <p>Month</p>
                              <p>
                                   <?= date("M", strtotime($queryStatsMonthArr['date_recorded'])); ?>
                              </p>
                         </div>
                         <div>
                              <p>Amount</p>
                              <p>
                                   <?= "Rp." . number_format($queryStatsMonthArr['sumamount'], 0, ',', '.') ?>
                              </p>
                         </div>
                         <!-- SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as totalamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%2024-12%' GROUP BY date_recorded ORDER BY sales_id) sales; -->
                         <div>
                              <p>Most Sale Product</p>
                              <p>
                                   <?= $queryStatsMonthMostArr['product_code'] ?>
                              </p>
                         </div>
                    </div>
               </div>
               <div class="sales-today">
                    <div class="sales-month-header">
                         <div>
                              <img src="../../img/clock-svgrepo-com.svg" alt="">
                              <p>Sales Today</p>
                         </div>
                         <p class="sales-month-total">
                              <?= $queryStatsTodayArr['sumtotal'] ?>
                         </p>
                    </div>
                    <div class="sales-detail">
                         <div>
                              <p>Date</p>
                              <p>
                                   <?= $now ?>
                              </p>
                         </div>
                         <div>
                              <p>Amount</p>
                              <p>
                                   <?= "Rp." . number_format($queryStatsTodayArr['sumamount'], 0, ',', '.') ?>
                              </p>
                         </div>
                         <div>
                              <p>Most Sale Product</p>
                              <p>
                                   <?= $queryStatsTodayMostArr['product_code'] ?>
                              </p>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <div class="sales-table-container">
          <div class="stats-table-header">
               <?php
               if ($selectedMonth == NULL) { ?>
                    <div class="no-stats-table">
                         <img src="../../img/no-data.svg" alt="">
                    </div>
               <?php } else { ?>
                    <p>Sales on
                         <?= date("M", strtotime($selectedMonth)); ?>
                    </p>
               <?php } ?>
          </div>

          <table class="table-invoice">
               <thead>
                    <th>Invoice ID</th>
                    <th>Date Recorded</th>
                    <th>Amount</th>
                    <th>Products</th>
               </thead>
               <tbody>
                    <?php

                    foreach ($queryTableInvoice as $inv) { ?>
                         <tr>
                              <td>
                                   <?= $inv['invoice_id'] ?>
                              </td>
                              <td>
                                   <?= $inv['date_recorded'] ?>
                              </td>
                              <td>
                                   <?= $inv['total_amount'] ?>
                              </td>
                              <td>
                                             <select name="" id="" class="invoice-list">
                                                  <?php
                                                  $invId = $inv['invoice_id'];
                                                  $querySalesTable = mysqli_query($conn, "SELECT products.product_name, COUNT(products.product_code) as quantity FROM products INNER JOIN sales ON sales.product_id = products.product_id INNER JOIN invoices ON invoices.invoice_id = sales.invoice_id WHERE invoices.invoice_id='$invId' GROUP BY products.product_code order by sales.sales_id DESC;");

                                                  foreach ($querySalesTable as $rowSales) { ?>
                                                       <option value="">
                                                            <p>
                                                                 <?= $rowSales['quantity'] ?>
                                                            </p>
                                                            <p>
                                                                 <?= $rowSales['product_name'] ?>
                                                            </p>
                                                       </option>
                                                  <?php } ?>
                                             </select>
                              </td>
                         </tr>

                    <?php } ?>
               </tbody>
          </table>
     </div>
</div>