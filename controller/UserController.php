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
		$target = $_REQUEST['target']; //ajax response �����Ԫ��
		$upfilename = $target.'_file';

		$mid = intval($_REQUEST['mid']);

		$max_n = 2;
		$Max_Size= $max_n*1024*1024;
			
		if(empty($_FILES[$upfilename])) {
			exit(json_encode(array("status"=>FALSE,"result"=>"��ѡ��ͼƬ�ϴ�!")));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'��ѡ��ͼƬ�ϴ�!');</script>");
		}

		if($_FILES[$upfilename]['size'] > $Max_Size) {
			exit(json_encode(array("status"=>FALSE,"result"=>"���ϴ���ͼƬ�����������:".$Max_Size)));
			//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'���ϴ���ͼƬ�����������:".$max_n."MB');</script>");
		}
		 
		$typearr = array('image/jpeg','image/jpeg','image/pjpeg','image/gif','image/png','image/x-png','image/tiff','image/tif','application/kswps','application/kswps','application/msword','application/pdf');
		if(!in_array($_FILES[$upfilename]['type'],$typearr))
		{
			exit(json_encode(array("status"=>FALSE,"result"=>"ͼƬ��ʽ����,����ĸ�ʽ: jpg/jpeg/gif/png/x-png/tiff/tif")));
   	 		//exit("<script type=\"text/javascript\" language=\"javascript\">parent.Action.uploadCallBack(false,'�ļ���ʽ����.');</script>");
		}
		 
		//ȡ�ú���ʱ���
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
				//ɾ���ϴ��ϴ����ļ�
				$res = $member->view(array("ID"=>intval($mid)),true);
				unlink(trim($_SERVER["DOCUMENT_ROOT"].$res[0]

				['IdCard']));

				//�洢�������ͼƬ�����ݿ�
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