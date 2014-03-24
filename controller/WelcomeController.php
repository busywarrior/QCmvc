<?php
class WelcomeController extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		echo "Welcome to the QC MVC!";
	}
}