<?php
	ini_set("display_errors", "On");
	include("data.php");
	include("conn.php");
	include("auth.php");
	$up_dir = "../../";


	if( isset($_POST["request"]) || isset($_GET["req"]) ) {
		if( $_SERVER["REQUEST_METHOD"]==="POST" ) {
			if( isset($_GET["req"]) )
				$request = $_GET["req"];
			else
				$request = $_POST["request"];

			if( isset($_GET["user_id"]) )
				$user_id = $_GET["user_id"];
		} else
			$request = $_GET["req"];

		switch( $request ) {
			case "login":
				$usr = $_POST["username"];
				$pswd = $_POST["password"];
				$validate = validateLogin( $usr, $pswd );

				if( $validate ) {
					header("Location: ".$up_dir."admin/");
				} else {
					$_SESSION["error"] = "<ul><li>Usuario y/o contraseña incorrectos.</li></ul>";
					header("Location: ".$up_dir."admin/login");
				}
				break;

			case "logout":
				logout();
				break;

			case "get-customers":
				echo getCustomers();
				break;

			case "get-gtitle":
				$id = $_POST["id_customer"];
				echo getGTitle($id);
				break;

			case "get-lchart":
				$id = $_POST["id_customer"];
				echo getLineChart($id);
				break;

			case "get-bchart":
				$id = $_POST["id_customer"];
				echo getBarChart($id);
				break;

			case "get-pchart":
				$id = $_POST["id_customer"];
				echo getCircleChart($id);
				break;

			case "check-customer-data":
				echo checkCustomerData($_POST);
				break;

			case "update-gtitle":
				echo updateTitles($_POST);
				break;

			case "upload-file":
				echo processFile($_POST, "upload");
				break;

			case "process-file":
				echo processFile($_POST, "process");
				break;

			case "historic":
				$tbl = "`historics`";
				$tbl2 = "`users`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.pdf",
					3 => "$tbl.user"
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "pdf",
					3 => "user"
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`pdf`, CONCAT( $tbl2.name, ' ', $tbl2.first_name ) AS user ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`user`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NULL "
				);
				if( isset($user_id) )
					$sql_data[2].="AND $tbl.`user`=".$user_id;
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-historic":
				date_default_timezone_set("UTC");
				date_default_timezone_set("America/Mexico_City");
				// var_dump($_FILES);
				// exit();
				if( isset($_FILES) ) {
					if( !uploadPDF($_FILES)[1] ) {
						header("Location: ".$up_dir."admin/historics-edit?id=".$_POST["which"]);
						$new_name = uploadPDF($_FILES)[0];
					} else {
						$new_name = uploadPDF($_FILES)[0];
					}
				} else {
					$mysqli = conectar_db();
					selecciona_db($mysqli);
					$sql = "SELECT * FROM historics WHERE id=".$_POST["which"];
					$result = mysqli_query( $mysqli, $sql );
					$row = mysqli_fetch_array($result);
					$new_name = $row["pdf"];
					mysqli_close($mysqli);
				}
				// var_dump($new_name); exit();

				$columns = array(
					0 => "name",
					1 => "pdf",
				);
				$data = array(
					0 => $_POST["name"],
					1 => $new_name,
				);
				$tbl = "historics";
				updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				header("Location: ".$up_dir."admin/historics");
				break;

			case "create-historic":
				date_default_timezone_set("UTC");
				date_default_timezone_set("America/Mexico_City");
				$upload_path = "".$up_dir."admin/uploads/pdf/";
				$info = pathinfo( $_FILES["pdf"]["name"] ); // Get file info
				$ext = $info["extension"]; // Get extension
				$validate_ext = "pdf";
				
				if( $ext==$validate_ext ) {
					$fname = $info["filename"]; // Get file name without extension
					$rand = date("Y_m_d_Gis"); // Generate rand string (date)
					$new_name = $rand."_".$fname.".".$ext; // Creating new file name
					$target = $upload_path.$new_name; // Full path to save file
					move_uploaded_file($_FILES["pdf"]["tmp_name"], $target);
				} else {
					$arr = array("status" => "error_ext");
					session_start();
					$_SESSION["error"] = "La extensión del archivo subido no es correcta, debe ser ".$validate_ext;
					header("Location: ".$up_dir."admin/historics");
				}

				$tbl = $_POST["table"];
				$columns = array(
					0 => "id",
					1 => "name",
					2 => "pdf",
					3 => "user",
					4 => "created_at",
					5 => "update_at",
					6 => "deleted_at",
				);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$new_name."'",
					3 => "'".$_POST["user"]."'",
					4 => "'".setTimeStamp()."'",
					5 => 'NULL',
					6 => 'NULL',
				);

				registro_nuevo($tbl, $data, $columns);
				header("Location: ".$up_dir."admin/historics-create");
				break;

			case "historic-restore":
				$tbl = "`historics`";
				$tbl2 = "`users`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.pdf",
					3 => "$tbl.user"
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "pdf",
					3 => "user"
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`pdf`, CONCAT( $tbl2.name, ' ', $tbl2.first_name ) AS user ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`user`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "customer":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NULL "
				);
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-customer":
				$password = null;
				if( isset($_POST["password"]) && !empty($_POST["password"]) )
					$password = $_POST["password"];

				$columns = array(
					0 => "name",
					1 => "first_name",
					2 => "last_name",
					3 => "username",
					4 => "email",
				);
				if( isset($password) )
					$columns[] = "password";

				$columns[] = "permission";

				$data = array(
					0 => $_POST["name"],
					1 => $_POST["first_name"],
					2 => $_POST["last_name"],
					3 => $_POST["username"],
					4 => $_POST["email"],
				);
				if( isset($password) )
					$data[] = cryptBlowfish($password);

				$data[] = $_POST["permission"];
				$tbl = "users";
				// var_dump($data); exit();
				updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				header("Location: ".$up_dir."admin/customers");

				break;

			case "create-customer":
				$tbl = $_POST["table"];
				$columns = array(
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "password",
					7 => "permission",
					8 => "remember_token",
					9 => "created_at",
					10 => "update_at",
					11 => "deleted_at",
				);
				$password = cryptBlowfish($_POST["password"]);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$_POST["first_name"]."'",
					3 => "'".$_POST["last_name"]."'",
					4 => "'".$_POST["username"]."'",
					5 => "'".$_POST["email"]."'",
					6 => "'".$password."'",
					7 => "'".$_POST["permission"]."'",
					8 => "''",
					9 => "'".setTimeStamp()."'",
					10 => 'NULL',
					11 => 'NULL',
				);
				// var_dump($data);
				// exit();

				registro_nuevo($tbl, $data, $columns);
				header("Location: ".$up_dir."admin/customers-create");
				break;

			case "customer-restore":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "delete":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];

				deleteRecord($id, $tbl);
				header("Location: ".$up_dir."admin/".$path);
				break;

			case "restore":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];
				
				restoreRecord($id, $tbl);
				header("Location: ".$up_dir."admin/".$path);
				break;
			
			default:
				break;
		}
	}
?>