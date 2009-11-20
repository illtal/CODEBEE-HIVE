<?php
	function loader($file)
	{
		if (!file_exists($file))
			return false;
		
		require($file);
	}
?>