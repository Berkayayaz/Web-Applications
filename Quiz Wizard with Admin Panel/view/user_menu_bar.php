<?php 
    $user_name = isset($_SESSION['user_name']) ? 
            '['.$_SESSION['user_name'].']' : '';
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" data-target="#navbar" 
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Ginger Quiz <?php echo $user_name; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../quiz">Home</a></li>
                <li><a href="../login/profile.php">Profile</a></li>
                <li><a href="../login/logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
</nav>

