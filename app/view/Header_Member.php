<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

echo "members section";
?>

<html>
    <head>
        <title>Header for Members</title>
    </head>
    <body>

        <?php
        $member_url = $app_path . 'member';
        $logout_url = $member_url . '?action=logout';
        if (isset($_SESSION['user'])):
            ?>

            <div class = "row mr-0 mt-2 mb-n2">
                <div class ="col-md-12">
                    <div id ="headlinks">
                        <p>
                            <span class ="fa fa-user"></span><b><?php echo 'Hi,' . $_SESSION['user'][1] . '' . $_SESSION['user'][2] . '|'; ?></b>
                            &nbsp&nbsp<a href="<?php echo $logout_url; ?>"><span class="fa fa-sign-out">Logout</a>
                        </p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class ="row mr-0 mt- n2 mb-n2">
                <div class="col-md-12">
                    <div id ="headlinks">
                        <p>
                            <a href="<?php echo $member_url; ?>"><span class="fa fa-sgin in"></span>Login/register></a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </body>
</html>
