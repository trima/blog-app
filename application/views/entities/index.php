<div class="header clearfix">
          <ul class="nav justify-content-end">
            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('/'); ?>">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/login'); ?>">Log In</a></li>
          </ul>
        <h3 class="text-muted">Ntics</h3>
        <hr>
</div>

<div class="container-fluid">
<div class="col-md-8 col-md-offset-2 ">
<div class="jumbotron">
        <h2>Ntics, your posts in few clicks !</h2>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
      </div>
</div>
</div>

<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
  	tinymce.init({
    selector: '#myfirstpost'
  	});
</script>
