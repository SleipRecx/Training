<div id="login">
        <h2>Welcome - Please sign in</h2>
        <br>
    <form class="form-horizontal" role="form" method="POST" action="index.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id ="email" name="email" placeholder="Enter email">
            </div>
        </div>
        <br>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id ="password" name="password" placeholder="Enter password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-0 col-sm-0">
                <div class="checkbox" style="display: ">
                    <label><input type="checkbox"> Remember me</label>
                </div>
            </div>
        </div>
        <br>
        <br>
            <button type="submit" name="submit" class="btn btn-success" style="margin-right: 20px;">Login</button>
            <button onclick="toggle_visibility('reg')" type="button" id="register" class="btn btn-info">Register</button>
    </form>
</div>