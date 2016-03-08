<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
<link rel="stylesheet" type="text/css" href="../css/mycss.css">
<title>Training</title>
<script>
    function logout(){
        window.location.href = 'logout.php'
    }

    $(document).ready(function () {
        $('#sidebar-btn').click(function(){
            $('#sidebar').toggleClass('visible');
        })
        $('#sidebar-btn').click(function(){
            $('.container').toggleClass('active-bar');
        })
    });
</script>