<?php

return [
	'navbar_pages' => [
		'is_left' => false,
		'is_right' => true,
		'classes' => [
			'hide-on-med-and-down'
		],
		'menu_items' => [
			'home' => [
				'display_name' => 'Startseite',
				'route_name' => 'home',
				'classes' => []
			],
			'dtg_printing' => [
				'display_name' => 'DTG-Druck',
				'route_name' => 'dtg-druck',
				'classes' => []
			],
			'3d_printing' => [
				'display_name' => '3D-Druck',
				'route_name' => '3d-druck',
				'classes' => []
			]
		]
	],
	'navbar_system_pages' => [
		'is_left' => false,
		'is_right' => true,
		'classes' => [],
		'menu_items' => [
			'options' => [
				'display_name' => 'Optionen',
				'icon' => 'settings',
				'url' => '#!',
				'route_name' => null,
				'classes' => [],
				'menu_items' => [
					'logout' => [
						'display_name' => 'Logout',
						'icon' => 'lock_outline',
						'url' => null,
						'route_name' => 'logout',
						'classes' => []
					]
				]
			]
		]
	]
];
