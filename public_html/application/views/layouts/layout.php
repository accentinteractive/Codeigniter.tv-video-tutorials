<!DOCTYPE html>
<?php $this->load->view('partials/page_head');?>
	<body>
	
	<div class="wrapper">
		<header>
			<div class="logo">Logo</div>
		</header>
<?php $this->load->view('partials/menu');?>

		<div id="content">

<?php $this->load->view('partials/' . $subview); ?>

		</div>
		<footer>&copy; 2012 Codeigniter.tv</footer>
	</div>

	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	</body>
</html>