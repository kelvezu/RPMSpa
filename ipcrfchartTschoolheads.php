<?php

include 'sampleheader.php';

if (isset($_POST['view'])) :
  if (empty($_POST['sy_id']) || empty($_POST['teacher_id'])) :
    $sy_id = $_POST['active_sy'];
    $school_id = $_POST['school_id'];
    $position = "Teacher I";

    $ipcrf_array = [];
    $qry = $conn->query("SELECT * FROM ipcrf_t  WHERE sy_id = '$sy_id' AND school_id = '$school_id'  ") or die($conn->error);
    if (mysqli_num_rows($qry) == 0) :
        echo '<div class="red-notif-border">Average IPCRF is not available</div>';
        exit();
    else :
        foreach ($qry as $ipcrf) :
        array_push($ipcrf_array, $ipcrf);
        endforeach;
    endif;


?>

<div class="container">

  <div class="card-header bg-success">
    <div class=" text-center h4 text-white">IPCRF Average Per Year</div>
  </div>
  <div class="card-body ">
  <input class="btn-success text-white btn-sm" id="save-pdf" type="button" value="Save as PDF" disabled />
    <div class="d-flex justify-content-center">
      <div id="chartipcrf_ave" style="width: 1200px; height: 500px;"></div>
    </div>
  </div>

  <div class="card-header bg-success">
    <div class=" text-center h4 text-white">IPCRF Average Per Rating(Current SY)</div>
  </div>
  <div class="card-body ">
  <input class="btn-success text-white btn-sm" id="save-pdf2" type="button" value="Save as PDF" disabled />
    <div class="d-flex justify-content-center">
      <div id="chartIPCRF2" style="width: 1200px; height: 500px;"></div>
    </div>
  </div>

</div>

<!-- IPCRF Chart Function -->

<script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(chartIPCRFave);

      function chartIPCRFave() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Obj_id','Current SYear','Last Year 2','Last Year 3','Average'],
          <?php

              $qry = $conn->query("SELECT a.obj_id, round(a.sy)as sy, round(a.sy2)as sy2 ,round(a.sy3)as sy3,round(avg(a.average))as average  FROM
              (SELECT obj_id,AVG(average) average,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') - 2 then avg(average) else 0 end as sy3,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') - 1 then avg(average) else 0 end as sy2,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') then avg(average) else 0 end as sy
                
               FROM ipcrf_t WHERE school_id = '$school_id'  GROUP BY obj_id) a
                GROUP BY a.obj_id") or die($conn->error);
              while ($cotQry2 = $qry->fetch_assoc()) :
                echo "['" . $cotQry2['obj_id'] . "', 
                " . $cotQry2['sy'] . ",  
                " . $cotQry2['sy2'] . ",   
                " . $cotQry2['sy3'] . ", 
                " . $cotQry2['average'] . "],";
              endwhile;
              ?>
        ]);

        var options = {
        title: 'IPCRF Rating',
        vAxis: {
            title: 'Rating'
        },
        hAxis: {
            title: 'Objective and Rating'
        },
        explorer: {
            axis: 'horizontal',
            keepInBounds: true
        },
        seriesType: 'bars',
        bar: {
            groupWidth: 50
        },
        series: {
            3: {
            type: 'line'
            }
        }
        };

        var container = document.getElementById('chartipcrf_ave');
        var chart = new google.visualization.ComboChart(document.getElementById('chartipcrf_ave'));
        var btnSave = document.getElementById('save-pdf');

        google.visualization.events.addListener(chart, 'ready', function () {
        btnSave.disabled = false;
        });

        btnSave.addEventListener('click', function () {
        var doc = new jsPDF('l');
        doc.addImage(chart.getImageURI(), 0, 0);
        doc.save('chart.pdf');
        }, false);
        chart.draw(data, options);
      }
    </script>

    <!-- End of IPCRF Chart Function -->



<!-- IPCRF Average Chart Function -->

<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(chartIPCRF2);

  function chartIPCRF2() {
    // Some raw data (not necessarily accurate)
    var data = google.visualization.arrayToDataTable([
      ['obj_id', 'Quality', 'Efficiency', 'Timeliness','Average'],
      <?php
      //$tIndi = fetchTindicator($conn);
      //foreach ($tIndi as $indi) :
        $qry = $conn->query("SELECT obj_id,quality,efficiency,timeliness,average
        FROM ipcrf_t WHERE sy_id = '$sy_id' and school_id = '$school_id' group by obj_id order by obj_id,average") or die($conn->error);
        while ($cotQry = $qry->fetch_assoc()) :
          echo "['" . $cotQry['obj_id'] . "', 
                " . $cotQry['quality'] . ",  
                " . $cotQry['efficiency'] . ",   
                " . $cotQry['timeliness'] . ", 
                " . $cotQry['average'] . ", 
                ],";
        endwhile;
    //  endforeach; ?>
    ]);

    var options = {
      title: 'IPCRF Rating',
      vAxis: {
        title: 'Rating'
      },
      hAxis: {
        title: 'Objective and Rating'
      },
      explorer: {
        axis: 'horizontal',
        keepInBounds: true
      },
      seriesType: 'bars',
      bar: {
        groupWidth: 50
      },
      series: {
        3: {
          type: 'line'
        }
      }
    };

    var container = document.getElementById('chartIPCRF2');
    var chart = new google.visualization.ComboChart(document.getElementById('chartIPCRF2'));
    var btnSave = document.getElementById('save-pdf2');

    google.visualization.events.addListener(chart, 'ready', function () {
    btnSave.disabled = false;
    });

    btnSave.addEventListener('click', function () {
    var doc = new jsPDF('l');
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('chart.pdf');
    }, false);
    chart.draw(data, options);
  }
</script>
<!-- End of IPCRF Average Chart Function -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

<?php
  else:

  $sy_id = $_POST['sy_id'];
  $teacher_id = $_POST['teacher_id'];
  $school_id = $_POST['school_id'];
  $position = "Teacher I";

?>



<div class="container">

  <div class="card-header bg-success">
    <div class=" text-center h4 text-white">IPCRF Average Per Year</div>
  </div>
  <div class="card-body ">
  <input class="btn-success text-white btn-sm" id="save-pdf" type="button" value="Save as PDF" disabled />
    <div class="d-flex justify-content-center">
      <div id="chartipcrf_ave" style="width: 1200px; height: 500px;"></div>
    </div>
  </div>

  <div class="card-header bg-success">
    <div class=" text-center h4 text-white">IPCRF Average Per Rating(Current SY)</div>
  </div>
  <div class="card-body ">
  <input class="btn-success text-white btn-sm" id="save-pdf2" type="button" value="Save as PDF" disabled />
    <div class="d-flex justify-content-center">
      <div id="chartIPCRF2" style="width: 1200px; height: 500px;"></div>
    </div>
  </div>

</div>

<!-- IPCRF Chart Function -->

<script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(chartIPCRFave);

      function chartIPCRFave() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Obj_id','Current SYear','Last Year 2','Last Year 3','Average'],
          <?php

              $qry = $conn->query("SELECT a.obj_id, round(a.sy)as sy, round(a.sy2)as sy2 ,round(a.sy3)as sy3,round(avg(a.average))as average  FROM
              (SELECT obj_id,AVG(average) average,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') - 2 then avg(average) else 0 end as sy3,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') - 1 then avg(average) else 0 end as sy2,
               CASE when sy_id = ('" . $_SESSION['active_sy_id'] . "') then avg(average) else 0 end as sy
                
               FROM ipcrf_t WHERE school_id = '$school_id'  GROUP BY obj_id) a
                GROUP BY a.obj_id") or die($conn->error);
              while ($cotQry2 = $qry->fetch_assoc()) :
                echo "['" . $cotQry2['obj_id'] . "', 
                " . $cotQry2['sy'] . ",  
                " . $cotQry2['sy2'] . ",   
                " . $cotQry2['sy3'] . ", 
                " . $cotQry2['average'] . "],";
              endwhile;
              ?>
        ]);

        var options = {
        title: 'IPCRF Rating',
        vAxis: {
            title: 'Rating'
        },
        hAxis: {
            title: 'Objective and Rating'
        },
        explorer: {
            axis: 'horizontal',
            keepInBounds: true
        },
        seriesType: 'bars',
        bar: {
            groupWidth: 50
        },
        series: {
            3: {
            type: 'line'
            }
        }
        };

        var container = document.getElementById('chartipcrf_ave');
        var chart = new google.visualization.ComboChart(document.getElementById('chartipcrf_ave'));
        var btnSave = document.getElementById('save-pdf');

        google.visualization.events.addListener(chart, 'ready', function () {
        btnSave.disabled = false;
        });

        btnSave.addEventListener('click', function () {
        var doc = new jsPDF('l');
        doc.addImage(chart.getImageURI(), 0, 0);
        doc.save('chart.pdf');
        }, false);
        chart.draw(data, options);
      }
    </script>

    <!-- End of IPCRF Chart Function -->



<!-- IPCRF Average Chart Function -->

<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(chartIPCRF2);

  function chartIPCRF2() {
    // Some raw data (not necessarily accurate)
    var data = google.visualization.arrayToDataTable([
      ['obj_id', 'Quality', 'Efficiency', 'Timeliness','Average'],
      <?php
      //$tIndi = fetchTindicator($conn);
      //foreach ($tIndi as $indi) :
        $qry = $conn->query("SELECT obj_id,quality,efficiency,timeliness,average
        FROM ipcrf_t WHERE sy_id = '$sy_id' and school_id = '$school_id' group by obj_id order by obj_id,average") or die($conn->error);
        while ($cotQry = $qry->fetch_assoc()) :
          echo "['" . $cotQry['obj_id'] . "', 
                " . $cotQry['quality'] . ",  
                " . $cotQry['efficiency'] . ",   
                " . $cotQry['timeliness'] . ", 
                " . $cotQry['average'] . ", 
                ],";
        endwhile;
    //  endforeach; ?>
    ]);

    var options = {
      title: 'IPCRF Rating',
      vAxis: {
        title: 'Rating'
      },
      hAxis: {
        title: 'Objective and Rating'
      },
      explorer: {
        axis: 'horizontal',
        keepInBounds: true
      },
      seriesType: 'bars',
      bar: {
        groupWidth: 50
      },
      series: {
        3: {
          type: 'line'
        }
      }
    };

    var container = document.getElementById('chartIPCRF2');
    var chart = new google.visualization.ComboChart(document.getElementById('chartIPCRF2'));
    var btnSave = document.getElementById('save-pdf2');

    google.visualization.events.addListener(chart, 'ready', function () {
    btnSave.disabled = false;
    });

    btnSave.addEventListener('click', function () {
    var doc = new jsPDF('l');
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('chart.pdf');
    }, false);
    chart.draw(data, options);
  }
</script>
<!-- End of IPCRF Average Chart Function -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

<?php
endif;
endif;

include 'samplefooter.php';
?>