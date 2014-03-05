<?php
class Mysql{
	private $server="";
	private $user="";
	private $password="";
	private $database="";
	
	private $con;
	private $isopen = false;
	
	private $query;
	
	public function __construct(){
		$this->server = SERVER;
		$this->user = USER;
		$this->password = PASSWORD;
		$this->database = DATABASE;
	}
	private function open(){
		if (!$this->isopen){
			$this->con = mysql_connect($this->server,$this->user,$this->password);
			$this->isopen = true;
		}
	}
	private function close(){
		if ($this->isopen){
			mysql_close($this->con);
		}
	}
	
	private function query($database = DATABASE){
		
		if (empty($this->query)){
			exit('System Error: the query is empty');
		}
		
		$this->open();
		
		if ($this->database != $database){
			$this->database = $database;
		}
		
		mysql_select_db($this->database);
		$res = mysql_query($this->query,$this->con);
		
		return $res;
	}
	
	public function set_query($query){
		$this->query = $query;
		
		if (empty($this->query)){
			exit('System Error: the query is empty');
		}
	}
	
	public function get_inserted_id(){
		$res = mysql_query("select LAST_INSERT_ID() as id",$this->con);
		
		$res = $this->getOne();
		
		return intval($res[0]['id']);
	}
	
	public function is_updated(){
		return mysql_affected_rows()>0? true : false;
	}
	
	/*
	 return: it is an array
	*/
	public function getAll(){
		
		$res = $this->query();
		
		if (mysql_num_rows($res) <=0)return null;
		while($row=mysql_fetch_assoc($res)){
  			$response[]=$row;
		}
		foreach($response as $key => $value){
 			 $newData[$key]=$value;
		}
		unset($value);
		
		$this->close();//close connection
		
		return $newData;
	}
	
	/*
	 return: it is an array
	*/
	public function getOne(){
		$res = $this->query();
		
		if (mysql_num_rows($res) <=0)return null;
		
		if($row=mysql_fetch_assoc($res)){
  			$response[]=$row;
		}
		foreach($response as $key => $value){
 			 $newData[$key]=$value;
		}
		unset($value);
		
		$this->close();//close connection
		
		return $newData;
	}
	
	public function update(){
		$res = $this->query();
		
		$flag = false;
		
		if ($this->is_updated()){
			$flag = true;
		}
		
		$this->close();//close connection
		
		return $flag;
	}
	
	public function delete(){
		$res = $this->query();
		
		$flag = false;
		
		if ($this->is_updated()){
			$flag = true;
		}
		
		$this->close();//close connection
		
		return $flag;
	}
	
	public function insert(){
		$res = $this->query();
		
		$id = 0;
		
		if ($this->is_updated()){
			$id = $this->get_inserted_id();
		}
		
		$this->close();//close connection
		
		return $id;
	}
	
	/*
	public function select($fields=null){
		$this->query = "select";
		if (empty($fields))$this->query .= $this->space()."*";
		else {
			$i=0;
			foreach ($fields as $field){
				if ($i == 0)
					$this->query .= $this->space().$field;
				else 
					$this->query .= ','.$field;
				$i++;
			}
			
			unset($i);
			unset($field);
		}
		$this->query .= $this->space();
	}
	
	public function from($tables){
		if (empty($tables)) exit("System Error: table is empty.");
		
		$this->query .= $this->space()."from"
		if (count($tables) == 1){
			$this->query .= $this->space().$tables[0];
		}
		elseif (count($tables) > 0){
			$i = 0;
			foreach ($tables as $table){
				if ($i == 0)
					$this->query .= $this->space().$table;
				else $this->query .= 
			}
			unset($i);
			unset($table);
		}
		
	}
	
	private function space(){
		return " ";
	}
	*/
}