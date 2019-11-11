// This will load the functions after the web finished loading
window.addEventListener('DOMContentLoaded', (event) => {
    // let exec_time = setInterval(() => {
    //     fetchAnnouncement();
    // }, 3000);

    // setInterval(() => {
    //     clearInterval(exec_time);
    // }, 60000);
});
// Variable Declaration

/* Announcement Update Butoon*/
// const updateNotifAnn = document.getElementById('update_notif_ann');
// const updateFormAnn = document.getElementById('update_form_ann');
const annBtnShow = document.getElementById('ann-btnshow');
const annBtnPost = document.getElementById('ann-btnpost');
// const updateAnnBtn = document.getElementById('update-btn-ann');

/* ----------------------------------------------------  */

// const annBtnUpdate = document.getElementById('ann-btnupdate');

let showNotif = document.getElementById('show-notif');
let fetch_announce = document.getElementById('fetch-announcement');
let announcement_form = document.getElementById('add_announcement_form');


// Event Listener

// updateAnnBtn.addEventListener('click',updateAnnouncement);
// updateNotifAnn.style.display = "none";

    showNotif.style.display = "none";


    announcement_form.addEventListener('submit', postAnn);

    annBtnShow.click(fetchAnnouncement());













// Functions

function sendNotif() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/login.inc.php', true);
    xhr.onload = function () {};
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

    xhr.onload = function () {
    }
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
    xhr.open('GET', 'ajax/announcement_ajax.php');
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
// UPDATE ANNOUNCEMENT

// function updateAnnouncement(e){

//     e.preventDefault();
//     let id = document.getElementById('ann_id').value;
//     let subject = document.getElementById('subject').value;
//     let title = document.getElementById('title').value;
//     let message = document.getElementById('message').value;
//     let params = `ann_id=${id}&subject=${subject}&title=${title}&message=${message}`;

//     const xhr = new XMLHttpRequest();
//     xhr.open('POST','../includes/processannouncement.php',true);
//     xhr.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
//     xhr.onload = function(){
//         console.log(this.statusText);
//         console.log(this.responseText);
//     }
//     xhr.send(params);
// }




// function updateAnnouncement() {


// }