<header>
	<div class="midscreen">

		<div class="flex-grid">
			<div class="cell small-8 large-3">
				<a id="logo" href="<?php echo $baseUrl; ?>"><img src="<?php echo $baseUrl . "" . $companyLogo; ?>" alt="<?php echo $companyName; ?> Logo" title="<?php echo $companyName; ?> Logo"></a>
			</div>
			<div class="cell small-4 large-7 large-offset-2">
				<nav>
					<?php include(dirname(__FILE__) . '/nav.php'); ?>
				</nav>
			</div>
		</div>			
	</div>

	<?php include(dirname(__FILE__) . '/elements/scroll-progress.php'); ?>
</header>

