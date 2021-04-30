<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class QueryHandler extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        $this->all_query();
    }

    function delete_query($query_id) {
        $this->Product_model->delete_table_information('padai_ask_query', 'id', $query_id);
        $this->Product_model->delete_table_information('channel_message_personal', 'channel_id', $query_id);
        redirect('QueryHandler/all_query');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    function add_user() {
        if (isset($_POST['submit'])) {
            $op_date_time = date('Y-m-d H:i:s');
            $user_type = $this->input->post('user_type');
            $password = $this->input->post('password');
            $pwd = md5($password);
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $post_data = array('first_name' => $first_name, 'last_name' => $last_name, 'email ' => $email, 'user_type' => $user_type, 'password2' => $password, 'password' => $pwd, 'op_date_time' => $op_date_time);
            $this->db->insert('admin_users', $post_data);
            redirect('QueryHandler/app_users');
        }



        $this->load->view('queryManager/addUser');
    }

    function app_users() {
         

  

        if ($this->session->logged_in['user_type'] == 'Admin'){
$query = " select * from admin_users order by id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/appUsers', $data);
         
      }
      else{
      $query = " select * from admin_users order by id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/notfound');      
     }

        
    }

    function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin_users');
        //$temp = array('user_comment', 'user_post', 'user_post_like', 'user_video_comment', 'user_video_like', 'user_video_post');
        $this->db->where('user_id', $id);
        $this->db->delete('user_comment');
        
        $this->db->where('user_id', $id);
        $this->db->delete('user_post');
        
        $this->db->where('user_id', $id);
        $this->db->delete('user_post_like');
        
        $this->db->where('user_id', $id);
        $this->db->delete('user_video_comment');
       
          $this->db->where('user_id', $id);
        $this->db->delete('user_video_like');
       
          $this->db->where('user_id', $id);
        $this->db->delete('user_video_post');
       
        redirect('QueryHandler/app_users');
        
    }

    function add_post() {
        $this->db->select('id, category_name');
        $query = $this->db->get('category');
        $data['category_data'] = $query->result();
        if (isset($_POST['submit'])) {
            $cat_name = $this->input->post('category_name');
            //$dat = date('Y-m-d ');
            //$tm = date('H:i:s');
            //$datetime = $dat . ' ' . $tm;
            $datetime = date("F j, Y, g:i a");
            //Check whether user upload picture
            if (!empty($_FILES['picture']['name'])) {

                $config['upload_path'] = 'assets_main/image/' . $cat_name;

                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);


                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));

                $file_newname = $temp1 . "." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                   $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }
            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'category_name' => $this->input->post('category_name'),
                'description' => $this->input->post('description'),
                'file_name' => $picture,
                'status' => 1,
                'op_date_time' => $datetime,
                'user_id' => $user_id);

            $this->db->insert('user_post', $post_data);
            $last_id = $this->db->insert_id();

            //Storing insertion status message.
            if ($last_id) {
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        $this->load->view('queryManager/addPost', $data);
    }

    function edit_post($query_id) {

        $query2 = "SELECT au.image as profileimage, au.first_name,au.last_name,uc.comment,uc.file_name,uc.op_date_time,uc.id,uc.post_id  FROM `user_comment` as uc join admin_users
as au on uc.user_id = au.id where uc.post_id = $query_id";



        $data['comments'] = $this->Product_model->query_exe($query2);

        $query = " select concat(au.first_name,' ',au.last_name) as name,c.category_name as cat,up.* from user_post as up"
                . " join admin_users as au on up.user_id = au.id"
                . " join category  as c on up.category_name = c.id "
                . " where up.id = '$query_id' "
                . "order by up.id desc";
        $datar = $this->Product_model->query_exe($query);
        if (count($datar)) {
            $data['data'] = $datar[0];
        }

        $this->db->select('id, category_name');
        $query = $this->db->get('category');
        $data['category_data'] = $query->result();

        if (isset($_POST['submit'])) {
            $cat_name = $this->input->post('category_name');
            //$dat = date('Y-m-d ');
            //$tm = date('H:i:s');
            //$datetime = $dat . ' ' . $tm;
            $datetime = date("F j, Y, g:i a");
            //Check whether user upload picture
            if (!empty($_FILES['picture']['name'])) {

                $config['upload_path'] = 'assets_main/image/' . $cat_name;

                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $temp1 = rand(100, 1000000);


                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));

                $file_newname = $temp1 . "." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }



            $this->db->set('category_name', $this->input->post('category_name'));  //Set the column name and which value to set..
            $this->db->set('description', $this->input->post('description'));
            $this->db->set('title', $this->input->post('title')); //Set the column name and which value to set.
            //$this->db->set('file_name',  $picture);  //Set the column name and which value to set.

            $this->db->where('id', $query_id); //set column_name and value in which row need to update

            $this->db->update('user_post'); //
            //Storing insertion status message.
            redirect('QueryHandler/edit_post/' . $query_id);
        }
        $this->load->view('queryManager/editPost', $data);
    }


 function edit_video_post($query_id){
       $query2 = "SELECT au.image as profileimage, au.first_name,au.last_name,uc.comment,uc.file_name,uc.op_date_time,uc.id,uc.post_id  FROM `user_video_comment` as uc join admin_users
as au on uc.user_id = au.id where uc.post_id = $query_id";



        $data['comments'] = $this->Product_model->query_exe($query2);

        $query = " select concat(au.first_name,' ',au.last_name) as name,c.category_name as cat,up.* from user_video_post as up"
                . " join admin_users as au on up.user_id = au.id"
                . " join category  as c on up.category_name = c.id "
                . " where up.id = '$query_id' "
                . "order by up.id desc";
        $datar = $this->Product_model->query_exe($query);
        if (count($datar)) {
            $data['data'] = $datar[0];
        }
        
        if (isset($_POST['submit'])) {
           
      
            $datetime = date("F j, Y, g:i a");
          
            $this->db->set('category_name', $this->input->post('category_name'));  //Set the column name and which value to set..
            $this->db->set('description', $this->input->post('description'));
            $this->db->set('title', $this->input->post('title')); //Set the column name and which value to set.
            $this->db->set('link',   $this->input->post('link'));  //Set the column name and which value to set.
            $this->db->set('op_date_time',   $datetime); 
            $this->db->where('id', $query_id); //set column_name and value in which row need to update

            $this->db->update('user_video_post'); //
            //Storing insertion status message.
            redirect('QueryHandler/edit_video_post/' . $query_id);
        }
        
        
        $this->load->view('queryManager/editVideoPost', $data);
 
 }

   function approve_status_all() {
      if ($this->session->logged_in){
        $query = " update user_post set status = 1 where id = $id ";
        $this->db->set('status', 1);  //Set the column name and which value to set..

        $this->db->update('user_post'); //
       }
        redirect('QueryHandler/user_post');
    }


    function approve_status($id) {
        $query = " update user_post set status = 1 where id = $id ";
        $this->db->set('status', 1);  //Set the column name and which value to set..

        $this->db->where('id', $id); //set column_name and value in which row need to update

        $this->db->update('user_post'); //
        redirect('QueryHandler/user_post');
    }

    function delete_post($id, $rdtype) {
        $this->db->where('id', $id);
        $this->db->delete('user_post');
        $this->db->where('post_id', $id);
        $this->db->delete('user_comment');
        $this->db->where('post_id', $id);
        $this->db->delete('user_post_like');
        if($rdtype=='up_post'){
             redirect('QueryHandler/user_post');
        }
        if($rdtype=='ap_post'){
             redirect('QueryHandler/post_approved_report');
        }
    }

    function post_approved_report() {
        //$query = " select concat(au.first_name,' ',au.last_name) as name,up.* from user_post as up join admin_users as au on up.user_id = au.id where up.status = 1 order by up.id desc";
        $query = "select concat(au.first_name,' ',au.last_name) as name,au.user_type,c.category_name as cat,up.* from user_post as up
join admin_users as au on up.user_id = au.id 
join category  as c on up.category_name = c.id 
where up.status = 1 order by up.id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/postApprovedReport', $data);
    }

    function user_post() {
        $query = " select concat(au.first_name,' ',au.last_name) as name,c.category_name as cat,up.* from user_post as up join admin_users as au on up.user_id = au.id join category  as c on up.category_name = c.id  where up.status = 0 order by up.id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/userPost', $data);
    }

    function add_video_post() {
       
        $dat = date('Y-m-d ');
        $tm = date('H:i:s');
        $datetime = $dat . ' ' . $tm;
        if (isset($_POST['submit'])) {


            $link = $this->input->post('link');

            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'category_name' => $this->input->post('category_name'),
                'description' => $this->input->post('description'),
                'link' => $link,
                'status' => 1,
                'op_date_time' => $datetime,
                'user_id' => $user_id);
            $this->db->insert('user_video_post', $post_data);
            redirect('QueryHandler/video_post_report');
        }
        $this->load->view('queryManager/addVideoPost');
    }

    function video_post_report() {
        $query = " select concat(au.first_name,' ',au.last_name) as name,c.category_name as cat, up.* from user_video_post as up join admin_users as au on up.user_id = au.id join category  as c on up.category_name = c.id  order by up.id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/VideoPostReport', $data);
    }

    function delete_comment($id, $post_id) {

        $this->db->where('id', $id);
        $this->db->delete('user_comment');

        redirect('QueryHandler/edit_post/' . $post_id);
    }
    
    function delete_video_post($id){
    
        $this->db->where('id', $id);
        $this->db->delete('user_video_post');
        redirect('QueryHandler/video_post_report');
    
    }



function post_comment_report() {
        //$query = " select concat(au.first_name,' ',au.last_name) as name,up.* from user_post as up join admin_users as au on up.user_id = au.id where up.status = 1 order by up.id desc";
        $query = "select uc.id as id,
uc.comment as comment, 
au.user_type,
up.category_name,
uc.file_name as filename,
uc.op_date_time as datetime,
au.first_name, au.last_name, au.email,
up.title
from user_comment as uc
left join admin_users as au on au.id  = uc.user_id
left join user_post as up on up.id  = uc.post_id
order by uc.id desc";
        $data['data'] = $this->Product_model->query_exe($query);
        $this->load->view('queryManager/postCommentReport', $data);
    }



}
