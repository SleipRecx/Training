<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">

<script type="text/javascript" src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>



<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/mycss.css">
<title>Training</title>
<script>

    $(document).ready(function () {
        $('#sidebar-btn').click(function(){
            $('#sidebar').toggleClass('visible');
        })

        $('#sidebar-btn').click(function(){
            $('.container').toggleClass('active-bar');
        })
    });

    $(document).ready(function(){
        $('#myTable').DataTable();
    });


    function adjustSidebarHeight(){
        $height =  $(".container").height();
        $("#sidebar").css("height", $height+75);
    }

    $(document).ready(function(){
       adjustSidebarHeight();
    });

    $(document).ready(function(){
      init();
    });

    function logout(){
        window.location.href = 'logout.php'
    }


    function init(){
        var select = document.getElementsByName("myTable_length")[0];
        select.setAttribute("onchange", "adjustSidebarHeight()");
        var search = document.getElementById("myTable_filter");
        var s2 = search.getElementsByTagName("input")[0];
        s2.setAttribute("oninput", "adjustSidebarHeight()");
    }

</script>