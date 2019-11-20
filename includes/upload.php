<?php

if(isset($_POST['submit'])):
    $file = $_FILES['file'];

    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf','pptx','docx','xlsx','csv');

    if (in_array($fileActualExt, $allowed)):
        if($fileError === 0):
            if($filesize < 100000):
                $filenameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../attachments/' . $filenameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                header("Location:../attachfile.php?=success");
            else:
                echo "Your file is too big!";
            endif;
        else:
            echo "There was an error uploading your file!";
        endif;
    else:
        echo "You cannot upload file of this type!";
    endif;

endif;


?>