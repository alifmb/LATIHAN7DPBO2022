<?php 

class Task extends DB{
	
	function getTask(){
		$query = "SELECT * FROM tb_to_do";
		return $this->execute($query);
	}
	function add($tname, $tdeadline, $tdetails, $tsubject, $tpriority){
		$query = "INSERT INTO tb_to_do (name_td, details_td, subject_td, priority_td, deadline_td, status_td) values ('$tname', '$tdetails', '$tsubject', '$tpriority', 
		'$tdeadline', 'Belum')";
		return $this->execute($query);
	}
	function del($id){
		$query = "DELETE FROM tb_to_do where id = $id";
		return $this->execute($query);
	}
	function setfinish($id){
		$query = "UPDATE tb_to_do set status_TD = 'Sudah' where id=$id";
		return $this->execute($query);
	}
	function sortprior(){
		$query = "SELECT * from tb_to_do ORDER BY case when priority_td = 'High' then 3 when priority_td ='Medium' then 2 when priority_td = 'Low' then 1 end asc";
		return $this->execute(($query));
	}
	function sortelse($string){
		$query = "SELECT * from tb_to_do order by $string ASC";
		return $this->execute(($query));
	}
	
}
