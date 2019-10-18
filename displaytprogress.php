<?php
include 'includes/header.php';
?>
<div class="dashone-adminprowrap shadow-reset mg-b-30">
    <div class="dash-adminpro-project-title">
        <h4 align="center"><b>Teacher Progress View</b></h4>

                <div class="sparkline9-graph">
                    <div class="static-table-list">
                        <div class= "pre-scrollable">
                    
                            <table class="table sparkle-table ">
                                
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>ESAT</th>
                                        <th>COT</th>
                                        <th>IPCRF</th>
                                        <th>DEVELOPMENT PLAN</th>
                                        
                                     
                                        
                                    </tr>
                                </thead>
                                <?php
                                if(isset($teacherMasterlist_results)):
                                    foreach($teacherMasterlist_results as $teacher):
                                        $teachername = $teacher['firstname'].' '.substr($teacher['middlename'],0,1).'. '.$teacher['surname'];
                                        ?>
                                <tbody>
                                    <tr>
                                        
                                        <td width="20%"><?php echo $teachername; ?></td>
                                        <td width="20%"><?php echo $teacher['position']; ?></td>
                                        <td width="20%"><div class="progress-bar progress-bar-success" 
                                                        role="progressbar" aria-valuenow="40" 
                                                                aria-valuemin="0" aria-valuemax="100" style="width:100%">100% Complete (success)</td>
                                        <td width="20%"><div class="progress-bar progress-bar-success" 
                                                        role="progressbar" aria-valuenow="40" 
                                                                aria-valuemin="0" aria-valuemax="100" style="width:100%">100% Complete (success)</td>
                                        <td width="25%"><div class="progress-bar progress-bar-success" 
                                                        role="progressbar" aria-valuenow="40" 
                                                                aria-valuemin="0" aria-valuemax="100" style="width:100%">100% Complete (success)</td>
                                        <td width="25%"><div class="progress-bar progress-bar-success" 
                                                        role="progressbar" aria-valuenow="40" 
                                                                aria-valuemin="0" aria-valuemax="100" style="width:200%">100% Complete (success)</td>                        

                                    </tr>
                                    <?php
                                    endforeach;
                                else:
                                    echo 'no record';

                                endif;
                            ?>
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    </div>
</div>
<?php include 'includes/footer.php'; ?>