<div class="wrap">
	
	<h1><?php _e('Envato Affiliate', 'eawp'); ?></h1>	
	
	<?php settings_errors(); ?>	
	
	<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'api'; ?>
	
	<div class="envato-affiliate-row">
		
		<div class="envato-affiliate-col-9">

			<div class="envato-affiliate-tab-wrapper">

				<ul class="envato-affiliate-tabs">

					<li class="envato-affiliate-tab <?php echo $active_tab == 'api' ? 'envato-affiliate-tab-active' : ''; ?>">

						<a href="?page=eawp&tab=api" class="envato-affiliate-tab-link"><?php _e('API', 'eawp'); ?></a>

					</li><!-- end .envato-affiliate-tab -->

					<li class="envato-affiliate-tab <?php echo $active_tab == 'general' ? 'envato-affiliate-tab-active' : ''; ?>">

						<a href="?page=eawp&tab=general" class="envato-affiliate-tab-link"><?php _e('Allgemein', 'eawp'); ?></a>

					</li><!-- end .envato-affiliate-tab -->

				</ul><!-- end .envato-affiliate-tabs -->

				<div class="envato-affiliate-tab-content">

					<?php foreach ( glob( plugin_dir_path( EAWP_FILE ) . "templates/options/*.php" ) as $file ) include_once $file; ?>

				</div><!-- end .envato-affiliate-tab-content -->

			</div><!-- end .envato-affiliate-tab-wrapper -->
			
		</div>
		
		<div class="envato-affiliate-col-3">

			<div class="envato-affiliate-informations">
				
				<h4><?php _e('Links & Support', 'eawp'); ?></h4>
				
				<p><?php _e('Du hast Fragen oder Verbesserungsvorschl&auml;ge? Zögere nicht und schreibe uns. Wir sind fast rund um die Uhr am PC.', 'eawp'); ?></p>

				<ul>
					<li><a href="https://devhats.de/" target="_blank"><?php _e('Plugin-Website', 'eawp'); ?></a></li>
					<li><a href="https://wordpress.org/plugins-wp/simple-marketplace-affiliate/" target="_blank"><?php _e('Changelog', 'eawp'); ?></a></li>
					<li><a href="https://wordpress.org/support/plugin/simple-marketplace-affiliate/" target="_blank"><?php _e('Support', 'eawp'); ?></a></li>
				</ul>
				
			</div><!-- end .envato-affiliate-informations -->
			
		</div>
	
	</div><!-- end .envato-affiliate-row -->
			
</div>
