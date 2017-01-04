<div class="articlePreview">
	<div class="pagePreview">
		<h1><?php echo $lang['Contacts']; ?></h1>
		<?php
		echo $p->properties['body']; 
		$this->showView('contact_form');
		$this->showView('map');
		?>
	</div>
</div>