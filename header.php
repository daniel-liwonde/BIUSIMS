<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BIU SIM</title>
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
        //function IdleWarning() {
            //$("#timeout").dialog({
              //  modal: true
           // });
       // }

        // Logout the user.
        function IdleTimeout() {
            window.location = logoutUrl;
        }
    </script>

   
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search1.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result td", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
		$(".result").empty();
		
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-boxs input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".results");
        if(inputVal.length){
            $.get("search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".results td", function(){
        $(this).parents(".search-boxs").find('input[type="text"]').val($(this).text());
        $(this).parent(".results").empty();
		$(".result").empty();
		
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.search-box2 input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result2");
        if(inputVal.length){
            $.get("searchs.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
			
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result2 td", function(){
        $(this).parents(".search-box2").find('input[type="text"]').val($(this).text());
        $(this).parent(".result2").empty();
		  $(".result2").empty();
		
    });
});
</script>
 <script type="text/javascript">
$(document).ready(function(){
    $('.search-box3 input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result3");
        if(inputVal.length){
            $.get("searchs3.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
			
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result3 td", function(){
        $(this).parents(".search-box3").find('input[type="text"]').val($(this).text());
		  $(".result3").empty();
		
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-student input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var subid= document.getElementById("sid").value;
        var resultDropdown = $(this).siblings(".students");
        if(inputVal.length){
            $.get("addstudent.php", {term: inputVal,sid: subid}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
            
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".students td", function(){
        //$(this).parents(".search-box3").find('input[type="text"]').val($(this).text());
          $("#msg").innerHTML="Please wait..."
        
    });
});
</script>
