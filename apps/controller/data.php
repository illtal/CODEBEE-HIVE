<?php
class DATA_controller extends Controller
{
	function DATA_controller()
	{
		//$this->LoadLib("DB");
		$this->SECURITY_LOAD();
		$this->LoadModel("USER");
		$this->LoadHelper("IPHONE");
	}
	
	function index()
	{
		//$this->DB->executeNonQuery("insert into TB_Foo (id, val, regDate) values (2, 'test', '2009-09-09')");
		$this->USER->DB->select("userid, nickname")->from("P_TB_USER_TAB")->where(array("userid"=>"illtal", "passwd"=>"20839"));//.ToString();
		//echo "T";
		echo $this->USER->DB->ToString();	
	}
	
	function user($user)
	{
		//echo $user;
		$id = "UserList";
		$this->IPHONE->create("Hello,".$user."'s World!");
		$this->IPHONE->addListPage($id, "test", true);
		
		
		$item = array();
		$item["anchor"] = "www.google.com";
		$item["text"] = "google";
		$this->IPHONE->addListItem($item, $id);
		
		
		echo $this->IPHONE->getDocument();
		/*
		if (!$this->isLogin())
		{
			header("location:/planet/login");
			exit;
		}	
		*/		
		//echo $this->SECURITY->SESSION("userid");
	}
	
	private function isLogin()
	{
		if(!$this->SECURITY->SESSION("userid"))
			return false;
			
		return true;
	}
	
	function user2($user)
	{
		echo "test". $user;
	}
}
?>