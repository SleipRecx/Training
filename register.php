<script>
    function validate() {
        var firstname = document.getElementById("firstname").value;
        var lastname = document.getElementById("lastname").value;
        var email = document.getElementById("email").value;
        var nickname = document.getElementById("displayname").value;
        var password = document.getElementById("registerpassword").value;
        var password2 = document.getElementById("registerpassword2").value;
        var strength = document.getElementsByClassName("password-verdict")[0].innerHTML;
        if(firstname!="" && lastname!="" && email!="" && nickname!="" && password!=""){
            if(strength=="Weak"){
                alert("Password strength has to be normal or better");
                return false;
            }
            if(password!=password2{
                return false;
            }
            return true;
        }

        return false;
    }
</script>


<br>
<h3>Register Below</h3>
<br>
<br>
<form class="form-horizontal" role="form" method="POST" action="newuser.php" onsubmit="return validate()">
    <div class="form-group">
        <label class="control-label col-sm-2" for="firstname">Name:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id ="firstname" name="firstname" placeholder="Enter first name">
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" id ="lastname" name="lastname" placeholder="Enter last name">
        </div>
    </div>
    <br>
    <div class="form-group">
        <label class="control-label col-sm-2" for="displayname">Nickname:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id ="displayname" name="displyname" placeholder="Enter display name">
        </div>
    </div>
    <br>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id ="email" name="email" placeholder="Enter email">
        </div>
    </div>

    <br>
    <div class="form-group">
        <label class="control-label col-sm-2" for="registerpassword">Password:</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="registerpassword" name="password" placeholder="Enter password" style="margin-bottom: 20px;">
        </div>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="registerpassword2" name="password" placeholder="Retype password">
        </div>
    </div>
    <br>
<center>
    <button name="register" type="submit" class="btn btn-info" style="margin-right: 45px;">Register</button>
    <button onclick="toggle_visibility('reg')" type="button" id="register" class="btn btn-warning">Cancel</button>
</center>
</form>
<br>
