<?php if( $type == 'link' ) : ?>

<a href="<?= $item['url'] . $item['ref'] ?>" target="_blank" title="<?= $item['theme_name'] ?>"><?= $item['theme_name'] ?></a>

<?php else : ?>

<div class="eawp--content">
	
	<div class="eawp--icon">
		<a href="<?= $item['url'] . $item['ref'] ?>" target="_blank" title="<?= $item['theme_name'] ?>">
			<img src="<?= $item['icon_url'] ?>" alt="<?= $item['theme_name'] ?>" />
		</a>
	</div>		
					
	<h3>
		<a href="<?= $item['url'] . $item['ref'] ?>" target="_blank" title="<?= $item['theme_name'] ?>">
			<?= $item['theme_name'] ?>
		</a> 
		<span class="eawp--version"><?= $item['version'] ?></span>
	</h3>		
		
	<div class="eawp--text">
		<div class="eawp--description"><?= $item['description'] ?></div>
		
		<div class="eawp--author">
			<?php echo sprintf( 
	__('Von %s', 'eawp'), 
	'<a href="' . $item['author_url'] . $item['ref'] . '" target="_blank" title="' . $item['author_name'] . '">' . $item['author_name'] . '</a>' ); 
			?>
			
		</div>
			
	</div>
	
</div>
	
<div class="eawp--footer">
		
	<div class="eawp--rating"></div>
		
	<div class="eawp--actions">
		<a href="<?= $item['url'] . $item['ref'] ?>" class="eawp--btn" title="<?= $item['theme_name'] ?>" target="_blank">
			<?= __('Mehr erfahren', 'eawp') ?>
		</a>
	</div>	
	
</div>

<?php endif; ?>