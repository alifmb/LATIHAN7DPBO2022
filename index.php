<?php

include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

$sorting = FALSE;

if(isset($_POST['add'])){
	$otask->add();
	header("Location: #");
}
else if(isset($_GET['id_hapus'])){
	$key = $_GET['id_hapus'];
	$otask->delete($key);

}else if(isset($_GET['id_status'])){
	$key = $_GET['id_status'];
	$otask->stats($key);
}else if(isset($_GET['column'])){
	$keyword = $_GET['column'];
	$otask->sort($keyword);
	$sorting = TRUE;
}


if($sorting ==  FALSE){
	$otask->getTask();
}


// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

$otask->close();

$tpl = new Template("templates/skin.html");

$tpl->replace("DATA_TABEL", $data);

$tpl->write();
