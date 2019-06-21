<div class="navbar-fixed">
	<nav class="color-1">
		<div class="nav-wrapper container">
			<a href="#" data-target="side-nav" class="sidenav-trigger">
				<i class="material-icons">menu</i>
			</a>

			<a href="<?php echo $router->pathFor('home'); ?>" class="brand-logo">
				<img src="image/vaachar-logo.png" alt="VaaChar Logo">
				<span>VaaChar</span>
			</a>

			<?php $menus = $request->getAttribute('menus'); ?>

			<?php foreach ($menus as $menu) : ?>
				<?php if (in_array($menu->getName(), ['navbar_pages', 'navbar_system_pages'])) : ?>
					<?php require __DIR__ . '/menu.php' ?>
				<?php endif; ?>

				<?php if ($menu->getName() === 'navbar_pages') : ?>
					<?php require __DIR__ . '/side-nav.php'; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</nav>
</div>
