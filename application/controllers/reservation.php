<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservation extends CI_Controller
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
        $this->load->library('session');

    }

    public function index()
    {

        if (empty($this->session->userdata('frontuserid'))) {
            redirect('/login/index', 'refresh');
            return;
        }
        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $id = $this->uri->segment('3', 0);

        $date['id'] = $id;
        $sql = "select m.*,r1.category from shop m left join category r1 on m.categoryid=r1.categoryid where m.shopid=$id";
        $date['query2'] = $this->db->query($sql)->row();

       $this->master->view('reservation_view', $date);
    }

    public function post()
    {

        if (empty($this->session->userdata('frontuserid'))) {
            redirect('/login/index', 'refresh');
            return;
        }

        $memberid=$this->session->userdata('frontuserid');

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $id = $this->input->get_post('id');
        $people = $this->input->get_post('people');
        $date = $this->input->get_post('date');
        $time = $this->input->get_post('time');
        $this->db->query("insert into reservation  values(null,'$memberid','$id','$people','$date','$time',NOW())");
        redirect('/reservlist', 'refresh');

    }
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
		