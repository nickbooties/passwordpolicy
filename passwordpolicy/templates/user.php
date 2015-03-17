<form id="password_policy" class="section">
	
	<h2><?php p($l->t('Password Policy')); ?></h2>
	
	<p>The following password restrictions are currently in place:</p>
	<p>All passwords are required to be at least <?php p($_['minlength']); ?> characters in length and;</p>
	
	<ul style="list-style: circle; margin-left: 20px;">
		
		<?php if(isset($_['mixedcase'])){
			?><li><?php
			p($_['mixedcase']);
			?></li><?php
		}?>
		<?php if(isset($_['numbers'])){
			?><li><?php
			p($_['numbers']);
			?></li><?php
		}?>
		<?php if(isset($_['specialcharslist'])){
			?><li><?php
			p($_['specialcharslist']);
			?></li><?php
		}?>
		
	</ul>

</form>