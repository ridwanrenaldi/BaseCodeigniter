<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Student extends CI_Model {
  private $table = "student"; // table in database
  public $secret_key = "StudentKey" ; // random character
  public $secret_iv = "StudentIV"; // random character
  
  public function __construct(){
      parent::__construct();
  }

  public function rules(){
    return array(
      array(  'field' => '_number_',
              'label' => 'Number',
              'rules' => 'required|trim|min_length[10]|max_length[10]'),

      array(  'field' => '_name_',
              'label' => 'Name',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_gender_',
              'label' => 'Gender',
              'rules' => 'required|trim|alpha_numeric_spaces|in_list[Male,Female]'),

      array(  'field' => '_bornin_',
              'label' => 'Born In',
              'rules' => 'required|trim'),

      array(  'field' => '_address_',
              'label' => 'Address',
              'rules' => 'required|trim|min_length[2]|max_length[50]'),

      array(  'field' => '_majors_',
              'label' => 'Majors',
              'rules' => 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[50]'),

      array(  'field' => '_email_',
              'label' => 'Email',
              'rules' => 'required|trim|valid_email|is_unique[student.student_email]'),
    );
  }

  public function getById($id){
    return $this->db->get_where($this->table, array("student_id" => $id) )->row_array();
  }

  public function getAll($fields=null) {
    if($fields != null){
      $this->db->select($fields);
    }

    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

  public function insert(){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "student_id"      => NULL,
        "student_number"  => htmlspecialchars($post["_number_"]),
        "student_name"    => htmlspecialchars($post["_name_"]),
        "student_gender"  => htmlspecialchars($post["_gender_"]),
        "student_bornin"  => htmlspecialchars($post["_bornin_"]),
        "student_address" => htmlspecialchars($post["_address_"]),
        "student_majors"  => htmlspecialchars($post["_majors_"]),
        "student_email"   => htmlspecialchars($post["_email_"])
      );

      $data = $this->security->xss_clean($data);
      if($this->db->insert($this->table, $data)){
        $response = array(
          "status" => "success",
          "message" => "Success insert data",
        );
      } else {
        $response = array(
          "status" => "error",
          "message" => "Failed insert data",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;
  }

  public function insertFromExcel($dataexcel, $startRow){
    //$startRow = data starts in line to - $startRow
    if (!empty($dataexcel)){
      $success = array();
      $failed = array();
      foreach ($dataexcel as $key => $col) {
        if ($key < ($startRow-1)) { // read data starting from the line - $starRow (skip row 1 until $starRow-1)
          continue;
        } else {
          $data = array(
            "student_id"      => NULL,
            "student_number"  => ($col[1] == null)? "" : $col[1],
            "student_name"    => ($col[2] == null)? "" : $col[2],
            "student_gender"  => ($col[3] == null)? "" : $col[3],
            "student_bornin"  => ($col[4] == null)? "" : $col[4],
            "student_address" => ($col[5] == null)? "" : $col[5],
            "student_majors"  => ($col[6] == null)? "" : $col[6],
            "student_email"   => ($col[7] == null)? "" : $col[7],
          );
  
          $data = $this->security->xss_clean($data);
          if($this->db->insert($this->table, $data)){
            $addresponse = array(
              "status" => "success",
              "message" => "Success insert data",
              "Nomor" =>  $dataexcel[0],
            );
            array_push($success, $addresponse);
          } else {
            $addresponse = array(
              "status" => "error",
              "message" => $this->db->error(),
              "Nomor" =>  $dataexcel[0],
              "query" => $this->db->last_query(),
            );
            array_push($failed, $addresponse);
          }
        }
      }

      $response = array(
        "status" => "success",
        "message" => "Final result! <br>Success = ". count($success)."<br>Failed = ".count($failed),
        // "success" => $success,
        // "failed" => $failed,
      );

    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;

  }

  public function update($id){
    $post = $this->input->post();
    if (!empty($post)){
      $data = array(
        "student_number"  => htmlspecialchars($post["_number_"]),
        "student_name"    => htmlspecialchars($post["_name_"]),
        "student_gender"  => htmlspecialchars($post["_gender_"]),
        "student_bornin"  => htmlspecialchars($post["_bornin_"]),
        "student_address" => htmlspecialchars($post["_address_"]),
        "student_majors"  => htmlspecialchars($post["_majors_"]),
        "student_email"   => htmlspecialchars($post["_email_"])
      );

      $data = $this->security->xss_clean($data);
      $this->db->where("student_id", $id);
      if($this->db->update($this->table, $data)){
        $response = array(
          "status" => "success",
          "message" => "Success update data",
        );
      } else {
        $response = array(
          "status" => "error",
          "message" => "Failed update data",
        );
      }
    } else {
      $response = array(
        "status" => "error",
        "message" => "Data not found!",
      );
    }
    return $response;
  }

}
?>