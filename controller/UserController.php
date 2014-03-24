<?php
class UserController extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->loadView("user");
	}
	
	function login($account,$pwd){
		$this->loadView('login');
	}
	
	function reg(){
		
	}	
}