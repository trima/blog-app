<div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" ><a href="/">Home</a></li>
            <li role="presentation"><a href="<?php echo site_url('register'); ?>">Register</a></li>
            <li role="presentation" class="active"><a href="#">Log In</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Ntics</h3>
        <hr>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-6 col-md-offset-3 ">
<?php echo validation_errors(); ?>
<?php echo form_open('auth/login', 'class="form-signin" role="form"'); ?>
        <div class="page-header">
  			<h2>Please Log In</h2>
		</div>
         <div class="form-group">
    		<label for="exampleInputEmail1">Email address</label>
    		<input type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?php echo set_value('email'); ?>" placeholder="Email" required autofocus>
  		</div>
        
        <div class="form-group">
    		<label for="exampleInputPassword1">Password</label>
    		<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
  		</div>
        <!--
        <div class="checkbox">
        
         <label>
            <input type="checkbox" name="remember" value="remember-me" <?php echo set_checkbox('remember', 'remember-me'); ?>" /> Remember me
          </label>
        
        </div>
        -->
        <button type="submit" class="btn btn-default">Sign in</button>
</form>
</div>
</div>
</div>
