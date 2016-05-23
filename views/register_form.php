<div style="border-bottom: 1px solid #b3b3b3; text-align: center">
    <h3 style="color: #5D5D5D;">Register Below</h3>
</div>
<br>
<div class="row" style="margin-right: 5%; margin-left: 5%">
    <form class="col s12"  id="registerForm" method="POST" action="templates/newuser.php" >
        <div class="row">
            <div class="input-field col s6">
                <input id="firstname"  name="firstname"  type="text" class="validate" required>
                <label for="firstname" >First Name</label>
            </div>

            <div class="input-field col s6">
                <input id="lastname" name="lastname" type="text" class="validate" required>
                <label for="lastname">Last Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="nickname" name="nickname" type="text" class="validate">
                <label for="nickname">Nickname</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="email" name="email" type="email" class="validate" required>
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="password" name="password" type="password" class="validate" required>
                <label for="password">Password</label>
            </div>
            <div class="input-field col s6">
                <input id="confirmpassword" name="confirmpassword" type="password" class="validate" required>
                <label for="confirmpassword">Confirm Password</label>
            </div>
        </div>
    <div class="row">
        <div class="input-field col s6">
            <button class="btn light-blue darken-2 waves-effect waves-light" style="float: right;margin-right: 10px;" type="submit" name="action">
                Register
            </button>
        </div>
        <div class="input-field col s6">
            <button onclick="showLogin()" style="float:left;margin-left: 10px;" type="button" id="cancel" class="btn waves-effect waves-dark yellow darken-3">Cancel</button>
        </div>
    </div>
    </form>
    <script>
        $(document).ready(function(){
            $("#registerForm").validate({
                rules: {
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email:true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirmpassword: {
                        required: true,
                        equalTo: "#password"
                    }

                },
                messages: {
                    email:{
                        email:"Enter a valid email adress"
                    },
                    firstname:{
                        required: "Enter desired first name"
                    },
                    lastname: {
                        required: "Enter desired last name"
                    },
                    password: {
                        required: "Enter desired password"

                    },
                    confirmpassword:{
                        equalTo: "Password don't match"
                    }

                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

        });
    </script>
</div>