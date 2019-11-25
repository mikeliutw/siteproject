<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
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

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        $this->master->view('login_view', $date);
    }

    public function reg()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        $this->master->view('reg_view', $date);
    }

    public function regs()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];

        $name = $this->input->get_post('name');
        $password = $this->input->get_post('password');
        $username = $this->input->get_post('username');

        $sql = "SELECT * FROM members WHERE username='" . $username . "'  ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $this->session->set_userdata('usernameexit', true);
            redirect('/login/reg', 'refresh');
        } else {
            $this->session->sess_destroy();
        }

        $this->db->query("insert into members  values(null,'$name','$username','$password',NOW())");
        redirect('/reservation', 'refresh');

    }

    public function logining()
    {
        ob_start();
        $user = $this->input->get_post('user');
        $pass = $this->input->get_post('pass');
        if (!empty($user) && !empty($pass)) {
            $pass = $pass;
            $sql = "SELECT * FROM members WHERE username='" . $user . "' and passwd='" . $pass . "'  ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {

                $this->session->set_userdata('frontusername', $query->row()->username);
                $this->session->set_userdata('frontuserid', $query->row()->memberid);

                redirect('welcome/index', 'refresh');
            } else {
                $date["fail"] = " a();";
                $this->load->view('login_view', $date);
            }
        } else {
            $this->load->view('login_view', $date);
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('/welcome', 'refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
