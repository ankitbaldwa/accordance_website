<?php
$cakeDescription = 'Accordance';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('/img/favicon.png',['type' => 'icon']) ?>
    <!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <!--end::Fonts -->

    <?= $this->Html->css(['../assets/plugins/custom/fullcalendar/fullcalendar.bundle', '../assets/plugins/global/plugins.bundle', '../assets/css/style.bundle']) ?>

    <!--begin::Layout Skins(used by all pages) -->
    <?= $this->Html->css(['../assets/css/pages/login/login-6','../assets/css/skins/header/base/light', '../assets/css/skins/header/menu/light', '../assets/css/skins/brand/dark','../assets/css/skins/aside/dark','../assets/plugins/custom/datatables/datatables.bundle']) ?>
    <!--end::Layout Skins -->
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>
		<?php echo $this->Html->scriptBlock(sprintf(
			'var csrfToken = %s;',
			json_encode($this->request->getAttribute('csrfToken'))
		)); ?>
		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
        <?= $this->Html->script(['../assets/plugins/global/plugins.bundle.js','../assets/js/scripts.bundle.js']) ?>

		<!--end::Global Theme Bundle -->
		<?= $this->fetch('content') ?>
</body>
</html>