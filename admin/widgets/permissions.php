<?php
	$permissions = array(
		"permission_users" => array(
			"name" => "Usuarios",
			"permissions" => array(
				"c" => "create",
				"r" => "read",
				"u" => "update",
				"d" => "delete",
			)
		),
		"permission_blogs" => array(
			"name" => "Blogs",
			"permissions" => array(
				"c" => "create",
				"r" => "read",
				"u" => "update",
				"d" => "delete",
			)
		),
		"permission_categories" => array(
			"name" => "Categorías",
			"permissions" => array(
				"c" => "create",
				"r" => "read",
				"u" => "update",
				"d" => "delete",
			)
		),
		"permission_subcategories" => array(
			"name" => "Subcategorías",
			"permissions" => array(
				"c" => "create",
				"r" => "read",
				"u" => "update",
				"d" => "delete",
			)
		),
		"permission_contacts" => array(
			"name" => "Lista de contactos",
			"permissions" => array(
				"r" => "read",
			)
		),
	);

	$_SESSION["permissions"] = $permissions;
?>