


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
                <li><a href="#"><span class="fa fa-lock" aria-hidden="true" data-toggle="modal" data-target="#myModal"></span> Password </a></li>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change Password</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="control-group">
                                        <label for="current_password" class="control-label">Current Password</label>
                                        <div class="controls">
                                             <input type="password" name="current_password">
                                        </div>
                                    </div>
                                    <div class="control-group" style=>
                                         <label for="new_password" class="control-label">New Password</label>
                                        <div class="controls">
                                             <input type="password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="confirm_password" class="control-label">Confirm Password</label>
                                        <div class="controls">
                                            <input type="password" name="confirm_password">
                                        </div>
                                    </div>      
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <li><a href="<?php echo ROOT_URL; ?>index.php?content=users&action=logout"><span class="fa fa-times" aria-hidden="true"> </span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
        </script>
