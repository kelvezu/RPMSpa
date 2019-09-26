$(".input").on('input', function(){

    var x =document.getElementById('num1').value;
    x = parseFloat(x);

    var y =document.getElementById('num2').value;
    y = parseFloat(y);

    var z =document.getElementById('num3').value;
    z = parseFloat(z);

    var average = (x + y + z)/3;
    var finalscore = average * 0.075;

    document.getElementById('ave').value = average ;
    document.getElementById('score').value = finalscore ;


})


