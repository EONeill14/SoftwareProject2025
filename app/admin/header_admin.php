<?php ?>
<html>
    <head>
        <title>Header admin</title>

        <script src="<?php echo $app_path ?>jquery-3.3.3.min.js"></script>
        <script>$(document).ready(function () {
                $("#num_rows").change(function () {
                    $("#pagination_form").submit();
                });
            });
        </script>

    </head>
    <?php require_once('../view/navbar_admin.php'); ?>
    <body>

    </body>
</html>
