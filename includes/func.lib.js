window.addEventListener('DOMContentLoaded', (event) => {
    let exec_time = setInterval(() => {
        fetchAnnouncement();
    }, 3000);

    setInterval(() => {
        clearInterval(exec_time);
    }, 60000);
});

let showNotif = document.getElementById('show-notif');
let fetch_announce = document.getElementById('fetch-announcement');

let announcement_form = document.getElementById('add_announcement_form');
showNotif.style.display = "none";
announcement_form.addEventListener('submit', postAnn);

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
        console.log(this.responseText);
    }
    try {
        xhr.send(params);
        showNotif.style.display = "block";
        showNotif.innerHTML = "New Announcement has been added!";

        setInterval(() => {
            showNotif.style.display = "none";
        }, 3000);
        document.getElementById('subject').value = '';
        document.getElementById('title').value = '';
        document.getElementById('message').value = '';
    } catch (error) {
        console.log(error)
    }

}

function fetchAnnouncement() {

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax/announcement_ajax.php', true);
    xhr.onload = function () {
        console.log(this.status);
        let results = JSON.parse(this.responseText);
        let output = '';

        try {
            if (results) {
                results.forEach(function (result) {
                    output +=
                        `<div class="card">
                         <div class="card-header">
                         <div class="d-flex flex-row bd-highlight">
                            <div class="p-2 bd-highlight"><p><b>Subject: </b> ${result.subject}</p></div>
                            <div class="p-2 bd-highlight"><p><b>Title: </b>${result.title}</p></div>
                            
                        </div>
                       </div>
                         <div class="card-body">${result.message}</div>
                         <div class="card-footer"><p><b>Date Posted:</b> ${new Date(result.datetime_stamp)}</p></div>
                         </div>'<br/>`
                });


                document.getElementById('fetch-announcement').innerHTML = output;
            } else {
                document.getElementById('fetch-announcement').innerHTML = 'No Result';
            }

        } catch (error) {
            console.log(error)
        }



    }
    xhr.send();
}