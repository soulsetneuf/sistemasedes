<?php 
   /**
   * 
   */
   class Validaciones
   {
   	  function esLetra($dato)
   	  {
   	  	for ($i=0; $i <strlen($dato) ; $i++) { 
   	  		# code...
   	  		if (!(($dato[$i]>='a' && $dato[$i]<='z') || ($dato[$i]>='A' && $dato[$i]<='Z'))) {
        	    return false;
	        }
   	  	}
   	  	return true;
   	  }
   	  function esNumero($dato)
   	  {
   	    for ($i=0; $i <strlen($dato) ; $i++) { 
   	  		# code...
   	  		if (!($dato[$i]>='0' && $dato[$i]<='1')) {
        	    return false;
	        }
   	  	}
   	  	return true;	
   	  }
   }
 ?>