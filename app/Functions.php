<?php 
	function setActive($path, $subPaths=null)
	{
	    // return Request::is($path . '*') ? ' class=active' :  '';
	    if ($subPaths) {
	    	return Request::is($path . '*') ? ' class=active' :  '';
		} else  {
			return Request::is($path) ? ' class=active' :  '';
		}
	}
 ?>