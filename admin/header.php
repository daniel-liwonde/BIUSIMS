<!DOCTYPE html>
<html lang="en">
    <head>

        <title>BIU SIMS</title>
        <link href="img/log.png" rel="icon" type="image">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/fontawesome/font/css/fontawesome.min.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
        <?php   include('connect.php'); ?>
        <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=500,width=1000');
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $("#btnPrint2").live("click", function () {
            var divContents = $("#dvContainer1").html();
            var printWindow = window.open('', '', 'height=500,width=1000');
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
 <script src="js/form.js" type="text/javascript"></script>
 <script src="js/form2.js" type="text/javascript"></script>
 <script src="js/timeout.js" type="text/javascript"></script>
    </head>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
   
	<script type="text/javascript" src="/js/jQuery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/js/jquery.ui/1.10.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/js/jquery-ui.css" type="text/css" />
    <style>
        
        .display{
            margin-top: -12px;
        }
      #semester,#state2,#state,#m,#x2,#x,#y,#sel{width:120px;}
      
    </style>
<script language="JavaScript">
function disable()
{
if(document.getElementById("y").checked)
{
document.getElementById("sel").style.visibility="visible";
document.getElementById("state").style.visibility="hidden";
document.getElementById("state2").style.visibility="hidden";
document.getElementById("semester").style.visibility="visible";
}
else
{
document.getElementById("sel").style.visibility="hidden";
document.getElementById("state").style.visibility="visible";
document.getElementById("state2").style.visibility="visible";
document.getElementById("semester").style.visibility="hidden";
}
}
</script>

    <script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
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
    $(document).on("click", ".result td", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
		  $(".result").empty();
		
    });
});
</script>
 