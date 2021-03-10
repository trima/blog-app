<div class="container-fluid">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
		<span class="sr-only">50% Complete (success)</span>
	  </div>
</div>
<?php echo validation_errors(); ?>
<?php echo form_open('register/username', 'role="form"'); ?>
	<div class="page-header">
  		<h2>Choose your username</h2>
	</div>
	<div class="form-group">
		<label for="basic-url">Username</label>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon3">https://www.identica.com/</span>
		  <input type="text" class="form-control" name="username" id="basic-url" aria-describedby="basic-addon3" value="<?php echo set_value('username'); ?>" required>
		</div>
		<p class="help-block">Available usernames : <?php echo $propositions ?></p>
	</div>
<button type="submit" class="btn btn-default">Next</button>
</form>
</div>
</div>
</div>



