<?php
session_start();
include_once("../scripts/db_connection.php");
include_once("../scripts/login_required.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php") ?>
</head>
<body>
<script type="text/javascript" src="../js/materialize.js"></script>

<nav>
    <?php include("nav.php") ?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php") ?>
</div>
<script>

    var array =["lightseagreen","steelblue"];
    function getRandomColor(){
        var rand = Math.floor((Math.random() * array.length));
        return array[rand];
    }

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };

    function capitalize(object){
        window.setTimeout(function(){
            object.value = object.value.capitalize();
        },10);
    }


    function changeColors(){
        var array = document.getElementsByClassName("chill");
        var array2 = document.getElementsByClassName("exercise");
        var lastcolor = "red";
        for(var i = 0; i < array.length; i++){
            var color =  getRandomColor();
            while(lastcolor == color){
                color =  getRandomColor();
            }
            array[i].style.backgroundColor = color;
            array2[i].style.backgroundColor = color;
            lastcolor =  array[i].style.backgroundColor;
        }

    }

    function insert_new_sett(object){
        var parentDiv = object.parentNode;
        var parentDiv2 = parentDiv.parentNode;
        var child = parentDiv2.childNodes[0].firstChild;
        var value = "";
        var value2 ="";
        var value3 ="";
        if(child == undefined){
            value = parentDiv2.childNodes[1].firstChild.value;
            value2 =  parentDiv2.childNodes[2].firstChild.value;
            value3 =  parentDiv2.childNodes[3].firstChild.value;
        }
        else{
            value = parentDiv2.childNodes[0].firstChild.value;
            value2 =  parentDiv2.childNodes[1].firstChild.value;
            value3 =  parentDiv2.childNodes[2].firstChild.value;
        }

        var data1 = {
            resultid: value,
            reps: value2,
            kg: value3

        };
        $.ajax({
            type: 'POST',
            url: '../scripts/new_sett_in_session.php',
            data: data1,
            success: function(data){
                var table = parentDiv.parentNode.parentNode.parentNode.parentNode.firstChild.childNodes[1];
                if(table == undefined){
                    table = parentDiv.parentNode.parentNode.parentNode.parentNode.firstChild;
                    table.appendChild(document.createElement("tbody"));
                    table = table.childNodes[1];
                }
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = data1["reps"];
                var x = parseFloat(data1["kg"]);
                cell2.innerHTML = x.toFixed(2);
                if(parentDiv2.childNodes[1].firstChild.getAttribute("name")=="reps"){
                    parentDiv2.childNodes[1].firstChild.value="";
                    parentDiv2.childNodes[2].firstChild.value = "";
                    parentDiv2.childNodes[1].firstChild.focus();

                }
                else{
                    parentDiv2.childNodes[2].firstChild.value = "";
                    parentDiv2.childNodes[3].firstChild.value = "";
                    parentDiv2.childNodes[2].firstChild.focus();
                }


            },

            error: function (){
                alert("Something went wrong adding your sett");
            }
        })

    }

    function insert_new_exercise(object){
        var table = object.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        var data1 = {
            sessionid: object.parentNode.parentNode.firstChild.childNodes[0].value,
            exercise_name:  object.parentNode.parentNode.firstChild.childNodes[1].value
        };
        $.ajax({
            type: 'POST',
            url: '../scripts/new_exercise_in_session.php',
            data: data1,
            success: function(data){
                var number = table.getElementsByTagName("li").length - 1;
                table.insertBefore(document.createElement("li"), table.childNodes[number]);
                var li = table.childNodes[number];
                var div = document.createElement("div");
                div.className = "collapsible-header";
                div.style = "text-align: center";
                div.innerHTML = object.parentNode.parentNode.firstChild.childNodes[1].value;
                li.appendChild(div);
                var div2 = document.createElement("div");
                div2.className = "collapsible-body";
                div2.style = "display: none; background-color: white";
                div2.innerHTML = '<table class="table striped centered"><thead> <tr> <th style="font-weight: normal">Reps</th> ' +
                    '<th style="font-weight: normal">Weight (Kg)</th> </tr> </thead>' +
                    '</table> <table class="table centered">' +
                    '<tbody><tr style="background-color: white; height: 30%"> <td>' +
                    '<input type="hidden" name="resultid" value=""></td>' +
                    '<td><input class="form-control" placeholder="Repetitions" name="reps" type="text" style="text-align: center;"></td>' +
                    '<td><input class="form-control" placeholder="Weight" name="kg" type="text" style="text-align: center;"></td><td>' +
                    '<button name="add" onclick="insert_new_sett(this);" class="btn sett_submit" style="margin-left: 10px;">Add Sett</button>' +
                    '</td></tr> ' +
                    '</tbody>' +
                    '</table>';
                li.appendChild(div2);
                div2.lastChild.firstChild.firstChild.childNodes[1].firstChild.value = data;
                object.parentNode.parentNode.firstChild.lastChild.value="";

            },
            error: function (){
                alert("Something went wrong adding your sett");
            }
        });


    }


    window.onload = function(){
        $('.collapsible').collapsible({
            accordion : false
        });

        $('select').material_select();

        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: false
        });


        var form = $('#new_session_form');
        form.submit(function (ev) {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data){
                  location.reload();
                }
            });
            ev.preventDefault(); });

        changeColors();

    }
</script>


<div class="container active-bar">
    <div class="inner">
        <?php include("about_modal.php") ?>
        <div class="row">
            <table class="table table-centred" style="width: 70%; margin: 0 auto">
                <form class="form" role="form" id="new_session_form" data-toggle="validator" method="POST" action="../scripts/new_session.php" style="text-align: center">
                    <tr>
                        <td>
                            <div class="input-field col s12">
                                <input type="date" placeholder="Pick Session Date" class="form-control datepicker" name="date"  required>
                            </div>
                        </td>
                        <td>
                            <div class="input-field col s12">
                                <input type="text" class="form-control" placeholder="Enter Session Place" name="place" required>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="submit"  style="display: block;margin:auto;" class="btn btn-success">New Session</button>
                        </td>

                    </tr>
                </form>
            </table>
        </div>
        <br>

        <?php
        $sql= /** @lang mysql */
            "SELECT *, DATE_FORMAT(date,'%d-%m-%Y') AS niceDate,date
            FROM sessions
            WHERE personid_fk = $_SESSION[personid]
            ORDER BY date DESC
            LIMIT 10 ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc() ){
            $sessionid = $row["sessionid"];
            $sql2= /** @lang mysql */
                "SELECT DISTINCT exercise_name,exerciseid_fk,resultid
                FROM results
                JOIN exercise ON exerciseid_fk = exerciseid
                WHERE sessionid_fk = $row[sessionid]";

            $result2 = $conn->query($sql2);
            $exerciseid_fk = null;
            echo "<div class='chill' id='$row[date]' style='background-color:white; height: 50px; text-align: center'> <h5 style='color: white; padding-top: 10px;'>$row[place] - $row[niceDate]</h5></div>";
            echo "<ul class='collapsible' data-collapsible='accordion'>";
            while($row = $result2->fetch_assoc() ) {
                $sql3= /** @lang mysql */
                    "SELECT reps,kg,resultid FROM execution
                    JOIN results ON resultid_fk = resultid
                    JOIN exercise ON exerciseid_fk = exerciseid
                    WHERE exerciseid_fk = $row[exerciseid_fk]
                    AND sessionid_fk = $sessionid";
                echo "<li>";
                echo "<div class='collapsible-header' style='text-align: center'>$row[exercise_name]</div>";
                echo "<div class='collapsible-body' style='background-color: white'>";
                echo "<table class='table striped centered'>";
                echo '<thead><tr><th style="font-weight: normal">Reps</th><th style="font-weight: normal">Weight (Kg)</th></tr></thead>';


                $result3 = $conn->query($sql3);
                while($row2 = $result3->fetch_assoc() ) {
                    $resultid = $row2["resultid"];
                    echo "<tr>";
                    echo "<td>".$row2["reps"]."</td>";
                    echo "<td>".$row2["kg"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<table class='table centered'>";
                echo "<tr style='background-color: white; height: 30%'>";
                echo "<td><input type='hidden' name='resultid'  value=$row[resultid]></td>";
                echo '<td><input class="form-control"  placeholder="Repetitions" name="reps"  type="text" style="text-align: center;"></td>';
                echo '<td><input class="form-control"  placeholder="Weight"  name="kg"  type="text" style="text-align: center;"></td>';
                echo "<td> <button name='add' onclick='insert_new_sett(this);' class='btn sett_submit' style='margin-left: 10px;'>Add Sett</button></td>";
                echo "</tr>";
                echo "</table>";
                echo"</div>";
                echo"</li>";

            }

            echo "<li>";
            echo "<div class='collapsible-header' id='lastrow' style='text-align: center;margin-bottom: 80px;'>";
            echo "<table class='table centered'>";
            echo '<tr>';
            echo '<td style="padding-left: 50px;">';
            echo "<input type='hidden' name ='sessionid' value='$sessionid'>";
            echo '<input type="text" name="exercise_name" placeholder="Select Exercise" onkeypress="capitalize(this);" list="datalist1">';
            echo '</td>';
            echo '<td>';
            echo '<button name="add" onclick="insert_new_exercise(this);" style="display:block; margin:0 auto" type="submit" class="btn exercise" >Add Exercise</button>';
            echo '</td>';
            echo '</tr>';
            echo "</table>";
            echo "</div>";
            echo "</li>";
            echo "</ul>";
        }

        $sql4 = "select * from exercise order by exercise_name";
        $result4 = $conn->query($sql4);
        echo '<datalist id = "datalist1">';
        while ($row4 = $result4->fetch_assoc()) {
            echo '<option value="'.$row4["exercise_name"].'">'.'</option>';
        }
        echo '</datalist>';
        ?>

    </div>
</div>

</body>
</html>