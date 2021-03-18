<!-- Main Header -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
	<div class="container">
		<a href="<?= base_url('dashboard') ?>" class="navbar-brand d-none d-md-inline">
			<img src="<?= base_url('assets/dist/img/logo_icon/circle_96x96.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">amg-tagasa</span>
		</a>

		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>


		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<?php if ($group_id == '1') : ?>
					<li class="nav-item dropdown">
						<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= lang('menu-users'); ?></a>
						<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
							<li><a href="<?= site_url('users/group'); ?>" class="dropdown-item"><?= lang('menu-add-group'); ?></a></li>
							<li><a href="<?= site_url('users/add'); ?>" class="dropdown-item"><?= lang('menu-add-user'); ?></a></li>
							<li><a href="<?= site_url('users'); ?>" class="dropdown-item"><?= lang('menu-all-users'); ?></a></li>
						</ul>
					</li>
				<?php endif ?>
				<li class="nav-item">
					<a href="index3.html" class="nav-link">About</a>
				</li>
			</ul>
		</div>

		<!-- Right navbar links -->
		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
			<li class="nav-item dropdown lang-menu">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="flag-icon <?= $lang_idiom == 'english' ? 'flag-icon-us' : 'flag-icon-id'; ?>"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right p-0">
					<a href="javascript:void(0)" onclick="switchLang('english')" class="dropdown-item <?= $lang_idiom == 'english' ? 'active' : ''; ?>">
						<i class="flag-icon flag-icon-us mr-2"></i> English
					</a>
					<a href="javascript:void(0)" onclick="switchLang('indonesian')" class="dropdown-item <?= $lang_idiom == 'indonesian' ? 'active' : ''; ?>">
						<i class="flag-icon flag-icon-id mr-2"></i> Indonesia
					</a>
				</div>
			</li>
			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-user"></i>
					<span class="d-none d-md-inline"><?= $firstName . ' ' . $lastName ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- User image -->
					<li class="user-header bg-gray">
						<img src="<?= base_url('assets/dist/img/avatar/robot_0' . $group_id . '.png') ?>" class="img-circle elevation-2" alt="User Image">
						<p><?= $firstName . ' ' . $lastName ?></p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<a href="<?= site_url('users/change_password'); ?>" class="btn btn-default btn-flat"><?= lang('menu-change-pass'); ?></a>
						<a href="<?= site_url('signout'); ?>" class="btn btn-default btn-flat float-right"><?= lang('menu-signout'); ?></a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<!-- /.navbar -->