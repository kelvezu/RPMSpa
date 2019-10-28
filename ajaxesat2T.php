

<?php

$cap = $_GET["cap"]; 


if($cap == 4){

    echo "<select name='priodev[]' class='form-control bg-danger text-white font-weight-bold'>";
    echo  "<option value=''>--Select--</option>";
    echo  "<option value= 4 disabled>Very High</option>";
    echo  " <option value=3>High</option>";
    echo  " <option value=2>Moderate</option>";
    echo  " <option value=1>Low</option>";
    echo  "</select>";

}elseif($cap == 3){

    echo "<select name='priodev[]' class='form-control bg-danger text-white font-weight-bold'>";
    echo  "<option value=''>--Select--</option>";
    echo  "<option value= 4 >Very High</option>";
    echo  " <option value=3 disabled>High</option>";
    echo  " <option value=2>Moderate</option>";
    echo  " <option value=1>Low</option>";
    echo  "</select>";

}elseif($cap == 2){

    echo "<select name='priodev[]' class='form-control bg-danger text-white font-weight-bold'>";
    echo  "<option value=''>--Select--</option>";
    echo  "<option value= 4 >Very High</option>";
    echo  " <option value=3 >High</option>";
    echo  " <option value=2 disabled>Moderate</option>";
    echo  " <option value=1>Low</option>";
    echo  "</select>";

}elseif($cap == 1){

    echo "<select name='priodev[]' class='form-control bg-danger text-white font-weight-bold'>";
    echo  "<option value=''>--Select--</option>";
    echo  "<option value= 4 >Very High</option>";
    echo  " <option value=3 >High</option>";
    echo  " <option value=2 >Moderate</option>";
    echo  " <option value=1 disabled>Low</option>";
    echo  "</select>";
}else{
    echo "Error!";
}

?>
