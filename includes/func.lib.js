function showAllPersonnel() {
    window.onload(console.log('hello'))
    let xhr = new XMLHttpRequest();
    xhr.load = function () {
        console.log('hello from func.lib.js');
        console.log(this.readyState);
        console.log(this.status);
        console.log(this.responseText);
    }

    xhr.open('GET', '../ajax/schoolPersonnel_ajax.php', true);
    xhr.send();
}