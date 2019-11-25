<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master
{

    var $obj;
    var $master;
	var $date;

    function  Master($master = "lib_view")
    {
        $this->obj =& get_instance();
        $this->master = $master;

    }

    function setLayout($master)
    {
      $this->master = $master;
    }

    function view($view, $data, $return=false)
    {
        $loadedData = array();
        $loadedData['main'] = $this->obj->load->view($view,$data,true);

        if($return)
        {
            $output = $this->obj->load->view($this->master, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->master, $loadedData, false);
        }
    }
}
?>