<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reservlist extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
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

    }

    public function index()
    {

        if (empty($this->session->userdata('frontuserid'))) {
            redirect('/login/index', 'refresh');
            return;
        }

        $memberid=$this->session->userdata('frontuserid');
        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $sql = "select m.*,r1.name from reservation m left join shop r1 on m.shopid=r1.shopid where m.memberid='$memberid'";
        $date['shop'] = $this->db->query($sql);

        $this->master->view('reservlist_view', $date);
    }

   
    public function cancel()
    {

        if (empty($this->session->userdata('frontuserid'))) {
            redirect('/login/index', 'refresh');
            return;
        }

        $memberid=$this->session->userdata('frontuserid');
        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $id = $this->uri->segment('3', 0);


        $sql = "delete from reservation where memberid='$memberid' and reservationid='$id'";
        $this->db->query($sql);

        redirect('/reservlist/index', 'refresh');  
      }

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
