let showNotif = document.getElementById('show-notif').style.display = "none";
document.getElementById('add_announcement_form').addEventListener('submit', postAnn);

function sendNotif() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/login.inc.php', true);
    xhr.onload = function () {};
}

function postAnn(e) {
    e.preventDefault();
    let user_id = document.getElementById('user_id').value;
    let sy = document.getElementById('sy').value;
    let position = document.getElementById('position').value;
    let school = document.getElementById('school').value;
    let subject = document.getElementById('subject').value;
    let title = document.getElementById('title').value;
    let message = document.getElementById('message').value;

    // let params = `user_id=${user_id}&sy=${sy}&position=${position}&school=${school}&subject=${subject}&title=${title}&message=${message}`;
    let params = 'user_id=' + user_id + '&sy=' + sy + '&position=' + position + '&school=' + school + '&subject=' + subject + '&title=' + title + '&message=' + message;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/processannouncement.php', true);
    console.log(xhr.statusText);
    xhr.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log(this.responseText);
    }

    xhr.send(params);
    document.getElementById('show-notif').style.display = "block";
    document.getElementById('show-notif').innerHTML = "New Announcement has been added!";
    document.getElementById('subject').value = '';
    document.getElementById('title').value = '';
    document.getElementById('message').value = '';


}