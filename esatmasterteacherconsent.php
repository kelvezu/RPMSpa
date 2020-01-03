
<?php

include 'sampleheader.php';

if(isset($_GET['notif'])):
    if($_GET['notif'] == 'esatdeleted'):
        echo "<div class='red-notif-border'>You have cancelled your esat!</div>";
    endif;
endif;
?>

<div class="container">

<div class="card">

<div class="card-header text-center">
 <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>

 <h4>RESULT-BASED PERFORMANCE MANAGEMENT SYSTEM (RPMS) FOR TEACHERS</h4>
</div>
<div class="bg-info text-center h5 text-white">
SELF-ASSESSMENT TOOL FOR MASTER TEACHER I-IV (Highly Proficient Teachers) for S.Y. 2019-2020
</div>

<div class="card-body h6">
The passage of the K to 12 Law(R.A. 10533) in May 2013 as a response to the changes and challenges of the modern world has changed the landscape of teacher quality requirements in the Philippines. The current reform calls for teachers to critically reflect on their roles and the expectations of them in the context of K to 12 Education.
<br>
<br>
This tool is designed for you to reflect on the different objectives related to your professional work. It consist of 13 elements that you will analyze and rate according to your level of capability and level of priority for development. The items meet teacher quality requirements congruent with the Philippine K to 12 Reform and reflective of international teacher standards.
<br>
<br>
You should accomplish this tool prior to the beginning of the school year and use to reflect on your performance throughout the RPMS cycle. The result of your self-assessment will guide you on which RPMS objectives to improve and on what areas you need coaching and mentoring.
<br>
<br>
Other school personnel, including the School Head, are not allowed to see the results of this tool. However, you can discuss with them your IPCRF-Development Plan(IPCRF-DP) based on your self-assessment.
<br>
<br>
<div class="h6 bg-info text-center text-white">
PLEASE READ THE INSTRUCTIONS
</div>

This tool has three parts:Part I: Demographic Profile; Part II: Objectives; and Part III: Core Behavioral Competencies.
<br>
<br>
For Part I: Demographic Profile, please shade the circle of the demographic information applicable to you.
<br>
<br>
For Part II: Objectives, please shade the circle that corresponds to how you rate the objectives based on: (1) level of capability and (2) level of priority for development. At the bottom of each page, there is the opportunity to write about any aspects that you feel are relevant to the objectives on that page.
<br>
<br>
For Part III: Core Behavioral Competencies, please shade the circle of the behavioral indicators that you demonstrated during the performance cycle.
<br>
<br>
<center>
<a href="dbMasterTeacher.php" class="btn btn-outline-danger"> Cancel</a>
<a href="ESATform1.php" class="btn btn-outline-info">Start</a>
</center>

</div>


</div>


</div>





<?php

include 'samplefooter.php';

?>