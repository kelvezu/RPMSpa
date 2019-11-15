function confirmDelete()
{
  var msg = confirm('Are you sure you want to delete this record?');
  if(msg === true){
    window.location.href = "includes/processusers.php";
  }else{
   window.close();
  }
}

function load_cbc_data_t(tyear1, title)
{
    let temp_title = title + ' '+tyear1+'';
    $.ajax({
        url:"includes/processchartdata.php",
        method:"POST",
        data:{tyear1:tyear1},
        dataType:"JSON",
        success:function(data)
        {
            draw_cbc_chart_t(data, temp_title);
        }
    });
}

function draw_cbc_chart_t(chart_data, chart_main_title)
{
    let jsonData = chart_data;
    let data = new google.visualization.DataTable();
    data.addColumn('string', 'CBC Name');
    data.addColumn('number', 'CBC Score');
    $.each(jsonData, function(i, jsonData){
        let CBC_NAME = jsonData.CBC_NAME;
        let cbc_score =jsonData.cbc_score;
        data.addRows([[CBC_NAME,cbc_score]]);
    });
    let options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'CBC Name'
        }
    };

    let chart = new google.visualization.BarChart(document.getElementById('cbc_chart'));
    chart.draw(data, options);
}

    
$(document).ready(function(){

    $('#tyear1').change(function(){
        let tyear1 = $(this).val();
        if(tyear1 != '')
        {
          load_cbc_data_t(tyear1, 'Core Behavioral Competencies');
        }
    });

});


function load_ass_data_t(tyear2, title)
{
    let temp_title = title + ' '+tyear2+'';
    $.ajax({
        url:"includes/processchartdata.php",
        method:"POST",
        data:{tyear2:tyear2},
        dataType:"JSON",
        success:function(data)
        {
            draw_ass_chart_t(data, temp_title);
        }
    });
}

function draw_ass_chart_t(chart_data, chart_main_title)
{
    let jsonData = chart_data;
    let data = new google.visualization.DataTable();
    data.addColumn('string', 'Objectives');
    data.addColumn('number', 'Level of Capabilities');
    data.addColumn('number', 'Priorities Development');
    $.each(jsonData, function(i, jsonData){
        let OBJECTIVES = jsonData.OBJECTIVES;
        let lvlcap =jsonData.lvlcap;
        let priodev =jsonData.priodev;
        data.addRows([[OBJECTIVES,lvlcap,priodev]]);
    });
    let options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'Objectives'
        }
    };

    let chart = new google.visualization.BarChart(document.getElementById('ass_chart'));
    chart.draw(data, options);
}
    
$(document).ready(function(){

    $('#tyear2').change(function(){
        let tyear2 = $(this).val();
        if(tyear2 != '')
        {
          load_ass_data_t(tyear2, 'Assessment of Level of Capabilities and Priority Development');
        }
    });

});


function load_cbc_data_mt(mtyear1, title)
{
    var temp_title = title + ' '+mtyear1+'';
    $.ajax({
        url:"includes/processchartdata.php",
        method:"POST",
        data:{mtyear1:mtyear1},
        dataType:"JSON",
        success:function(data)
        {
            draw_cbc_chart_mt(data, temp_title);
        }
    });
}

function draw_cbc_chart_mt(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'CBC Name');
    data.addColumn('number', 'CBC Score');
    $.each(jsonData, function(i, jsonData){
        var CBC_NAME = jsonData.CBC_NAME;
        var cbc_score =jsonData.cbc_score;
        data.addRows([[CBC_NAME,cbc_score]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'CBC Name'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('cbc_chart'));
    chart.draw(data, options);
}


$(document).ready(function(){

    $('#mtyear1').change(function(){
        var mtyear1 = $(this).val();
        if(mtyear1!= '')
        {
          load_cbc_data_mt(mtyear1, 'Core Behavioral Competencies');
        }
    });

});

function load_ass_data_mt(mtyear2, title)
{
    var temp_title = title + ' '+mtyear2+'';
    $.ajax({
        url:"includes/processchartdata.php",
        method:"POST",
        data:{mtyear2:mtyear2},
        dataType:"JSON",
        success:function(data)
        {
            draw_ass_chart_mt(data, temp_title);
        }
    });
}

function draw_ass_chart_mt(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Objectives');
    data.addColumn('number', 'Level of Capabilities');
    data.addColumn('number', 'Priorities Development');
    $.each(jsonData, function(i, jsonData){
        var OBJECTIVES = jsonData.OBJECTIVES;
        var lvlcap =jsonData.lvlcap;
        var priodev =jsonData.priodev;
        data.addRows([[OBJECTIVES,lvlcap,priodev]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'Objectives'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('ass_chart'));
    chart.draw(data, options);
}


$(document).ready(function(){

    $('#mtyear2').change(function(){
        var mtyear2 = $(this).val();
        if(mtyear2 != '')
        {
          load_ass_data_mt(mtyear2, 'Core Behavioral Competencies');
        }
    });

});
function load_complete_esat_data(sy_esat, title)
{
    var temp_title = title + ' '+sy_esat+'';
    $.ajax({
        url:"includes/processchartdata.php",
        method:"POST",
        data:{sy_esat:sy_esat},
        dataType:"JSON",
        success:function(data)
        {
            draw_complete_esat_chart(data, temp_title);
        }
    });
}
function draw_complete_esat_chart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'school_name');
    data.addColumn('number', 'Percentage');
    $.each(jsonData, function(i, jsonData){
        var school_name = jsonData.school_name;
        var Percentage =parseFloat($.trim(jsonData.Percentage));
        data.addRows([[school_name,Percentage]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Percentage"
        },
        vAxis: {
            title: 'school_name'
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('esat_chart'));
    chart.draw(data, options);
}


$(document).ready(function(){

    $('#sy_esat').change(function(){
        var sy_esat = $(this).val();
        if(sy_esat != '')
        {
          load_complete_esat_data(sy_esat, 'ESAT');
        }
    });

});
