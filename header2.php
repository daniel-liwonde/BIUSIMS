<!DOCTYPE html>
<html lang="en">
    <head>

        <title>BIU SIMS</title>
        <link href="admin/img/log.png" rel="icon" type="image">
        <link href="admin/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link href="admin/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen">
        <link href="admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="admin/css/DT_bootstrap.css">
        <?php include('admin/connect.php'); ?>
    </head>
    <script src="admin/js/jquery.js" type="text/javascript"></script>
    <script src="admin/js/bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8" language="javascript" src="admin/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="admin/js/DT_bootstrap.js"></script>
    <script type='text/javascript' language='javascript' src='js/ndhui.js'></script>

     
<script type="text/javascript">
        // Set timeout variables.
        var timoutWarning = 60000; // Display warning in 1Mins.
        var timoutNow = 120000; // Timeout in 2 mins.
        var logoutUrl = 'logout.php'; // URL to logout page.

        var warningTimer;
        var timeoutTimer;

        // Start timers.
        function StartTimers() {
            warningTimer = setTimeout("IdleWarning()", timoutWarning);
            timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
        }

        // Reset timers.
        function ResetTimers() {
            clearTimeout(warningTimer);
            clearTimeout(timeoutTimer);
            StartTimers();
            $("#timeout").dialog('close');
        }

        // Show idle timeout warning dialog.
        function IdleWarning() {
            $("#timeout").dialog({
                modal: true
            });
        }

        // Logout the user.
        function IdleTimeout() {
            window.location = logoutUrl;
        }
    </script>

  