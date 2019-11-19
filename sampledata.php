<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div id="teacher_chart">
    </div>

    <div id="sample-data">

    </div>

    <script>
        // function getTotalTeacher() {
        //     let xhr = new XMLHttpRequest();
        //     xhr.open('GET', './ajax/totalteacher_ajax.php');
        //     xhr.onload = function() {
        //         try {
        //             // console.log(this.responseText);
        //             let result_arr = [];
        //             result_arr.push(this.responseText);
        //             result_arr.forEach
        //         } catch (err) {
        //             console.log(err);
        //         }
        //     }
        //     xhr.send();
        // }

        // results = JSON.parse(getTotalTeacher());
        // console.log(results);
        // results.forEach(function(result) {
        //     console.log(result);
        // });

        fetch('ajax/totalteacher_ajax.php').then(function(response) {
            console.log(response);
        }).then(function(obj) {
            console.log(obj);
        }).catch(function(error) {
            console.error('Error')
        })
    </script>

    <script>
        /* Chart for Teacher Count Chart */
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAxisTickColors);

        function drawAxisTickColors() {
            var data = google.visualization.arrayToDataTable([
                ['School', 'Teacher', 'Master Teacher'],
                ['AMA', 5, 15],
                ['STI', 2, 13],
                ['UE', 14, 8]





            ]);

            var options = {


                title: 'Live Count of Teachers and Master Teachers',
                chartArea: {
                    width: '45%'
                },
                hAxis: {
                    title: 'Total of Master Teachers and Teachers',
                    minValue: 1,
                    maxValue: 50,
                    textStyle: {
                        bold: false,
                        fontSize: 10,
                        color: '#4d4d4d'
                    },
                    titleTextStyle: {
                        bold: true,
                        fontSize: 12,
                        color: '#4d4d4d'
                    }
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('teacher_chart'));
            chart.draw(data, options);
        }
        //  End of Sample Chart for Admin
    </script>

</body>


</html>