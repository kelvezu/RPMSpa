//sy.php js 
/*
function getDate(d){
    d.preventDefault();

    var sdate = document.getElementById('sdate').value;
    var edate = document.getElementById('edate').value;

    

    var params = `sdate=${sdate} edate=${edate}`;

    xhr = new XMLHttpRequest();
    xhr.open('POST','includes/importSy.inc.php',true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        console.log(this.responseText);
    }
    xhr.send(params);
}*/


/*
function getGradeLevel(){
    var gradelvl_select = document.getElementById("grade-lvl");
    var gradelvl_id = gradelvl_select.options[gradelvl_select.selectedIndex].value;
    return ("gradelvl_id="+gradelvl_id);
}
*/

/*
function getDept(){
    var dept = 
}
*/

/*
function loadText(){
    // create xhr object
    var xhr = new XMLHttpRequest();

    //open - type, url/file, async
    xhr.open('GET','dummy.txt',true);

    xhr.onload = function(){
        if(this.status == 200){
            document.getElementById('msg').innerHTML = this.responseText;  
        } else if(this.status == 404){
            document.getElementById('msg').innerHTML = "walang data";
        }
    }

    xhr.onerror = function(){
        console.log("Error Request");
    }
    //sends the request 
    xhr.send();   
}

function getName(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','/includes/xfunction.php?name=Mon',true);
    xhr.onload = function(){
        console.log(this.responseText);
    }
xhr.send(); 
}    */

/* failed
function postName(e){
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open('POST','xfunction.php',true);
    xhr.onload = function(){
        console.log(this.responseText);
    }

}

*/
/*
function postName(e){
    e.preventDefault();
    var ign = document.getElementById('ign').value;
    var name = document.getElementById('name').value;
    var params = "name= "+name+"ign= "+ign;

    var xhr = new XMLHttpRequest();
    xhr.open('POST','includes/xfunction.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        console.log(this.responseText);
    }
        xhr.send(params);
    }

    */
    //////////////////////////////////

    //AJAX TUT 1 - GET FILE - ajaxGetDataFile.html
    /*
    function loadText(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','sample.txt',true);
        xhr.onload = function(){
            if(this.status == 200){
                document.getElementById('msg').innerHTML = this.responseText;
            }
        }
        xhr.send();

    }
    */

    //AJAX TUT 2 - GET JSON FILE - ajaxGetDataFile.html

    function loadText(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','user.json');
        xhr.onload = function()
        {
                if(this.status == 200){
                    var user = JSON.parse(this.responseText);
                    //APPEND THE DATA
                    output = '';
                    output += `
                    id      :   ${user.id}<br/>
                    ign     :   ${user.ign}<br/>
                    name    :   ${user.name}<br/>`
                    document.getElementById('msg').innerHTML = output;
                }
        }
        xhr.send();
}

    function loadTexts(){
        console.log("God is good all the time ");
    }

    //////////////////////////////////

















    
