<?php

namespace DbClass;

class DbClass
{

    private function conn()
    {
        $conn = mysqli_connect("localhost", "root", "", "rpms");

        if (!$conn) {
            die($conn->error);
        } else {
            return $conn;
        }
    }
}
