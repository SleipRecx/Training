<div class="page-header" style="border-bottom: 1px solid #C5C5C5">
    <h2>Welcome - Please sign in</h2>
</div>
<br>
    <form class="form-horizontal" role="form"  data-toggle="validator" method="POST" action="index.php">

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-8">
                <div class="input-group">
                <span class="input-group-addon" style="border-radius: 0px;" id="basic-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                <input type="email" class="form-control" id ="email" name="email" placeholder="Enter email" data-error="Brusjan that's not a valid email"  required>
                    </div>
                <div class="help-block with-errors">
                    <ul class="list-unstyled"><li style="opacity: 0;">Brusjan that's not a valid email</li></ul>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label style="display: inline-block" class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon" style="border-radius: 0px;" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id ="password" name="password" placeholder="Enter password" required>
                    </div>
            </div>
        </div>
        <br>
        <br>
        <br>
            <button type="submit" name="submit" class="btn btn-success" style="margin-right: 20px;">Login</button>
            <button onclick="toggle_visibility('reg');" type="button" id="register" class="btn btn-primary">Register</button>
    </form>
