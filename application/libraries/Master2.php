<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master2
{
    
    var $obj;
    var $Master2;
	var $date;
    
    function  Master2($Master2 = "adminlib_view")
    {
        $this->obj =& get_instance();
        $this->Master2 = $Master2;
    }

    function setLayout($Master2)
    {
      $this->Master2 = $Master2;
    }
    
    function view($view, $data, $return=false)
    {
        $loadedData = array();
        $loadedData['main'] = $this->obj->load->view($view,$data,true);
        
        if($return)
        {
            $output = $this->obj->load->view($this->Master2, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->Master2, $loadedData, false);
        }
    }
}
?>