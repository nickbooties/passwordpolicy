<form id="password_policy" class="section">
	
	<h2><?php p($l->t('Password Policy')); ?></h2>
	
	<p><?php p($l->t('The following password restrictions are currently in place:')); ?></p>
	<p><?php p($l->t('All passwords are required to be at least %s characters in length and;', [ $_['minlength']])); ?></p>
	
	<ul style="list-style: circle; margin-left: 20px;">
		
		<?php if(isset($_['mixedcase']) && $_['mixedcase'] === "true"){
			?><li><?php
			p($l->t('Must contain UPPER and lower case characters.'));
			?></li><?php
		}?>
		<?php if(isset($_['numbers']) && $_['numbers'] === "true"){
			?><li><?php
			p($l->t('Must contain numbers.'));
			?></li><?php
		}?>
		<?php if(isset($_['specialchars']) && $_['specialchars'] === "true"){
			?><li><?php
			p($l->t('Must contain special characters: %s', [ $_['specialcharslist'] ]));
			?></li><?php
		}?>
		
	</ul>

</form>
