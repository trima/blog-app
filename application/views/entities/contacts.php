<div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a  href="#">News</a></li>
            <li role="presentation" class="active">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
				Profile
				  <span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li role="presentation"><a href="<?php echo site_url($username); ?>">View</a></li>
					<li role="presentation"><a href="<?php echo site_url('auth/logout'); ?>">Log Out</a></li>
				</ul>
			</li>
          </ul>
        </nav>
        <h3 class="text-muted">Ntics</h3>
        <hr>
</div>
