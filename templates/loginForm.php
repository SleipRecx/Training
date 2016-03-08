<div style="border-bottom: 1px solid #b3b3b3; text-align: center">
    <h3 style="color: #5D5D5D;">Sign in or Register</h3>
</div>
<br>
<br>
<div class="row" style="margin-right: 10%; margin-left: 10%">
    <form class="col s12" method="POST" id="loginForm" action="templates/login.php"">
    <div class="row">
        <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="email2" type="email" name = "email" class="validate" required>
            <label for="email" class="active">Email</label>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password" type="password" name = "password" class="validate" required>
                <label for="password" class="active">Password</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0px">
            <div class="input-field col s6">
                <button type="submit" name="submit" class="btn waves-effect waves-dark" style="float: right; margin-right: 10px;">Login</button>
            </div>
            <div class="input-field col s6">
                <button onclick="showRegister()" type="button" style="float: left; margin-left: 10px" id="register" class="btn waves-effect waves-dark blue darken-1">Register</button>
            </div>
        </div>
    </form>
</div>
</div>
