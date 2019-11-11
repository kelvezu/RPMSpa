<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>

                        <?php
                        $selector = $_GET["selector"];
                        $validator = $_GET["validator"];

                        if (empty($selector) || empty($validator)) {
                            echo "Could not validate your request!";
                        } else {
                            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                                ?>

                                <form action="resetrequest.php" method="post">
                                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                    <input type="password" name="pwd" placeholder="Enter a new password..">
                                    <input type="password" name="pwd2" placeholder="Repeat new password..">
                                    <button type="submit" name="submit">Reset Password</button>
                                </form>


                        <?php
                            }
                        }



                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>