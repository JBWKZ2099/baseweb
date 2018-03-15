<?php
	ini_set("display_errors", "Off");
	include_once("data.php");

	function conectar_db(){
		$mysqli = mysqli_connect(SERVER, USER, PASSWORD) 	or die ('No se pudo establecer la conexión al servidor.');
		mysqli_query($mysqli, 'SET NAMES "utf8"');
		mysqli_set_charset($mysqli, "UTF8");
		return $mysqli;
	}

	function selecciona_db($mysqli){
		mysqli_select_db($mysqli, DATABASE) or die ('No se pudo establecer la conexión con la Base de Datos, error: '.mysqli_error($mysqli));
	}

	function registro_nuevo($tabla, $datos, $columna){
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$Consulta = "INSERT INTO $tabla VALUES (";
			for ($i=0; $i < count($datos); $i++) { 
				$Consulta = $Consulta.$datos[$i];
				if ($i != count($datos)-1)
					$Consulta.=",";
			}
			$Consulta.=")";

		$pConsulta = consulta_tb($mysqli, $Consulta);
		session_start();
		if (!$pConsulta) {
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli);
		}
		else{
			$_SESSION["message"] = "Éxito al guardar.";
		}
		cerrar_db($mysqli);
	}

	function consulta_tb($mysqli, $Sql){
			global $resultado;
			$resultado = mysqli_query($mysqli, $Sql);
			if($resultado <> NULL){
				return $resultado;
			}else{
				return 0;
			}
			mysqli_close($mysqli);
	}
	function cerrar_db($mysqli) { mysqli_close($mysqli); }

	function validateData($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM $table WHERE id=$id";
		$result = mysqli_query( $mysqli, $sql );

		if( mysqli_num_rows($result)>0 )
			return true;
		else {
			session_start();
			$_SESSION["error"] = "No hay datos con el id seleccionado.";
			return false;
		}
	}

	function deleteRecord($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$deleted_at = setTimeStamp();
		$sql = "UPDATE $table SET deleted_at='$deleted_at' WHERE id=$id";
		mysqli_query($mysqli, $sql);
		session_start();
		$_SESSION["message"] = "El registro se eliminó correctamente";
		mysqli_close($mysqli);
	}

	function restoreRecord($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$deleted_at = setTimeStamp();
		$sql = "UPDATE $table SET deleted_at=NULL WHERE id=$id";
		mysqli_query($mysqli, $sql);
		session_start();
		$_SESSION["message"] = "El registro se restauró correctamente";
		mysqli_close($mysqli);
	}

	function getGTitle($id) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT bar_graph_title, line_graph_title, circle_graph_title FROM graph_titles WHERE id_user=$id";
		$result = mysqli_query( $mysqli, $sql );
		return json_encode( mysqli_fetch_row( $result ) );
	}

	function getLineChart($id) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM line_graphs WHERE id_user = $id AND deleted_at IS NULL ORDER BY id ASC";
		$result = mysqli_query( $mysqli, $sql );

		if( mysqli_num_rows($result)>0 ) {
			while( $row=mysqli_fetch_array($result,MYSQLI_ASSOC) )
				$arr[] = $row;
		} else {
			$arr["status"] = "no_results";
		}
		return json_encode( $arr );
	}

	function getBarChart($id) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM bar_graphs WHERE id_user = $id AND deleted_at IS NULL ORDER BY id DESC";
		$result = mysqli_query( $mysqli, $sql );

		if( mysqli_num_rows($result)>0 ) {
			while( $row=mysqli_fetch_array($result,MYSQLI_ASSOC) )
				$arr[] = $row;
		} else {
			$arr["status"] = "no_results";
		}
		return json_encode( $arr );
	}

	function getCircleChart($id) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM circle_graphs WHERE id_user = $id AND deleted_at IS NULL";
		$result = mysqli_query( $mysqli, $sql );

		if( mysqli_num_rows($result)>0 ) {
			while( $row=mysqli_fetch_array($result,MYSQLI_ASSOC) )
				$arr[] = $row;
		} else {
			$arr["status"] = "no_results";
		}
		return json_encode( $arr );
	}

	function getCustomers() {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM users WHERE permission=1 ORDER BY id";
		$result = mysqli_query( $mysqli, $sql );
		print_r($result);
		$arr = array();

		if( mysqli_num_rows($result)>0 ) {
			while( $row=mysqli_fetch_array($result,MYSQLI_ASSOC) )
				$arr[] = $row;
		} else {
			$arr[] = "no_data";
		}
		// return json_encode( $arr );
	}

	function checkCustomerData($post) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$id = (int)$post["id_user"];

		$user_bar_graph = "SELECT * FROM bar_graphs WHERE id_user=$id AND deleted_at IS NULL";
		$user_line_graph = "SELECT * FROM line_graphs WHERE id_user=$id AND deleted_at IS NULL";
		$user_circle_graph = "SELECT * FROM circle_graphs WHERE id_user=$id AND deleted_at IS NULL";
		$gtitle = "SELECT * FROM graph_titles WHERE id_user=$id";

		$result0 = mysqli_query( $mysqli, $user_bar_graph );
		$result1 = mysqli_query( $mysqli, $user_line_graph );
		$result2 = mysqli_query( $mysqli, $user_circle_graph );
		$result3 = mysqli_query( $mysqli, $gtitle );
		
		/*checking if customer has data to show graphs*/
			$resp_arr = array();
			$count = mysqli_num_rows($result0);

			if( $count==0 )
				$resp_arr["bar_graph"] = "empty";
			else
				$resp_arr["bar_graph"] = "not_empty";

			$count = null;
			$count = mysqli_num_rows($result1);

			if( $count==0 )
				$resp_arr["line_graph"] = "empty";
			else
				$resp_arr["line_graph"] = "not_empty";

			$count = null;
			$count = mysqli_num_rows($result2);

			if( $count==0 )
				$resp_arr["circle_graph"] = "empty";
			else
				$resp_arr["circle_graph"] = "not_empty";

			$count = null;
			$count = mysqli_num_rows($result3);

			$arr = array("has_data"=>null, "customer_id"=>null, "title_1"=>null, "title_2"=>null, "title_3"=>null);
			if( $count>0 ) {
				while( $row=mysqli_fetch_array($result3) ) {
					$arr["customer_id"] = $row["id_user"];
					$arr["title_1"] = $row["bar_graph_title"];
					$arr["title_2"] = $row["line_graph_title"];
					$arr["title_3"] = $row["circle_graph_title"];	
				}
			} else {
					$create_sql = "INSERT INTO graph_titles VALUES(NULL, '".$id."', '', '', NULL, NULL, NULL)";
					$arr["customer_id"] = $id;
			}
		/*checking if customer has data to show graphs*/

		/*response*/
			if( $resp_arr["bar_graph"]=="empty" || $resp_arr["line_graph"]=="empty" || $resp_arr["circle_graph"]=="empty" )
				$arr["has_data"] = false;
			else
				$arr["has_data"] = true;

			return json_encode( $arr );
		/*response*/
	}

	function updateTitles($post) {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$id = (int)$post["customer"];

		$gtitle = "SELECT * FROM graph_titles WHERE id_user=$id";
		$result = mysqli_query( $mysqli, $gtitle );
		if( mysqli_num_rows($result)>0 ) {
			$sql_update = "UPDATE `graph_titles` SET `bar_graph_title` = '".$post["bar_graph_name"]."', `line_graph_title` = '".$post["line_graph_name"]."', `circle_graph_title` = '".$post["circle_graph_name"]."', `updated_at` = '".date("Y-m-d H:i:s")."' WHERE `graph_titles`.`id_user` = $id";
			$result = mysqli_query( $mysqli, $sql_update );

			if( $result )
				return json_encode( array("updated"=>"success") );
			else
				return json_encode( array("updated"=>"error", "msg"=>mysqli_error($mysqli)) );
		}
	}

	function processFile($post, $operation) {
		header('Content-Type: application/json');
		date_default_timezone_set("UTC");
		date_default_timezone_set("America/Mexico_City");

		if( $operation=="upload" ) {
			$upload_path = "../graficador/uploads/excel/";
			$info = pathinfo( $_FILES["excel"]["name"] ); // Get file info
			$ext = $info["extension"]; // Get extension
			
			if( $ext=="xlsx" || $ext=="xls" ) {
				$fname = $info["filename"]; // Get file name without extension
				$rand = date("Y_m_d_Gis"); // Generate rand string (date)
				$new_name = $rand."_".$fname.".".$ext; // Creating new file name
				$target = $upload_path.$new_name; // Full path to save file
				move_uploaded_file($_FILES["excel"]["tmp_name"], $target);
				$arr = array(
					"status" => "upload_ok",
					"file_name" => $new_name,
				);
			} else {
				$arr = array("status" => "error_ext");
			}

			return json_encode( $arr );
		} else {
			$mysqli = conectar_db();
			selecciona_db($mysqli);

			$customer_id = (int)$post["customer"];

			/*Actions if update*/
				if( $post["update_data"]==1 ) {
					$sql = "DELETE FROM bar_graphs WHERE id_user = $customer_id";
					$res = mysqli_query( $mysqli, $sql );
					mysqli_free_result($res);

					$sql = "DELETE FROM line_graphs WHERE id_user = $customer_id";
					$res = mysqli_query( $mysqli, $sql );
					mysqli_free_result($res);

					$sql = "DELETE FROM circle_graphs WHERE id_user = $customer_id";
					$res = mysqli_query( $mysqli, $sql );
					mysqli_free_result($res);
				}
			/*Actions if update*/
			$excel_path = "../graficador/uploads/excel/".$post["file_name"];
			$created_at = setTimeStamp();
			
			$array_read = readExcel( $excel_path, 0 );
			$arrval = array();
			for( $i=0; $i<count($array_read); $i++ ) {
				for( $j=0; $j<=count($array_read[$i]); $j++ ) {
					if( $array_read[$i][$j]!=NULL && !empty($array_read[$i][$j]) )
						$arrval[$j]=$array_read[$i][$j];
				}
				$restante = null;
				$restante = 1 - $arrval[1];
				$sql = "INSERT INTO bar_graphs VALUES(NULL, $customer_id, '$arrval[0]', '$arrval[1]', '$restante', '$created_at', NULL, NULL )";
				$result = mysqli_query( $mysqli, $sql );
				mysqli_free_result($result);
			}

			unset($array_read);
			unset($arrval);
			$array_read = readExcel( $excel_path, 1 );
			// var_dump($array_read);
			for( $i=0; $i<count($array_read); $i++ ) {
				for( $j=0; $j<=count($array_read[$i]); $j++ ) {
					if( $array_read[$i][$j]!=NULL && !empty($array_read[$i][$j]) )
						$arrval[$j]=$array_read[$i][$j];
				}
				$sql = "INSERT INTO line_graphs VALUES(NULL, $customer_id, '$arrval[0]', '$arrval[1]', '$arrval[2]', '$created_at', NULL, NULL )";
				$result = mysqli_query( $mysqli, $sql );
				mysqli_free_result($result);
			}

			unset($array_read);
			unset($arrval);
			$array_read = readExcel( $excel_path, 2 );
			for( $i=0; $i<count($array_read); $i++ ) {
				for( $j=0; $j<=count($array_read[$i]); $j++ ) {
					if( $array_read[$i][$j]!=NULL && !empty($array_read[$i][$j]) )
						$arrval[$j]=$array_read[$i][$j];
				}
				$sql = "INSERT INTO circle_graphs VALUES(NULL, $customer_id, '$arrval[0]', '$arrval[1]','$arrval[2]', '$created_at', NULL, NULL )";
				$result = mysqli_query( $mysqli, $sql );
				mysqli_free_result($result);
			}

			return json_encode( array("db_populate" => "ready") );
		}
	}

	function readExcel($file_path, $current_sheet) {
		include_once("../PHPExcel/PHPExcel.php");
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		$reader = PHPExcel_IOFactory::createReader("Excel2007");
		$reader->setReadDataOnly(true);
		$excel = $reader->load($file_path);
		$sheet = $excel->setActiveSheetIndex($current_sheet);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		$rows = array();
		$ret_arr = array();
		// var_dump("highest row: ".$highestRow);
		// var_dump("highest column: ".$highestColumn);
		// var_dump("highest column index: ".$highestColumnIndex);

		for ($row = 2; $row <= $highestRow; ++$row) {
			for ($col = 0; $col <= $highestColumnIndex; ++$col) {
				if( $col==0 && $current_sheet==1 ) {
					// var_dump("col: ".$col);
					// var_dump("row: ".$row);
					$date = $sheet->getCellByColumnAndRow($col, $row)->getValue();
					$timestamp = PHPExcel_Shared_Date::ExcelToPHP($date);
					$cell_val = new DateTime( date("Y/m/d", $timestamp) );
					// var_dump("before +1: ".$cell_val->format("d/m/Y"));
					$cell_val = $cell_val->modify("+1 day")->format("d/m/Y");
					// var_dump("after +1: ".$cell_val->format("d/m/Y"));
				} else
					$cell_val = $sheet->getCellByColumnAndRow($col, $row)->getValue();
				
				if( $cell_val!=NULL )
					$rows[$col] = $cell_val;
			}
			$ret_arr[] = $rows;
		}
		return $ret_arr;
	}

	function dataTable($post, $columns, $col_clean, $sql_data) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		// storing  request (ie, get/post) global array to a variable  
		$requestData= $post;

		// getting total number records without any search
		$sql = "SELECT $sql_data[0] ";
		$sql.=" FROM $sql_data[1]";
		$query=mysqli_query($mysqli, $sql);
		$totalData = mysqli_num_rows($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


		$sql = "SELECT $sql_data[0] ";
		$sql.=" FROM $sql_data[1] ";
		if( isset($sql_data[2]) ) {
			$sql.=$sql_data[2];
		}
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$counter = 0;
			foreach( $columns as $column ) {
				if( $counter==0 )
					$sql.=" AND ( $column LIKE '%".$requestData['search']['value']."%' ";
				else
					$sql.=" OR $column LIKE '%".$requestData['search']['value']."%' ";
				$counter++;
			}
			$sql.=")";
		}
		$query=mysqli_query($mysqli, $sql);
		$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start'].", ".$requestData['length'];
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
		$query=mysqli_query($mysqli, $sql);

		$data = array();
		while( $row=mysqli_fetch_array($query) ) {  // preparing an array
			$nestedData=array();
			foreach( $col_clean as $column )
				$nestedData[] = $row[$column];

			$data[] = $nestedData;
		}
		$json_data = array(
			"draw" => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal" => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	function updateData($id, $columns, $datas, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$sql = "UPDATE $table SET ";
		for( $i=0; $i<count($columns); $i++ ) {
			$sql .= " $columns[$i]='$datas[$i]'";
			if( $i!=count($columnas)-1 )
				$sql .= ", ";
		}
		$sql = rtrim($sql,", ");
		$updated_at = setTimeStamp();
		$sql .= ", updated_at='$updated_at' WHERE id=$id";
		// var_dump($sql);
		// exit();
		
		session_start();
		if( mysqli_query( $mysqli, $sql ) )
			$_SESSION["message"] = "Los datos se actualizaron correctamente.";
		else
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli);
	}

	function uploadPDF($files){
		$upload_path = "../graficador/uploads/pdf/";				
		$info = pathinfo( $_FILES["pdf"]["name"] ); // Get file info
		$ext = $info["extension"]; // Get extension
		$validate_ext = "pdf";

		$ret_arr = array();
		
		if( $ext==$validate_ext ) {
			$fname = $info["filename"]; // Get file name without extension
			$rand = date("Y_m_d_Gis"); // Generate rand string (date)
			$new_name = $rand."_".$fname.".".$ext; // Creating new file name
			$target = $upload_path.$new_name; // Full path to save file
			move_uploaded_file($_FILES["pdf"]["tmp_name"], $target);
			$ret_arr[0] = $new_name;
			$ret_arr[1] = true;
		} else {
			$arr = array("status" => "error_ext");
			session_start();
			$_SESSION["error"] = "La extensión del archivo subido no es correcta, debe ser ".$validate_ext;
			$ret_arr[0] = null;
			$ret_arr[1] = false;
		}
		return $ret_arr;
	}

	function setTimeStamp() {
		date_default_timezone_set("UTC");
		date_default_timezone_set("America/Mexico_City");
		return date("Y-m-d H:i:s");
	}
?>