 // This will load the functions after the web finished loading
 window.addEventListener('DOMContentLoaded', (event) => {
     // let exec_time = setInterval(() => {
     //     fetchAnnouncement();
     // }, 3000);

     // setInterval(() => {
     //     clearInterval(exec_time);
     // }, 60000);

 });

 //  const annBtnShow = document.getElementById('ann-btnshow');
 const annBtnPost = document.getElementById('ann-btnpost');
 const showTcountBtn = document.getElementById('show-tcount-btn');
 const fetch_announce = document.getElementById('fetch-announcement');
 const announcement_form = document.getElementById('add_announcement_form');
 const teacherTable = document.getElementById('teacher_count_table');
 const teacherChart = document.getElementById('teacher_count_chart');
 const showNotif = document.getElementById('show-notif');

 announcement_form.addEventListener('submit', postAnn);
 if (showTcountBtn) {
     showTcountBtn.addEventListener('click', showTeacherCount);
 }
 document.getElementById('ann-btnshow').click(fetchAnnouncement());





 if (teacherTable) {
     teacherTable.style.display = "none";
 }

 if (teacherChart) {
     teacherChart.style.display = "block";
 }


 showNotif.style.display = "none";



 function showTeacherCount() {
     if (teacherTable.style.display === "none") {
         teacherChart.style.display = "none";
         teacherTable.style.display = "block";
         showTcountBtn.value = "Show Table"
     } else {
         teacherTable.style.display = "none";
         teacherChart.style.display = "block";
         showTcountBtn.value = "Show Chart"
     }
 }




 // ADD NEW ANNOUNCEMENT THRU AJAX 
 function postAnn(e) {
     e.preventDefault();
     let user_id = document.getElementById('user_id').value;
     let sy = document.getElementById('sy').value;
     let position = document.getElementById('position').value;
     let school = document.getElementById('school').value;
     let subject = document.getElementById('subject').value;
     let title = document.getElementById('title').value;
     let message = document.getElementById('message').value;

     let params = `user_id=${user_id}&sy=${sy}&position=${position}&school=${school}&subject=${subject}&title=${title}&message=${message}`;


     let xhr = new XMLHttpRequest();
     xhr.open('POST', 'includes/processannouncement.php', true);
     console.log(xhr.statusText);
     xhr.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');

     xhr.onload = function () {}
     try {
         xhr.send(params);
         showNotif.style.display = "block";
         showNotif.innerHTML = "New Announcement has been added!";
         setInterval(function () {
             showNotif.style.display = "none"
         }, 3000);
         document.getElementById('subject').value = '';
         document.getElementById('title').value = '';
         document.getElementById('message').value = '';
     } catch (error) {
         console.log(error)
     }

     setInt = setInterval(fetchAnnouncement(), 1000);
     clearInterval(setInt);

 }

 function fetchAnnouncement() {

     let xhr = new XMLHttpRequest();
     xhr.open('GET', './ajax/announcement_ajax.php');
     xhr.onload = function () {
         console.log('Fetch_Ann_status: ' + this.statusText);
         let results = this.responseText;
         if (results) {
             setTimeout(document.getElementById('fetch-announcement').innerHTML = results, 1000);
         } else {
             document.getElementById('fetch-announcement').innerHTML = 'No Result';
         }
     }
     xhr.send();
 }


 // THIS FUNCTION WILL SHOW ALL THE SCHOOL PERSONNEL 
 function showAllPersonnel() {
     let shr = new XMLHttpRequest();
     shr.open('GET', './ajax/schoolPersonnel_ajax.php');
     shr.onload = function () {

         console.log(this.statusText);
         if (this.responseText) {
             document.getElementById('sch_personnel').innerHTML = shr.responseText;
         } else {
             console.log('Error')
         }
     }
     shr.send();
 }

 //  THIS FUNCTION WILL SHOW ALL THE OPTIONS FOR POSITION


 function showOptionPosition() {
     let xml = new XMLHttpRequest();
     xml.open('GET', './ajax/selectPosition_ajax.php');
     xml.onload = function () {
         console.log(this.statusText);
         if (this.responseText) {
             console.log(this.responseText);
             document.getElementById('sel_pos').innerHTML = xml.responseText;
         } else {
             console.log('Error');
         }
     }
     xml.send();
 }

 function getTotalTeacher() {
     let xhr = new XMLHttpRequest();
     xhr.open('GET', './ajax/totalteacher_ajax.php');
     xhr.onload = () => {
         if (this.responseText) {
             console.log(this.responseText);
             let result_arr = [];
             return result_arr.push(this.responseText);
         } else {
             console.log('Error');
         }
     }
     xhr.send();
 }

 //  function showUser(str) {
 //      if (str == "") {
 //          document.getElementById("txtHint").innerHTML = "";
 //          return;
 //      } else {
 //          if (window.XMLHttpRequest) {
 //              // code for IE7+, Firefox, Chrome, Opera, Safari
 //              xmlhttp = new XMLHttpRequest();
 //          } else {
 //              // code for IE6, IE5
 //              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 //          }
 //          xmlhttp.onreadystatechange = function () {
 //              if (this.readyState == 4 && this.status == 200) {
 //                  document.getElementById("txtHint").innerHTML = this.responseText;
 //              }
 //          };
 //          xmlhttp.open("GET", "getuser.php?q=" + str, true);
 //          xmlhttp.send();
 //      }
 //  }

 //  fetchTotalTeacher();

 //  function fetchTotalTeacher() {
 //      const xhr = new XMLHttpRequest();
 //      xhr.open('GET', './ajax/totalteacher_ajax.php');
 //      console.log(xhr.statusText)
 //      xhr.onload = () => {
 //          result = this.responseText;
 //          if (result) {
 //              console.log(result);
 //          } else {
 //              console.log('Error in fetchtotalteacher');
 //          }
 //      }
 //      xhr.send();
 //  }