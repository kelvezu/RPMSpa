<?php

namespace RPMSdb;

class RPMSdb
{
    public function totalAllTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }

    public function totalTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III") ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }

    public function totalMasterTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }
}
