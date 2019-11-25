<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Welcome extends CI_Controller
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

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $sql = "select m.*,r1.category from shop m left join category r1 on m.categoryid=r1.categoryid;";
        $date['shop'] = $this->db->query($sql);

        $this->master->view('index_view', $date);
    }

    public function shopdetail()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $id = $this->uri->segment('3', 0);
        $sql = "select m.*,r1.category from shop m left join category r1 on m.categoryid=r1.categoryid where m.shopid=$id";
        $date['query2'] = $this->db->query($sql)->row();
        $this->master->view('shopdetail_view', $date);
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
