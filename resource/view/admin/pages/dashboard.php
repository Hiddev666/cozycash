<div class="dashboard">

<div class="dashboard-stats-container">

    <div class="stats-container">
     <div class="stats-header">
          <p>Sales</p>

               <form action="" method="POST">
                    <select name="stats" onchange="submit();" class="select-stats">
                    <option value="01" <?= checkLastStats("01")?>>Jan</option>
                    <option value="02" <?= checkLastStats("02")?>>Feb</option>
                    <option value="03" <?= checkLastStats("03")?>>Mar</option>
                    <option value="04" <?= checkLastStats("04")?>>Apr</option>
                    <option value="05" <?= checkLastStats("05")?>>May</option>
                    <option value="06" <?= checkLastStats("06")?>>Jun</option>
                    <option value="07" <?= checkLastStats("07")?>>Jul</option>
                    <option value="08" <?= checkLastStats("08")?>>Aug</option>
                    <option value="09" <?= checkLastStats("09")?>>Sep</option>
                    <option value="10" <?= checkLastStats("10")?>>Oct</option>
                    <option value="11" <?= checkLastStats("11")?>>Nov</option>
                    <option value="12" <?= checkLastStats("12")?>>Dec</option>
               </select>
          </form>
     </div>
    <?php
     
     include "../../../config/database.php";

     if($_POST['stats'] != NULL) {
          $statsSelected = $_POST['stats']; 
     } else {
          $statsSelected = "01";
     }

     $now = date('Y-m-d');
     
     $queryStatsMonth = mysqli_query($conn, "SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as sumamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%2023-$statsSelected%' GROUP BY date_recorded ORDER BY sales_id) sales;");
     $queryStatsMonthArr = mysqli_fetch_array($queryStatsMonth);
     $queryStatsMonthMost = mysqli_query($conn, "SELECT product_code, MAX(sumproductid) from (SELECT sales.date_recorded, sales.product_id, products.product_code, COUNT(sales.product_id) as sumproductid from sales inner join products on sales.product_id = products.product_id where sales.date_recorded like '%2023-$statsSelected%' GROUP BY product_id) sales;");
     $queryStatsMonthMostArr = mysqli_fetch_array($queryStatsMonthMost);

     $queryStatsToday = mysqli_query($conn, "SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as sumamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%$now%' GROUP BY date_recorded ORDER BY sales_id) sales;");
     $queryStatsTodayArr = mysqli_fetch_array($queryStatsToday);
     $queryStatsTodayMost = mysqli_query($conn, "SELECT product_code, MAX(sumproductid) from (SELECT sales.date_recorded, sales.product_id, products.product_code, COUNT(sales.product_id) as sumproductid from sales inner join products on sales.product_id = products.product_id where sales.date_recorded like '%$now%' GROUP BY product_id) sales;");
     $queryStatsTodayMostArr = mysqli_fetch_array($queryStatsTodayMost);

     
     $queryStats = mysqli_query($conn, "SELECT date_recorded, COUNT(sales_id) as total FROM sales WHERE date_recorded LIKE '%2023-$statsSelected%' GROUP BY date_recorded ORDER BY sales_id;");
     

          $dataPoints = array(
          );

          $i = 1;
     foreach($queryStats as $row) {
          $dateFormated = substr($row['date_recorded'], 8);
          array_push($dataPoints, array("x" => $dateFormated, "y" => $row['total'])); 
          $i++;
     }
     $time = " " . date("M", strtotime($row['date_recorded']));
     
    ?>
    <script>
    window.onload = function () {
     
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
          suffix: <?php echo json_encode($time);?>,
          lineColor: "white",
          lineThickness: 0,
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
              toolTipContent: "{y} Penjualan",
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
     
    chart.render();
     
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
                    <p class="sales-month-total"><?= $queryStatsMonthArr['sumtotal']?></p>
               </div>
                <div class="sales-detail">
                    <div>
                         <p>Month</p>
                         <p><?= date("M", strtotime($queryStatsMonthArr['date_recorded']));?></p>
                    </div>
                    <div>
                         <p>Amount</p>
                         <p><?= "Rp." . number_format($queryStatsMonthArr['sumamount'],0,',','.')?></p>
                    </div>
                    <!-- SELECT SUM(total) as sumtotal, date_recorded, SUM(amount) as totalamount from (SELECT date_recorded, COUNT(sales_id) as total, SUM(products.unit_price) as amount FROM sales inner join products on sales.product_id = products.product_id WHERE date_recorded LIKE '%2023-12%' GROUP BY date_recorded ORDER BY sales_id) sales; -->
                    <div>
                         <p>Most Sale Product</p>
                         <p><?= $queryStatsMonthMostArr['product_code']?></p>
                    </div>
                </div>
           </div>
           <div class="sales-today">
           <div class="sales-month-header">
                    <div>
                         <img src="../../img/clock-svgrepo-com.svg" alt="">
                         <p>Sales Today</p>
                    </div>
                    <p class="sales-month-total"><?= $queryStatsTodayArr['sumtotal']?></p>
               </div>
               <div class="sales-detail">
                    <div>
                         <p>Date</p>
                         <p><?= $now?></p>
                    </div>
                    <div>
                         <p>Amount</p>
                         <p><?= "Rp." . number_format($queryStatsTodayArr['sumamount'],0,',','.')?></p>
                    </div>
                    <div>
                         <p>Most Sale Product</p>
                         <p><?= $queryStatsTodayMostArr['product_code']?></p>
                    </div>
                </div>
           </div>
     </div>
</div>


<div class="sales-table-container">
          <div class="stats-table-header">
          <p>Sales</p>
          <div class="stats-table-menu">
               <div>
                    <form action="" method="POST">
                                        <select name="stats" onchange="submit();" class="select-stats">
                                        <option value="01" <?= checkLastStats("01")?>>Jan</option>
                                        <option value="02" <?= checkLastStats("02")?>>Feb</option>
                                        <option value="03" <?= checkLastStats("03")?>>Mar</option>
                                        <option value="04" <?= checkLastStats("04")?>>Apr</option>
                                        <option value="05" <?= checkLastStats("05")?>>May</option>
                                        <option value="06" <?= checkLastStats("06")?>>Jun</option>
                                        <option value="07" <?= checkLastStats("07")?>>Jul</option>
                                        <option value="08" <?= checkLastStats("08")?>>Aug</option>
                                        <option value="09" <?= checkLastStats("09")?>>Sep</option>
                                        <option value="10" <?= checkLastStats("10")?>>Oct</option>
                                        <option value="11" <?= checkLastStats("11")?>>Nov</option>
                                        <option value="12" <?= checkLastStats("12")?>>Dec</option>
                                   </select>
                              </form>
               </div>
     
               <div>
                    <form action="" method="POST">
                                        <select name="stats" onchange="submit();" class="select-stats">
                                        <option value="01" <?= checkLastStats("01")?>>Jan</option>
                                        <option value="02" <?= checkLastStats("02")?>>Feb</option>
                                        <option value="03" <?= checkLastStats("03")?>>Mar</option>
                                        <option value="04" <?= checkLastStats("04")?>>Apr</option>
                                        <option value="05" <?= checkLastStats("05")?>>May</option>
                                        <option value="06" <?= checkLastStats("06")?>>Jun</option>
                                        <option value="07" <?= checkLastStats("07")?>>Jul</option>
                                        <option value="08" <?= checkLastStats("08")?>>Aug</option>
                                        <option value="09" <?= checkLastStats("09")?>>Sep</option>
                                        <option value="10" <?= checkLastStats("10")?>>Oct</option>
                                        <option value="11" <?= checkLastStats("11")?>>Nov</option>
                                        <option value="12" <?= checkLastStats("12")?>>Dec</option>
                                   </select>
                              </form>
               </div>
          </div>
     </div>
</div>
</div>