<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>   
            <a class="navbar-brand" href="<?php echo LOCALE_URL; ?>">Mystoria</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=reservations">Reservations</a></li><li><a href="<?php echo ROOT_URL; ?>index.php?content=articles">Articles</a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=pages">Pages</a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=settings">Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="fa fa-lock" aria-hidden="true"></span> Password </a></li>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=users&action=logout"><span class="fa fa-times" aria-hidden="true"> </span> </a></li>
            </ul>
        </div>
    </div>
</nav>
