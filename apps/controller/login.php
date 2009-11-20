<?php
	class LOGIN_controller extends Controller
	{
		function LOGIN_controller()
		{
			$this->loadModel("USER");
		}
		
		function index()
		{
			$this->view();	
		}
		
		function send()
		{
			$this->SECURITY_LOAD();

			$userid = $this->_POST("userid_txt");
			$passwd = $this->SECURITY->encrypt($this->_POST("userpasswd_txt"));

			$row = $this->USER->Login($userid, $passwd);

			if (!$row)
			{
				$this->Redirect("login");
			}
			else
			{
				$this->SECURITY->SESSION("uid", $row["uid"]);
				$this->SECURITY->SESSION("userid", $row["userid"]);
				header("location:/planet/".$userid);
			}
			
		}
	}
?>