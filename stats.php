<?php
include_once './header.php';
include_once './db.php';
include_once './session.php';
if ($_SESSION['logged'] != 1) {
    header("Location: index.php");
}
IF(isset($_GET["year"])){
    $selectedYear = $_GET["year"];
} else {
    $selectedYear = date("Y");
}
?>

<!-- Main -->
<section id="main" class="wrapper style1">
    <header class="major">
        <h2>My stats</h2>
        <p>See your stats</p>
    </header>
    <div class="container">
        <div class="row">
            <div class="3u">
                <h3>Select a year</h3>
                <select name="year">
                    <option selected disabled hidden value=''></option>
                    <?php
                    $query2 = "SELECT day FROM bills WHERE user_id = '" . $_SESSION['user_id'] . "' ORDER BY day DESC;";
                    $query2 = mysqli_query($link, $query2);

                    while ($row2 = mysqli_fetch_array($query2)) {
                        $datum = date("Y", strtotime(($row2["day"])));
                        if(!in_array($datum, $years)){
                            $years[] = $datum;
                        }
                    }
                    foreach ($years as $year) {
                        echo '<option ';
                        if ($selectedYear == $year) {
                            echo 'selected = "seleted" ';
                        }
                        echo ' value="' . $year . '">' . $year . '</option>';
                    }

                    ?>
                </select><br />
                <div id="canvas-holder">
                    <canvas id="pieChart" width="250" height="250"/>
                </div>
            </div>
            <div class="8u">
                <center>
                    <canvas id="myChart"></canvas>
                </center>
            </div>
        </div>
        <!--<div class="row">
            <div id="canvas-holder">
                <canvas id="pieChart" width="250" height="250"/>
            </div>
        </div>-->
        <br />
        <br />
        <div class="row">
            <div class="6u">
                <h3>Select a purpose</h3>
                <select name="purpose">
                    <option selected disabled hidden value=''></option>
                    <?php
                    $query2 = "SELECT * FROM purposes WHERE user_id = '" . $_SESSION['user_id'] . "' OR visible = '1' ORDER BY id ASC;";
                    $query2 = mysqli_query($link, $query2);
                    while ($row2 = mysqli_fetch_array($query2)) {
                        echo '<option ';
                        if ($_GET['id'] == $row2['id']) {
                            echo 'selected = "seleted" ';
                        }
                        echo ' value="' . $row2['id'] . '">' . $row2['name'] . '</option>';
                    }
                    ?>
                </select><br />
            </div>
            <div class="10u">
                <center>
                    <canvas id="myChartP"></canvas>
                </center>
            </div>
        </div>
</section>
<?php
$jan = 0;
$feb = 0;
$mar = 0;
$apr = 0;
$may = 0;
$jun = 0;
$jul = 0;
$aug = 0;
$sep = 0;
$oct = 0;
$nov = 0;
$dec = 0;
$jan2 = 0;
$feb2 = 0;
$mar2 = 0;
$apr2 = 0;
$may2 = 0;
$jun2 = 0;
$jul2 = 0;
$aug2 = 0;
$sep2 = 0;
$oct2 = 0;
$nov2 = 0;
$dec2 = 0;
$query = "SELECT * FROM bills WHERE user_id = " . $_SESSION['user_id'] . " AND day LIKE('%" .$selectedYear . "%')  ORDER BY id ASC;";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)) {

    $date = date("m", strtotime($row['day']));

    switch ($date) {
        case '01':
            $jan = $jan + $row['value'];
            break;
        case '02':
            $feb = $feb + $row['value'];
            break;
        case '03':
            $mar = $mar + $row['value'];
            break;
        case '04':
            $apr = $apr + $row['value'];
            break;
        case '05':
            $may = $may + $row['value'];
            break;
        case '06':
            $jun = $jun + $row['value'];
            break;
        case '07':
            $jul = $jul + $row['value'];
            break;
        case '08':
            $aug = $aug + $row['value'];
            break;
        case '09':
            $sep = $sep + $row['value'];
            break;
        case '10':
            $oct = $oct + $row['value'];
            break;
        case '11':
            $nov = $nov + $row['value'];
            break;
        case '12':
            $dec = $dec + $row['value'];
            break;
    }
}

if ($_GET['id'] != '') {
    $query3 = "SELECT * FROM bills WHERE user_id = " . $_SESSION['user_id'] . " && purpose_id = " . $_GET['id'] . " ORDER BY id ASC;";
    $result3 = mysqli_query($link, $query3);
    while ($row = mysqli_fetch_assoc($result3)) {

        $date = date("m", strtotime($row['day']));

        switch ($date) {
            case '01':
                $jan2 = $jan2 + $row['value'];
                break;
            case '02':
                $feb2 = $feb2 + $row['value'];
                break;
            case '03':
                $mar2 = $mar2 + $row['value'];
                break;
            case '04':
                $apr2 = $apr2 + $row['value'];
                break;
            case '05':
                $may2 = $may2 + $row['value'];
                break;
            case '06':
                $jun2 = $jun2 + $row['value'];
                break;
            case '07':
                $jul2 = $jul2 + $row['value'];
                break;
            case '08':
                $aug2 = $aug2 + $row['value'];
                break;
            case '09':
                $sep2 = $sep2 + $row['value'];
                break;
            case '10':
                $oct2 = $oct2 + $row['value'];
                break;
            case '11':
                $nov2 = $nov2 + $row['value'];
                break;
            case '12':
                $dec2 = $dec2 + $row['value'];
                break;
        }
    }
}
?>
<script>
    $(document).on("change", "select[name=purpose]", function () {
        location.replace("https://obm.azurewebsites.net/stats.php?id=" + $(this).val()+ "<?php if(isset($_GET["year"])) { echo "&year=".$_GET["year"]; } ?>");
    });
    
    $(document).on("change", "select[name=year]", function () {
        location.replace("https://obm.azurewebsites.net/stats.php?year=" + $(this).val()+ "<?php if(isset($_GET["id"])) { echo "&id=".$_GET["id"]; } ?>");
    });

    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [<?php echo $jan; ?>,<?php echo $feb; ?>,<?php echo $mar; ?>,<?php echo $apr; ?>,<?php echo $may; ?>,<?php echo $jun; ?>,<?php echo $jul; ?>,<?php echo $aug; ?>,<?php echo $sep; ?>,<?php echo $oct; ?>,<?php echo $nov; ?>,<?php echo $dec; ?>]
            }/*,
             {
             label: "My Second dataset",
             fillColor : "rgba(151,187,205,0.2)",
             strokeColor : "rgba(151,187,205,1)",
             pointColor : "rgba(151,187,205,1)",
             pointStrokeColor : "#fff",
             pointHighlightFill : "#fff",
             pointHighlightStroke : "rgba(151,187,205,1)",
             data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
             }*/
        ]

    }

    var lineChartDataP = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
            {
                label: "Purposes dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [<?php echo $jan2; ?>,<?php echo $feb2; ?>,<?php echo $mar2; ?>,<?php echo $apr2; ?>,<?php echo $may2; ?>,<?php echo $jun2; ?>,<?php echo $jul2; ?>,<?php echo $aug2; ?>,<?php echo $sep2; ?>,<?php echo $oct2; ?>,<?php echo $nov2; ?>,<?php echo $dec2; ?>]
            }
        ]

    }
    
    /*var pieData = [
				{
					value: 300,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Red"
				},
				{
					value: 50,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Green"
				},
				{
					value: 100,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Yellow"
				},
				{
					value: 40,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Grey"
				},
				{
					value: 120,
					color: "#4D5360",
					highlight: "#616774",
					label: "Dark Grey"
				}

			];*/
    
    var pieData = [
        <?php
            $queryP = "SELECT p.name, SUM(b.value) as sumvalue FROM bills b INNER JOIN purposes p ON p.id = b.purpose_id WHERE b.user_id = " . $_SESSION['user_id'] . " AND b.day LIKE('%" .$selectedYear . "%') GROUP BY p.name ORDER BY SUM(b.value) DESC;";
            $resultP = mysqli_query($link, $queryP);
            
            $x = 1;
            while ($rowP = mysqli_fetch_assoc($resultP)) {
                
                switch ($x) {
                    case '1':
                        echo '{
                                value: '.round($rowP['sumvalue'], 2).',
                                color:"#F7464A",
                                highlight: "#FF5A5E",
                                label: "'.$rowP['name'].'"
                            },';
                        break;
                    case '2':
                        echo '{
                                value: '.round($rowP['sumvalue'], 2).',
                                color: "#46BFBD",
                                highlight: "#5AD3D1",
                                label: "'.$rowP['name'].'"
                            },';
                        break;
                    case '3':
                        echo '{
                                value: '.round($rowP['sumvalue'], 2).',
                                color: "#FDB45C",
                                highlight: "#FFC870",
                                label: "'.$rowP['name'].'"
                            },';
                        break;
                    case '4':
                        echo '{
                                value: '.round($rowP['sumvalue'], 2).',
                                color: "#949FB1",
                                highlight: "#A8B3C5",
                                label: "'.$rowP['name'].'"
                            },';
                        break;
                    case '5':
                        echo '{
                                value: '.round($rowP['sumvalue'], 2).',
                                color: "#4D5360",
                                highlight: "#616774",
                                label: "'.$rowP['name'].'"
                            }';
                        break;
                }
                
                $x++;
            }
         ?>
    ];

    window.onload = function () {
        var ctx = document.getElementById("myChart").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive: true
        });
        var ctxP = document.getElementById("myChartP").getContext("2d");
        window.myLineP = new Chart(ctxP).Line(lineChartDataP, {
            responsive: true
        });
        var ctxPie = document.getElementById("pieChart").getContext("2d");
        window.myPie = new Chart(ctxPie).Pie(pieData);
    }


</script>

<?php
include_once './footer.php';
?>