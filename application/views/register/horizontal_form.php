<div class="container">
<?php echo validation_errors(); ?>
<?php echo form_open('register/process', 'role="form"'); ?>
<h2>Register new Account</h2>
   <div class="form-group">
    <label for="inputEmail3" class="control-label">Email</label>
    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
  </div>
  <div class="form-group row">
    <div class ="col-sm-6">
    	<label for="inputPassword3" class="control-label">Password</label>
		<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
    
    <div class ="col-sm-6">
    	<label for="inputPassword3" class="control-label">Confirm</label>
		<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-default">Register</button>
  </div>
</form>

</div>

