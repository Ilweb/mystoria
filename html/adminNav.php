<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Mystoria</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?content=articles">Reservation</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Articles <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="index.php?content=articles&action=edit&id=<?php echo $article->id; ?>" ><?php echo $lang['Edit']; ?></a></li>
      <li><a  href="index.php?content=articles&action=edit"><?php echo $lang['New article']; ?></a></li>
    </ul>
      <li><a href="index.php?content=pages">Page </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="fa fa-lock" aria-hidden="true"></span> </a></li>
      <li><a href="#"><span class="fa fa-times" aria-hidden="true"> </span> </a></li>
    </ul>
  </div>
</nav>
