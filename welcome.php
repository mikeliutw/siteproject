<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
      
    }

    public function index() {

        $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		
		$date['banner']=$this->db->query("select * from banner order by sort asc");
		
        $date['news'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=1 order by m.createtime desc limit 8");
		 $date['num']= $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=1 order by createtime desc")->num_rows;
	  
	  
	     $date['news2'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=2 and m.top !=1 order by m.createtime desc limit 8");
	     $date['num2']= $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=2 and m.top !=1 order by createtime desc")->num_rows;
		 
		  $date['news3'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid in (3,4) order by m.createtime desc limit 8");
	     $date['num3']= $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=3 order by createtime desc")->num_rows;
		 
		  $date['news4'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=4 order by m.createtime desc limit 8");
	     $date['num4']= $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=4 order by createtime desc")->num_rows;
	  
	  
	  	$date['activity'] = $this->db->query("select * from activity order by date desc limit 4");
      
        $this->master->view('index_view', $date);
    }

	function news(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        
       	$date['banner']=$this->db->query("select * from banner order by sort asc");
        $date['news'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid where m.newscategoryid=1 order by createtime desc ");    
        $this->master->view('news_view', $date);
	}

	function newsdetail(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		
		$date['banner']=$this->db->query("select * from banner order by sort asc");
	 	$id = $this->uri->segment('3', 0);
 		$date['news'] = $this->db->query("select * from news  order by createdate desc");
        $date['query2'] = $this->db->query("select m.*,newscategory from news m left join newscategory r1 on m.newscategoryid=r1.newscategoryid  where newsid=".$id."  order by newsid desc")->row();
        $this->master->view('newsdetail_view', $date);
	}


	function contact(){
	
		$path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        
		$date['banner']=$this->db->query("select * from banner order by sort asc");
		

              
        $this->master->view('contact_view', $date);
	}


	function about(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'2,1,3,4,5,6,7');");
		

              
        $this->master->view('about_view', $date);
	}


	function faculty(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'3,1,2,4,5,6,7');");
		
              
        $this->master->view('faculty_view', $date);
	}

	function faculty2(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'3,1,2,4,5,6,7');");
		

        $this->master->view('faculty2_view', $date);
	}

	function faculty3(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];            
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'3,1,2,4,5,6,7');");
		  
        $this->master->view('faculty3_view', $date);
	}


	function course(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'4,1,2,3,5,6,7');");
       
       
        $this->master->view('course_view', $date);
	}

	function course1(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'4,1,2,3,5,6,7');");
       
        $this->master->view('course1_view', $date);
	}

	function course2(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'4,1,2,3,5,6,7');");
       
       
        $this->master->view('course2_view', $date);
	}

	function course3(){
	
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
       $date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'4,1,2,3,5,6,7');");
	   
       
        $this->master->view('course3_view', $date);
	}


	function active(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'5,1,2,3,4,6,7');");
       
       
           $id = $this->uri->segment('3', 0);

		if($id==""){
		    $date['news'] = $this->db->query("select * from activity order by createtime desc ");
	      	$this->master->view('active_view', $date);
			
		}else{

 			$date['row'] = $this->db->query("select * from activity where  activityid='".$id."'")->row();
              
        	$this->master->view('active_view', $date);
		}
              
	}

	function salon(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
      
	  	$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'6,1,2,3,4,5,7');");

        $this->master->view('salon_view', $date);
	}

	function salondetail(){
	
	 $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'6,1,2,3,4,5,7');");
		
      
	  
	    $id = $this->uri->segment('3', 0);
	    $sql="select * from salon where salonid='".$id."'";
	  
	 	 $row=$this->db->query($sql)->row();
	     $date['content'] =$row->content;
	    $date['title'] =$row->title;
	  
              
        $this->master->view('salon_detail_view', $date);
	}

	function salon2_1(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		
		$date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'6,1,2,3,4,5,7');");
		
      
              
        $this->master->view('salon2_1_view', $date);
	}

	function salon2_2(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
		 $date['banner']=$this->db->query("select * from banner order by FIND_IN_SET(bannerid,'6,1,2,3,4,5,7');");
	
     
        $this->master->view('salon2_2_view', $date);
	}


	function qa(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
        
	   	 $date['banner']=$this->db->query("select * from banner order by bannerid asc");
        
       
              
        $this->master->view('qa_view', $date);
	}
	



	function active_live(){
	  $path = $this->all_model->getPathIndex();
        $date['currurl'] = $path[0];
        $date['url'] = $path[1];
       
	   		$date['banner']=$this->db->query("select * from banner order by bannerid asc");
	   
	      $id = $this->uri->segment('3', 0);

		if($id==""){
			        $date['news'] = $this->db->query("select * from activity order by createtime desc ");
			        	$this->master->view('active_list_view', $date);
			
		}else{

 			$date['row'] = $this->db->query("select * from activity where  activityid='".$id."'")->row();
              
        	$this->master->view('active_live_view', $date);
		}
	}

}

			/* End of file welcome.php */
			/* Location: ./application/controllers/welcome.php */
		