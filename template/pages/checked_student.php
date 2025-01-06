<?php
	session_start();
	include  "../../conn.php";
	$_SESSION['active'] = 0;

	$id = $_POST['sec'];
	$tmp_id = $id;
	$class_name = $_POST['name'];
	$class = $db->query("SELECT * FROM imam WHERE nomcomplet='$class_name'")->fetch(PDO::FETCH_ASSOC);
	$max_std = $class["id"];
	$randomAdd = $_POST['randomAdd'];
	$clas = $_POST['name'];
	$tmp = $clas;

	$i = 0;
	while($id[$i])
		$i++;

	$j = 0;
	if(isset($_POST["update"]))
	{
		if($i <= $max_std){
			if($class_name != 0)
			foreach ($id as $id) {
				$ex=$db->query("SELECT * FROM imam WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
				if($ex["name"] != $class_name){
					$update = $db->query("UPDATE imame SET nomcomplet='$class_name' WHERE id='$id'");
					$j++;
				}else
					$update = true;
			}
		}
		$max_std = $max_std - $j;
		
		if ($update){
	        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="merci . !";
	    }
	    else{
	        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible. !";
	    }
	}

	if (isset($_POST["delete"])) {
		$j = 0;
		foreach ($id as $id) {
			$std_class = $db->query("SELECT imam FROM students WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
			$class_std = $std_class["nomcomplet"];
			$count_class = $db->query("SELECT * FROM imam WHERE nomcomplet='$class_std'")->fetch(PDO::FETCH_ASSOC);
			$new_class_count = $count_class["id"] + 1;
			//$upd_class = $db->query("UPDATE classes SET classes_count='$new_class_count' WHERE classes_name = '$class_std'");
			$all_delete = $db->query("DELETE FROM imam WHERE id='$id'");
			$j++;
		}

		if ($all_delete){
	        $_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Ok. !";
	    }
	    else{
	        $_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Impossible !";
	    }
	}

	if(isset($randomAdd))
	{
		$total_class_count = 0; // seçili olan sınıfların kontenjan sayısının toplamı.
		$total_std_count = 0; // seçili olan öğrenci sayısı.
		$total_class = 0; // seçili olan sınıfların sayısı.
		$last_std_class = 0; // seçili olan her öğrencinin eski sınıfını tutar.
		$new_class_count = 0;

		foreach ($id as $id)
			$total_std_count++;

		foreach ($clas as $clas) {
			$count_class = $db->query("SELECT classes_count FROM classes WHERE classes_name='$clas'")->fetch(PDO::FETCH_ASSOC);
			$total_class_count += $count_class["classes_count"]." ";
			$total_class++;
		}
		
		if($total_std_count <= $total_class_count){
			
			while($total_std_count--){
				$rand = rand(0, $total_class-1);
				$last_class = $db->query("SELECT * FROM students WHERE student_id='$tmp_id[$total_std_count]'")->fetch(PDO::FETCH_ASSOC);
				$last_class_count = $last_class["student_class"];
				$last_class_count = $db->query("SELECT classes_count FROM classes WHERE classes_name='$last_class_count'")->fetch(PDO::FETCH_ASSOC);
					$new_class_count = $db->query("SELECT * FROM classes WHERE classes_name='$tmp[$rand]'")->fetch(PDO::FETCH_ASSOC);
				
				
				if($new_class_count["classes_count"] > 0 && $last_class["student_class"] != $new_class_count["classes_name"])
				{
					$last_class_count = $last_class_count["classes_count"] + 1;
					$last_class_name = $last_class['student_class'];
					$last_class_count = $db->query("UPDATE classes SET classes_count='$last_class_count' WHERE classes_name='$last_class_name'");


					$class = $tmp[$rand];
					$id = $tmp_id[$total_std_count];
					$new_class_count = $new_class_count["classes_count"]-1;
					
					$new_class_count = $db->query("UPDATE classes SET classes_count='$new_class_count' WHERE classes_name='$class'");
					$new_std_class = $db->query("UPDATE students SET student_class='$class' WHERE student_id = '$id'");
				}
				else{
					$total_std_count++;
					;
				}
				if ($new_std_class) {
					$_SESSION['active'] = 1;$_SESSION['color']="success";$_SESSION['message']="Öğrenciler Başarıyla Sınıflara Rastgele Atandı. !";
				}else{
					$_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Öğrenciler Sınıflara Rastgele Atanırken Bir Sorun Oluştu. !";
				}
			}
		}else{
			$_SESSION['active'] = 1;$_SESSION['color']="danger";$_SESSION['message']="Sınıf Kontenjanı Aşıldı. !";
		}
	}
	header("Refresh: 0; url=imam.php");
 ?>
