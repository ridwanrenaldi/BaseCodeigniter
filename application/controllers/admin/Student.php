<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Student");
    $this->load->model("M_PhpSpreadSheet");
  }

	public function table(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "student-table";
      $this->load->view('admin/student/table.php', $data);
    }
  }
  
  public function add(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "student-add";

      $this->form_validation->set_rules($this->M_Student->rules());
      if ($this->form_validation->run() === TRUE) {
        $this->session->set_flashdata("notif", $this->M_Student->insert());
        redirect(site_url("admin/student/add"),"refresh");
      } else {
        $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
        if ($this->session->flashdata("notif")) {
          $data["notif"] = $this->session->flashdata("notif");
        }
        $this->load->view('admin/student/add.php', $data);
      }
    }
  }

  public function addfile(){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $data["session"] = $sess;
      $data["sidebar"] = "student-add";

      
      
      $format = $this->M_PhpSpreadSheet->checkFormat("./uploads/file/format_student.xlsx", 1, 2, range('A','H'));
      if ($format["status"] == "success") {
        $uploadfile = $this->M_PhpSpreadSheet->uploadFileExcel("student_data");
        if ($uploadfile["status"] == "success") {
          $import = $this->M_Student->insertFromExcel($format["sheet"], 3);
          $this->session->set_flashdata("notif", $format);
          redirect(site_url("admin/student/addfile"),"refresh");
        } else {
          $this->session->set_flashdata("notif", $uploadfile);
          redirect(site_url("admin/student/addfile"),"refresh");
        }
      } else {
        $data["notif"] = $format;
      }

      if ($this->session->flashdata("notif")) {
        $data["notif"] = $this->session->flashdata("notif");
      }
      $this->load->view('admin/student/addfile.php', $data);
    }
  }
  
  public function edit($encrypt_id=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      if ($encrypt_id != null) {
        $data["session"] = $sess;
        $data["sidebar"] = NULL;
        $data["encrypt_id"] = $encrypt_id;

        $secret_key = $this->M_Student->secret_key ;
        $secret_iv = $this->M_Student->secret_iv ;
        $student_id = encrypt_decrypt("decrypt", $encrypt_id, $secret_key, $secret_iv);
        $data["student"] = $this->M_Student->getById($student_id);

        if ($data["student"] == null) {
          redirect(site_url("admin/student/table"),"refresh");
        } else {
          $this->form_validation->set_rules($this->M_Student->rules());
          if ($this->form_validation->run() === TRUE) {
            $this->session->set_flashdata("notif", $this->M_Student->update($student_id));
            redirect(site_url("admin/student/edit/$encrypt_id"),"refresh");
          } else {
            $data["notif"] = array("status" => "error", "message" => str_replace("\n", "", validation_errors('<li>','</li>')));
            if ($this->session->flashdata("notif")) {
              $data["notif"] = $this->session->flashdata("notif");
            }
            $this->load->view('admin/student/edit.php', $data);
          }
        }
      } else {
        redirect(site_url("admin/student/table"),"refresh");
      }
    }
  }
}
