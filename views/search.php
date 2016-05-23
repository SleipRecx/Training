<?php
session_start();
include_once("../scripts/db_connection.php");
include("../scripts/login_required.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php")?>
</head>
<body>

<link rel="stylesheet" href="../css/material-table.css" property="stylesheet">
<script type="text/javascript" src="../js/datatables_min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>


<div class="container active-bar">
    <div class="inner">
        <script>
            function hello() {
                alert(this.text());
            }

                function searchq(){
                    window.setTimeout(function(){
                        var searchText = $("input[name='search']").val();
                        $('#output ul').empty();
                        $.post("../scripts/live_search.php", {searchVal: searchText},function(output){
                            var array = output.split(",");
                            for (i = 0; i < array.length; i++) {
                                $("#output ul").append("<li>"+array[i]+"</li>","");
                            }
                        });
                    },20);

            };
        </script>
        
           <input type="text" name="search" list="datalist1" id="search" onkeydown="searchq();">


        <div id ="output">
            <ul>
            </ul>
        </div>





    </div>
</body>
</html>