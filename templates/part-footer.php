<?php if ($hdl = get_field('footer_headline', get_the_ID())): ?>
<div class="footer_text txt">
	<h5><?php echo $hdl; ?></h5>
	<?php
	if ($txt = get_field('footer_text', get_the_ID())):
		echo $txt;
	else: 
		echo'<p>This article was last updated ' .get_the_modified_date(). ' and originally published ' .get_the_date(). '.</p>';						
	endif; ?>
</div>
<?php else: ?>	
	<div class="no_footer"></div>
<?php endif; ?>