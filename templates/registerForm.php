<div class="page-header" style="border-bottom: 1px solid #C5C5C5">
    <h2>Register Below</h2>
</div>
<br>
<form class="form-horizontal" role="form" method="POST" data-toggle="validator"  action="templates/newuser.php" onsubmit="return validate()">
    <div class="form-group">
        <label class="control-label col-sm-2" for="firstname">Name:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id ="firstname" name="firstname" placeholder="Enter first name" required>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" id ="lastname" name="lastname" placeholder="Enter last name" required>
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
            <div class="input-group">
            <span class="input-group-addon" style="border-radius: 0px;" id="basic-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
            <input type="email" class="form-control" id ="email" name="email" placeholder="Enter email" required>
                </div>
        </div>
    </div>

    <br>
    <div class="form-group">
        <label class="control-label col-sm-2" for="registerpassword">Password:</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" data-minlength="6" id="registerpassword" name="password" placeholder="Enter password" style="margin-bottom: 20px;" required>

        </div>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="registerpassword2" data-match="#registerpassword" data-match-error="Whoops, these don't match" name="password" placeholder="Confirm password" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <br>
<center>
    <button name="submit" type="submit" class="btn btn-primary" style="margin-right: 45px;">Register</button>
    <button onclick="clearFields();toggle_visibility('reg');" type="button" id="register" class="btn btn-warning">Cancel</button>
</center>
</form>
<br>
