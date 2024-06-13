<?php
session_start();
include_once "../config/DBUntil.php";

$db = new DBUntil();
$order = $db->select("SELECT DATE(created_at) as order_date, SUM(quantity * price) AS total_revenue 
                      FROM order_details 
                      GROUP BY order_date");
$datajson = json_encode($order);

?>

<!DOCTYPE html>
<html>

<head>
     <title>Doanh thu</title>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
     #revenueChart {
          max-width: 100%;
          max-height: 90%;
     }
</style>

<body>
     <h2 class="mt-3" style="text-align: center">Thống kê doanh thu</h2>
     <canvas id="revenueChart"></canvas>
     <script>
          var data = <?php echo $datajson; ?>;

          var labels = data.map(function(e) {
               return e.order_date;
          });
          var amounts = data.map(function(e) {
               return e.total_revenue;
          });

          var ctx = document.getElementById('revenueChart').getContext('2d');
          var revenueChart = new Chart(ctx, {
               type: 'bar',
               data: {
                    labels: labels,
                    datasets: [{
                         label: 'Doanh thu',
                         data: amounts,
                         backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                         ],
                         borderColor: [
                              'rgba(255, 99, 132, 1)',
                         ],
                         borderWidth: 1
                    }]
               },
               options: {
                    scales: {
                         y: {
                              beginAtZero: true
                         }
                    }
               }
          });
     </script>
</body>

</html>
