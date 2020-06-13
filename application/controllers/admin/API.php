<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $this->load->model("M_Auth");
    $this->load->model("M_Account");
    $this->load->model("M_Commodity");
    $this->load->model("M_Student");
  }

  public function account($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Account->secret_key ;
      $secret_iv = $this->M_Account->secret_iv ;

      if (strtolower($mode) == "data") {
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $query = $this->db->get("account");
          if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $value) {
              $data[$key]["account_id"] = encrypt_decrypt("encrypt", $value["account_id"], $secret_key, $secret_iv);
            }
            echo json_encode($data);
          } else {
            echo json_encode(false);
          }
        }
      } 
      
      elseif (strtolower($mode) == "update") {
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $post = $this->input->post();
          if ( !empty($post["id"]) && !empty($post["isactive"]) ) {
            $isactive = "true";
            if ($post["isactive"] == "true") {
              $isactive = "false";
            }
            $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
            $account = $this->db->get_where("account", array("account_id" => $id) )->row_array();
            if ($account["account_level"] != "root") {
              $this->db->where("account_id", $id);
              if($this->db->update("account", array("account_isactive"=>$isactive)) ){
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
                "message" => "Root user cannot be disabled",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
          echo json_encode($response);
        }
      }

      elseif (strtolower($mode) == "delete"){
        if ($sess["level"] != "root") {
          redirect(site_url("admin/dashboard/logout"),"refresh");
        } else {
          $post = $this->input->post();
          if (!empty($post["id"])) {
            $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
            $account = $this->M_Account->getById($id);
            if ($account != null){
              $oldpath = "./uploads/account/".$account["account_image"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              $this->db->where("account_id", $id);
              if($this->db->delete("account")){
                $response = array(
                  "status" => "success",
                  "message" => "Success delete data",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete data",
                );
              }
            } else {
              $response = array(
                "status" => "error",
                "message" => "Data not found!",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
          echo json_encode($response);
        }
      }

      elseif (strtolower($mode) == "delete-img"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $account = $this->M_Account->getById($id);
          if ($account != null){
            if ($account["account_image"] != "default.png") {
              $oldpath = "./uploads/account/".$account["account_image"];
              if (file_exists($oldpath)) {
                unlink($oldpath);
              }
              if ($this->db->update("account", array("account_image" => "default.png"))){
                $this->M_Auth->refreshSession($id);
                $response = array(
                  "status" => "success",
                  "message" => "Success delete image",
                );
              } else {
                $response = array(
                  "status" => "error",
                  "message" => "Failed delete image",
                );
              }
            } else {
              $response = array(
                "status" => "success",
                "message" => "Success delete image",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function commodity($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Commodity->secret_key ;
      $secret_iv = $this->M_Commodity->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("commodity");
        if ($query->num_rows() > 0) {
          $this->load->helper('currency_helper');
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["commodity_id"] = encrypt_decrypt("encrypt", $value["commodity_id"], $secret_key, $secret_iv);
            $data[$key]["commodity_price"] = rupiah($value["commodity_price"]);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $commodity = $this->M_Commodity->getById($id);
          if ($commodity != null){
            $this->db->where("commodity_id", $id);
            if($this->db->delete("commodity")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

  public function student($mode=null){
    $sess = $this->M_Auth->session(array("root","admin"));
    if ($sess === FALSE) {
      redirect(site_url("admin/dashboard/logout"),"refresh");
    } else {
      $secret_key = $this->M_Student->secret_key ;
      $secret_iv = $this->M_Student->secret_iv ;

      if (strtolower($mode) == "data") {
        $query = $this->db->get("student");
        if ($query->num_rows() > 0) {
          $data = $query->result_array();
          foreach ($data as $key => $value) {
            $data[$key]["student_id"] = encrypt_decrypt("encrypt", $value["student_id"], $secret_key, $secret_iv);
          }
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      } 

      elseif (strtolower($mode) == "delete"){
        $post = $this->input->post();
        if (!empty($post["id"])) {
          $id = encrypt_decrypt("decrypt", $post["id"], $secret_key, $secret_iv);
          $student = $this->M_Student->getById($id);
          if ($student != null){
            $this->db->where("student_id", $id);
            if($this->db->delete("student")){
              $response = array(
                "status" => "success",
                "message" => "Success delete data",
              );
            } else {
              $response = array(
                "status" => "error",
                "message" => "Failed delete data",
              );
            }
          } else {
            $response = array(
              "status" => "error",
              "message" => "Data not found!",
            );
          }
        } else {
          $response = array(
            "status" => "error",
            "message" => "Data not found!",
          );
        }
        echo json_encode($response);
      }
    }
  }

}
?>