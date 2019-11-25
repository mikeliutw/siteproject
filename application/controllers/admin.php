<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
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

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $date['query1'] = $this->db->query("select * from activity order by createtime desc");

        $date['date'] = $this->all_model->getDate();

        $query = $this->db->query("select * from webprofile")->row();

        $date['name'] = $query->name;
        $date['activityfile'] = $query->activityfile;
        $date['activityname'] = $query->activityname;
        $date['banner'] = $this->db->query("select DISTINCT(pagename) from banner");


        $date['links'] = $this->db->query("select * from links order by createtime desc");
        $this->master2->view('admin/index_view', $date);
    }


    function links_adds()
    {

        $name = $this->input->get_post('name');
        $links = $this->input->get_post('links');
        $sort = $this->input->get_post('sort');


        $this->db->query("insert into links  values(null,'$name','$links','$sort',NOW())");
        redirect('/admin#tabs-3', 'refresh');

    }

    public function links_del()
    {

        $query = $this->db->query("delete from links where linksid='" . $this->uri->segment('3', 0) . "'");
        redirect('/admin#tabs-3', 'refresh');
    }

    public function links_update()
    {

        $links = $this->input->get_post('links');
        $name = $this->input->get_post('name');
        $linksid = $this->input->get_post('linksid');
        $sort = $this->input->get_post('sort');


        $this->db->query("update links set  sort=\"" . $sort . "\",name=\"" . $name . "\",link=\"" . $links . "\"   where linksid='" . $linksid . "'");
        redirect('/admin#tabs-3', 'refresh');
    }


    public function banner_update()
    {
        $url = $this->input->get_post('url');
        $bannerid = $this->input->get_post('bannerid');
        $config['upload_path'] = "./uploads/images/";
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xlsx|ppt|pptx|zip|html|swf';
        $config['max_size'] = '1000000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';


        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {

            $da = $this->upload->data();
        }

        $filename = $da['file_name'];

        $this->db->query("update banner set url=\"/uploads/images/" . $filename . "\"   where bannerid='" . $bannerid . "'");
        redirect('/admin#tabs-4', 'refresh');
    }


    public function banner_del()
    {

        $query = $this->db->query("delete from banner where bannerid='" . $this->uri->segment('3', 0) . "'");
        redirect('/admin#tabs-4', 'refresh');
    }

    public function banner_adds(){

        $config['upload_path'] = "./uploads/images/";
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xlsx|ppt|pptx|zip|html|swf';
        $config['max_size'] = '1000000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $pagename = $this->input->get_post('pagename');


        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {

            $da = $this->upload->data();
        }

        $filename = $da['file_name'];

        $this->db->query("insert into  banner values (null, '/uploads/images/$filename' ,'$pagename' ,1,NOW() )");
        redirect('/admin#tabs-4', 'refresh');
    }

    public function activity_adds()
    {

        $title = $this->input->get_post('title');
        $date = $this->input->get_post('date');
        $url = $this->input->get_post('url');
        $content = $this->input->get_post('editor1');
        $img = $this->input->get_post('img');


        $content = htmlspecialchars($content, ENT_QUOTES);


        $this->db->query("insert into activity  values(null,NOW(),'$title',\"" . $content . "\",'$url','$img',NOW())");
        redirect('/admin#tabs-2', 'refresh');
    }

    public function activity_detail()
    {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];


        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];
        $date['activityid'] = $this->uri->segment('3', 0);

        $query = $this->db->get_where('activity', array('activityid' => $date['activityid']))->row();
        $date['title'] = $query->title;
        $date['content'] = $query->content;

        $date['content'] = htmlspecialchars_decode($date['content'], ENT_QUOTES);


        $date['date'] = $query->date;

        $date['img'] = $query->img;
        $date['url2'] = $query->url;

        $this->master2->view('admin/activity_edit_view', $date);
    }

    public function activity_del()
    {

        $query = $this->db->query("delete from activity where activityid='" . $this->uri->segment('3', 0) . "'");
        redirect('/admin#tabs-2', 'refresh');
    }

    public function activity_update()
    {

        $title = $this->input->get_post('title');
        $content = $this->input->get_post('editor1');
        $date = $this->input->get_post('date');
        $url = $this->input->get_post('url');
        $img = $this->input->get_post('img');

        $activityid = $this->input->get_post('activityid');

        $content = htmlspecialchars($content, ENT_QUOTES);


        $this->db->query("update activity set title=\"" . $title . "\",content=\"" . $content . "\",date=\"" . $date . "\",url='" . $url . "', img=\"" . $img . "\"   where activityid='" . $activityid . "'");
        redirect('/admin#tabs-2', 'refresh');
    }


    public function login()
    {

        if ($this->session->userdata('USERNAME') != "") {
            redirect('/admin/index', 'refresh');
        }

        $date['fail'] = "";
        $date['url'] = base_url() . "/application/views/admin/";
        $this->load->view('admin/login_view', $date);
    }

    public function logining()
    {
        ob_start();
        $user = $this->input->get_post('user');
        $pass = $this->input->get_post('pass');
        $date['url'] = base_url() . "/application/views/admin/";
        if (!empty($user) && !empty($pass)) {
            $pass = $pass;
            $sql = "SELECT * FROM account WHERE username='" . $user . "' and pw='" . $pass . "'  ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {

                $this->session->set_userdata('USERNAME', $query->row()->username);
                $this->session->set_userdata('EMAIL', $query->row()->email);
                $this->session->set_userdata('userid', $query->row()->accountid);


                redirect('admin/index', 'refresh');
            } else {
                $date["fail"] = " a();";
                $this->load->view('admin/login_view', $date);
            }
        } else {
            $this->load->view('admin/login_view', $date);
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('/admin/login', 'refresh');
    }

    function webconfig_update()
    {

        $name = $this->input->get_post('name');
        $activityfile = $this->input->get_post('activityfile');

        $activityname = $this->input->get_post('activityname');


        $sql = "update webprofile set   name='$name' ,activityfile='$activityfile',activityname='$activityname'  ";
        $this->db->query($sql);
        // echo $sql;

        redirect('admin/', 'refresh');
    }

    function account()
    {
        $date['error'] = "";
        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];
        $date['perm'] = $this->session->userdata('perm');

        $date['query'] = $this->db->get('account');

        $this->master2->view('admin/account_view', $date);
    }

    function account_edit()
    {

        $date['id'] = $this->uri->segment('3', 0);

        $date['url'] = base_url() . "application/views/admin/";
        $date['adminurl'] = base_url() . "index.php/admin/";
        $date['perm'] = $this->session->userdata('perm');
        $date['row'] = $this->db->get_where('account', array('accountid' => $date['id']))->row();
        $this->master2->view('admin/account_edit_view', $date);
    }

    function account_edit_update()
    {

        $date['url'] = base_url() . "application/views/admin/";
        $date['adminurl'] = base_url() . "index.php/admin/";
        $date['perm'] = $this->session->userdata('perm');

        $id = $this->input->get_post('id');
        $password = $this->input->get_post('password');
        $chkpassword = $this->input->get_post('chkpassword');
        $email = $this->input->get_post('email');
        $name = $this->input->get_post('name');
        $updatetime = $this->all_model->getTime();


        if (empty($password) && empty($chkpassword)) {
            $sql = "update account set email='$email', name='$name' where accountid='$id'";
            //echo $sql;
            $this->db->query($sql);
            redirect(base_url() . "index.php/admin/account", 'refresh');
        } else {
            if ($password == $chkpassword) {
                $sql = "update account set pw='" . $password . "', name='$name', email='$email' where accountid='$id'";
                //echo $sql;
                $this->db->query($sql);
                redirect(base_url() . "index.php/admin/account", 'refresh');
            } else {
                echo "Please check your password<br>
<a href='javascript:history.back()'>back</a>";
            }
        }
    }

    function account_del()
    {

        $id = $this->uri->segment('3', 0);
        $sql = "delete from account where accountid='$id'";
        $this->db->query($sql);

        redirect(base_url() . "index.php/admin/account", 'refresh');
    }

    function account_add()
    {

        $date['name'] = $this->input->get_post('name');
        $date['url'] = base_url() . "application/views/admin/";
        $date['adminurl'] = base_url() . "index.php/admin/";
        $date['perm'] = $this->session->userdata('perm');

        $this->master2->view('admin/account_add_view', $date);
    }

    function account_adds()
    {

        $account = $this->input->get_post('username');
        $name = $this->input->get_post('name');
        $password = $this->input->get_post('password');
        $chkpassword = $this->input->get_post('chkpassword');
        $email = $this->input->get_post('email');


        $sql2 = "select * from account where username='$account'";
        $totle = $this->db->query($sql2)->num_rows();
        if ($totle) {
            echo "can't use $account<br><a href='javascript:history.back()'>back</a>";
        } else {
            if ($password == $chkpassword) {
                $sql = "insert into account (`username`,`pw`,`name`,`email`)
						values('$account','" . $password . "','$name','$email')";
                $this->db->query($sql);
                redirect(base_url() . "index.php/admin/account", 'refresh');
            } else {
                echo "Please check your password<br>
		<a href='javascript:history.back()'>back</a>";
            }
        }
    }


    function course()
    {
        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $sql = "select m.* from course m  ";
        $row = $this->db->query($sql)->row();
        $date['coursenews'] = $row->coursenews;
        $date['download'] = $row->download;
        $date['student'] = $row->student;
        $date['graduatecourse'] = $row->graduatecourse;

        $date['relate'] = $row->relate;


        $this->master2->view('admin/course_view', $date);
    }

    public function course_update()
    {
        $coursenews = $this->input->get_post('coursenews');
        $download = $this->input->get_post('download');
        $relate = $this->input->get_post('relate');
        $graduatecourse = $this->input->get_post('graduatecourse');

        $student = $this->input->get_post('student');


        $sql = "update course set student='$student', graduatecourse='$graduatecourse', coursenews='" . $coursenews . "' , download='" . $download . "', relate='" . $relate . "' ";
        $this->db->query($sql);
        redirect('admin/course', 'refresh');
    }

    



    function teacher()
    {
        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $sql = "select m.*,r1.teachercategory from teacher m left join teachercategory r1 on m.teachercategoryid=r1.teachercategoryid order by m.sort asc ";
        $date['ta'] = $this->db->query($sql);

        $sql = "select m.* from assist m  ";
        $date['ta1'] = $this->db->query($sql);


        $this->master2->view('admin/teacher_view', $date);
    }

    function teacher_add()
    {
        $name = $this->input->get_post('name');

        $sql = "insert into teacher (teacherid,name) values (null,'" . $name . "')";
        $this->db->query($sql);
        $teacherid = $this->db->insert_id();

        redirect('admin/teacher_edit/' . $teacherid, 'refresh');
    }

    public function teacher_del()
    {

        $id = $this->uri->segment('3', '');
        $sql = "delete from teacher where teacherid='" . $id . "'";
        $this->db->query($sql);
        redirect('admin/teacher', 'refresh');
    }

    function teacher_edit()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];

        $id = $this->uri->segment('3', '');

        $sql = "select * from teacher  where teacherid='$id' ";
        $date['teacher'] = $this->db->query($sql)->row();

        $sql = "select * from teachercategory   ";
        $date['teachercategory'] = $this->db->query($sql);

        $this->master2->view('admin/teacherdetail_view', $date);
    }

    public function assist_del()
    {

        $id = $this->uri->segment('3', '');
        $sql = "delete from assist where assistid='" . $id . "'";
        $this->db->query($sql);
        redirect('admin/teacher', 'refresh');
    }

    function assist_edit()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];

        $id = $this->uri->segment('3', '');

        $sql = "select * from assist  where assistid='$id' ";
        $date['teacher'] = $this->db->query($sql)->row();

        $this->master2->view('admin/assistdetail_view', $date);
    }

    public function teacher_update()
    {

        $sort = $this->input->get_post('sort');
        $position = $this->input->get_post('position');
        $name = $this->input->get_post('name');
        $content = $this->input->get_post('content');
        $image = $this->input->get_post('image');
        $teacherid = $this->input->get_post('teacherid');
        $otherdep = $this->input->get_post('otherdep');


        $teachercategoryid = $this->input->get_post('teachercategoryid');


        $sql = "update teacher set teachercategoryid='$teachercategoryid',otherdep='$otherdep', sort='" . $sort . "' , position='" . $position . "', name='" . $name . "',content='" . $content . "',image='" . $image . "' where teacherid='" . $teacherid . "'";
        $this->db->query($sql);
        redirect('admin/teacher_edit/' . $teacherid, 'refresh');
    }

    public function assist_update()
    {

        $sort = $this->input->get_post('sort');
        $position = $this->input->get_post('position');
        $name = $this->input->get_post('name');
        $content = $this->input->get_post('content');
        $brief = $this->input->get_post('brief');


        $image = $this->input->get_post('image');
        $assistid = $this->input->get_post('assistid');


        $sql = "update assist set sort='" . $sort . "' , position='" . $position . "', name='" . $name . "',content='" . $content . "',brief='" . $brief . "',image='" . $image . "' where assistid='" . $assistid . "'";
        $this->db->query($sql);
        redirect('admin/teacher', 'refresh');
    }


    public function news()
    {
        $date['url'] = base_url() . "/application/views/admin/";
        $date['adminurl'] = base_url() . "index.php/admin/";

        for ($i = 1; $i < 5; $i++) {
            $date['query' . $i] = $this->db->query("select * from news where newscategoryid=$i order by createdate desc");
        }

        $date['date'] = $this->all_model->getDate();

        $this->master2->view('admin/news_view', $date);
    }

    public function news_adds()
    {

        $title = $this->input->get_post('title');
        $date = $this->input->get_post('date');
        $newscategoryid = $this->input->get_post('newscategoryid');
        $url = $this->input->get_post('url');
        $content = $this->input->get_post('editor1');
        $top = $this->input->get_post('top');
        $img = $this->input->get_post('img');

        $content = htmlspecialchars($content, ENT_QUOTES);


        if ($top == "on") {
            $top = 1;
        } else {
            $top = 0;
        }
        $this->db->query("insert into news  values(null,'$newscategoryid',NOW(),'$title',\"" . $content . "\",'$url','$top','$img',NOW())");
        redirect('/admin/news', 'refresh');
    }

    public function news_detail()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];
        $date['newsid'] = $this->uri->segment('3', 0);

        $query = $this->db->get_where('news', array('newsid' => $date['newsid']))->row();
        $date['title'] = $query->title;
        $date['content'] = $query->content;
        $date['newscategoryid'] = $query->newscategoryid;
        $date['date'] = $query->createdate;

        $date['img'] = $query->img;
        $date['url2'] = $query->url;
        $date['top'] = $query->top;

        $this->master2->view('admin/news_edit_view', $date);
    }

    public function news_del()
    {

        $query = $this->db->query("delete from news where newsid='" . $this->uri->segment('3', 0) . "'");
        redirect('/admin/news', 'refresh');
    }

    public function news_update()
    {

        $title = $this->input->get_post('title');
        $content = $this->input->get_post('editor1');
        $date = $this->input->get_post('date');
        $url = $this->input->get_post('url');
        $img = $this->input->get_post('img');
        $top = $this->input->get_post('top');

        $content = htmlspecialchars($content, ENT_QUOTES);


        if ($top == "on") {
            $top = 1;
        } else {
            $top = 0;
        }

        $newsid = $this->input->get_post('newsid');
        $newscategoryid = $this->input->get_post('newscategoryid');


        $this->db->query("update news set title=\"" . $title . "\",content=\"" . $content . "\",createdate=\"" . $date . "\",newscategoryid=\"" . $newscategoryid . "\",url='" . $url . "', img=\"" . $img . "\", top=\"" . $top . "\"  where newsid='" . $newsid . "'");
        redirect('/admin/news/' . $this->input->get_post('type'), 'refresh');
    }

    function custom()
    {
        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $id = $this->input->get_post('custom');
        if ($id == 'aboutEn1' || $id == 'aboutEn2' || $id == 'aboutEn3' || $id == 'aboutEn4' || $id == 'aboutEn5') {
            $page = $this->db->query("select * from custom_page2 ");
        } else {
            $page = $this->db->query("select * from custom_pages ");
        }
        $row = $page->row();
        if ($id != "") {
            $date['page'] = @$row->$id;
            $date['pname'] = $id;
        } else {
            $date['page'] = "";
            $date['pname'] = "";
        }


        $this->master2->view('admin/customer_view', $date);
    }

    function custom_update()
    {

        $id = $this->input->get_post('id');
        $content = $this->input->get_post('content');

        $content = htmlspecialchars($content, ENT_QUOTES);


        // echo "update  custom_pages set $id='$content' ";
        if ($id == 'aboutEn1' || $id == 'aboutEn2' || $id == 'aboutEn3' || $id == 'aboutEn4' || $id == 'aboutEn5') {
            $page = $this->db->query("update  custom_page2 set $id=\"$content\" ");
        } else {
            $page = $this->db->query("update  custom_pages set $id=\"$content\" ");
        }
        redirect('/admin/custom/', 'refresh');
    }

    function picupload()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];


        $this->master2->view('admin/picupload_view', $date);
    }

    function pic_upload()
    {
        $config['upload_path'] = "./uploads/images/";
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xlsx|ppt|pptx|zip|html|swf';
        $config['max_size'] = '1000000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';


        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {

            $da = $this->upload->data();
            redirect('admin/picupload/', 'refresh');
        }
    }

    function pic_del()
    {

        $file = $this->input->get_post('currfile');

        unlink('./uploads/images/' . $file);
        redirect('/admin/picupload', 'refresh');
    }

    function index_picupdate()
    {
        $id = $this->input->get_post('id');
        $surl = $this->input->get_post('surl');
        $burl = $this->input->get_post('burl');

        $this->db->query("update indexpic set surl='$surl', burl ='$burl' where id='$id'");
        redirect('/admin/', 'refresh');
    }

    function salon()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];

        $date['query1'] = $this->db->query("select m.*,r1.name from salon  m left join saloncategory r1 on m.type=r1.saloncategoryid order by createtime desc");

        $this->master2->view('admin/salon_view', $date);


    }

    public function salon_adds()
    {

        $title = $this->input->get_post('title');

        $content = $this->input->get_post('editor1');
        $content = htmlspecialchars($content, ENT_QUOTES);
        $type = $this->input->get_post('type');

        $saloncategory = $this->input->get_post('saloncategory');


        $this->db->query("insert into salon  values(null,'$saloncategory','$title',\"" . $content . "\",NOW())");
        redirect('/admin/salon', 'refresh');
    }

    public function salon_detail()
    {

        $path = $this->all_model->getPath();
        $date['url'] = $path[0];
        $date['adminurl'] = $path[1];
        $date['salonid'] = $this->uri->segment('3', 0);

        $query = $this->db->get_where('salon', array('salonid' => $date['salonid']))->row();
        $date['title'] = $query->title;
        $date['content'] = $query->content;
        $date['type'] = $query->type;


        $this->master2->view('admin/salon_edit_view', $date);
    }

    public function salon_del()
    {

        $query = $this->db->query("delete from salon where salonid='" . $this->uri->segment('3', 0) . "'");
        redirect('/admin/salon', 'refresh');
    }

    public function salon_update()
    {

        $title = $this->input->get_post('title');
        $content = $this->input->get_post('editor1');
        $content = htmlspecialchars($content, ENT_QUOTES);
        $type = $this->input->get_post('saloncategory');

        $salonid = $this->input->get_post('salonid');

        $this->db->query("update salon set title=\"" . $title . "\",content=\"" . $content . "\", type=\"" . $type . "\"  where salonid='" . $salonid . "'");
        redirect('/admin/salon/', 'refresh');
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */