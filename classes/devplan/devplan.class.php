<?php

namespace DevPlan;

class DevPlan
{
    // public static function devplanStatus($position)
    // {
    //     if (isset($position)) :
    //         if (!stripos(($position), 'dmin') || !stripos(($position), 'rincipal') || !stripos(($position), 'chool head') || !stripos(($position), 'chool head') || !stripos(($position), 'uperintendent')) :
    //             if():
    //             endif;
    //         else: return false;
    //         endif;
    //     else :
    //         return false;
    //     endif;
    // }

    /* STRENGTH IN DEVPLAN FOR MT */
    public static function showStrDevplan($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE sy = ' . $_SESSION["active_sy_id"] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivesmt_tbl.status = "Active" AND esat2_objectivesmt_tbl.lvlcap >= 3  AND esat2_objectivesmt_tbl.priodev < 3 GROUP by esat2_objectivesmt_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }



    public static function showPrioDevplan($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE sy = ' . $_SESSION["active_sy_id"] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivesmt_tbl.status = "Active" AND esat2_objectivesmt_tbl.lvlcap < 3 AND esat2_objectivesmt_tbl.priodev >= 3 GROUP by esat2_objectivesmt_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 2';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showStrIndicator($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores, esat3_core_behavioral_tbl.* FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioral_tbl.status = "Active" AND  position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioral_tbl.cbc_score) >= 3 ORDER BY CBC_SCORES DESC LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevNeedsIndicator($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores, esat3_core_behavioral_tbl.* FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioral_tbl.status = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioral_tbl.cbc_score) ORDER BY CBC_SCORES  LIMIT 2';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }
}
