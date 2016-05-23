
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content" style="top: 60px;">

    <li><a class="tooltipped" data-position="left"  onclick="logout()" data-delay="20" data-tooltip="Goodbye">Logout</a></li>
</ul>
<div class="navbar-fixed">

<nav>
    <div class="nav-wrapper">
        <div id="sidebar-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="#" class="brand-logo" style="font-size: 1.5em;">Logo</a>
        <ul class="right hide-on-med-and-down">
           <li><a class="waves-effect waves-dark modal-trigger" href="#modal1">About</a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-button" href="#" data-activates="dropdown1"> <?php echo $_SESSION["name"]; ?> <i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>
</div>
<script>
    $(".dropdown-button").dropdown({inDuration: 300, outDuration: 425, hover: true, belowOrigin: true, constrain_width: true, alignment: 'right' });
    $('.modal-trigger').leanModal({
            dismissible: true, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            in_duration: 300, // Transition in duration
            out_duration: 200, // Transition out duration

        }
    );

</script>

<!-- Modal Trigger -->

