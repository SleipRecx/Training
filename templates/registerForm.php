<br>
<h3>Register Below</h3>
<br>
<br>
<form class="form-horizontal" role="form" method="POST" action="templates/newuser.php" onsubmit="return validate()">
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
