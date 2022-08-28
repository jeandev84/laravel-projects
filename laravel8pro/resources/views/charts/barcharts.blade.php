<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BarCharts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- HighCharts Script -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

    <div style="height: 400px;width:900px;margin:auto;">
        <canvas id="barChart"></canvas>
    </div>



    <script>

        $(function () {

            let items = <?php echo json_encode($items); ?>

            let barCanvas = $("#barChart");
            let barChar   = new Chart(barCanvas, {
                 type: 'bar',
                 data: {
                     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                     datasets: [
                         {
                             label: 'New User Growth 2022',
                             data: items,
                             backgroundColor: [
                                 'red', 'orange', 'yellow',
                                 'green', 'blue', 'indigo',
                                 'violet', 'purple', 'pink',
                                 'silver', 'gold', 'brown'
                             ]
                         }
                     ]
                 },
                 options: {
                     scales: {
                         yAxes: {
                             ticks: {
                                 beginAtZero: true
                             }
                         }
                     }
                 }
            });
        })

    </script>
</body>
</html>
