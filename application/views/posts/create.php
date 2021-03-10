<div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
	        <li role="presentation" class="active"><a  href="<?php echo site_url('news/create'); ?>">create</a></li>
            <li role="presentation" ><a  href="<?php echo site_url('news'); ?>">Posts</a></li>
            <li role="presentation"><a href="<?php echo site_url($username); ?>">View</a></li>
			<li role="presentation"><a href="<?php echo site_url('auth/logout'); ?>">Log Out</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Ntics</h3>
        <hr>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2 ">
<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>
	<div class="page-header">
  			<h2><?php echo $title; ?></h2>
	</div>
	
	<div class="form-group">
    		<label for="title">Title</label>
    		<input type="input" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>" placeholder="Title" required autofocus>
  		</div>

	    
	
    
	
	<div class="form-group">
	<label for="text">Text</label>	
<textarea class="form-control" name="text" id="textarea" placeholder="What's on your mind ?"  rows="10"><?php echo set_value('text'); ?></textarea>
	</div>

	<button type="submit" name="submit" class="btn btn-default">Publish</button>

</form>
</div>
</div>
</div>

<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
  	tinymce.init({
    selector: '#textarea'
  	});
</script>
