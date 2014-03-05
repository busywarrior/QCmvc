<?php
class UserController extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		var_dump($this->db);
		$this->loadView();
	}
	
	function login(){
		$this->loadView('login');
	}
	
	function reg(){
		
	}
	
	private function isAuth(){
		if (!empty($_SESSION['id'])){
			return true;
		}
		else return false;
	}
	
	function authenticate(){
		$paras = $this->paras;
	}
	
	function upload(){
		$target = $_REQUEST['target']; //ajax response 处理的元素
		$upfilename = $target.'_file';

		$mid = intval($_REQUEST['mid']);

		$max_n = 2;
		$Max_Size= $max_n*1024*1024;
			
		if(empty($_FILES[$upfilename])) {
			exit(json_encode(array("status"=>FALSE,"result"=>"请选择图片上传!")));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'请选择图片上传!');</script>");
		}

		if($_FILES[$upfilename]['size'] > $Max_Size) {
			exit(json_encode(array("status"=>FALSE,"result"=>"您上传的图片超出最大限制:".$Max_Size)));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'您上传的图片超出最大限制:".$max_n."MB');</script>");
		}
		 
		$typearr = array('image/jpeg','image/jpeg','image/pjpeg','image/gif','image/png','image/x-png','image/tiff','image/tif','application/kswps','application/kswps','application/msword','application/pdf');
		if(!in_array($_FILES[$upfilename]['type'],$typearr))
		{
			exit(json_encode(array("status"=>FALSE,"result"=>"图片格式错误,允许的格式: jpg/jpeg/gif/png/x-png/tiff/tif")));
   	 		//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'文件格式错误.');</script>");
		}
		 
		//取得毫秒时间戳
		$timestamp = floor((microtime(true)*1000));

		try {
			$path = $_SERVER["DOCUMENT_ROOT"]."/tmp_upload/" .

			$timestamp.".jpg";
				
			if (is_uploaded_file($_FILES[$upfilename]["tmp_name"]))
			move_uploaded_file($_FILES[$upfilename]["tmp_name"],

			$path);
			else
			copy($_FILES[$upfilename]["tmp_name"], $path);
				
			$rel_path = "/tmp_upload/" .$timestamp.".jpg";
			//TODO UPDATE MEMBER IMAGE LOGIC
				
			if (intval($mid)>0){
				$member = new Member();
				//删除上次上传的文件
				$res = $member->view(array("ID"=>intval($mid)),true);
				unlink(trim($_SERVER["DOCUMENT_ROOT"].$res[0]

				['IdCard']));

				//存储本次身份图片到数据库
				$member->set(array("IdCard"=>$http_path,"ID"=>$mid));
			}
			
			$http_path = "http://".$_SERVER["HTTP_HOST"].$rel_path;
			
			exit(json_encode(array("status"=>FALSE,"result"=>array("http_path"=>$http_path,"rel_path"=>$rel_path))));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(true,'$http_path','$rel_path','$target');</script>");
		}catch (Exception $e){
			exit(json_encode(array("status"=>FALSE,"result"=>$e->getMessage())));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,".$e->getMessage().");</script>");
		}
	}
}