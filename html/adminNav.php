<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo LOCALE_URL; ?>">Mystoria</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?php echo ROOT_URL; ?>index.php?content=reservations">Reservations</a></li>      
      <li><a href="<?php echo ROOT_URL; ?>index.php?content=articles">Articles</a></li>
      <li><a href="<?php echo ROOT_URL; ?>index.php?content=pages">Pages</a></li>
	  <li><a href="<?php echo ROOT_URL; ?>index.php?content=settings">Settings</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="fa fa-lock" aria-hidden="true"></span> </a></li>
      <li><a href="<?php echo ROOT_URL; ?>index.php?content=users&action=logout"><span class="fa fa-times" aria-hidden="true"> </span> </a></li>
    </ul>
  </div>
</nav>
