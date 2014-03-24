<?php
class UserModel extends Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function reg($paras){
		if (!is_array($paras)){
			parametersErr();
		}
	}
}