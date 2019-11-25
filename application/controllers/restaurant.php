<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurant extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {

        if (empty($this->session->userdata('shopid'))) {
            redirect('/restaurant/login', 'refresh');
            return;
        }

        $shopid=$this->session->userdata('shopid');
        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $sql = "select m.*,r1.name,r2.name as mname from reservation m left join shop r1 on m.shopid=r1.shopid left join members r2 on r2.memberid=m.memberid where m.shopid='$shopid'";
        $date['shop'] = $this->db->query($sql);

        $this->load->view('restaurant/index_view', $date);
    }


    public function login()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        $this->load->view('restaurant/login_view', $date);
    }

    public function logining()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        ob_start();
        $user = $this->input->get_post('username');
        $pass = $this->input->get_post('passwd');

        echo $user." ".$pass;
        if (!empty($user) && !empty($pass)) {
            $pass = $pass;
            $sql = "SELECT * FROM shop WHERE username='" . $user . "' and passwd='" . $pass . "'  ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {

                $this->session->set_userdata('shopid', $query->row()->shopid);
                $this->session->set_userdata('shopname', $query->row()->name);

                redirect('restaurant/index', 'refresh');
            } else {
                echo "bb";

                $date["fail"] = " a();";
                $this->load->view('restaurant/login_view', $date);
            }
        } else {
            echo "aa";
            $this->load->view('restaurant/login_view', $date);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */