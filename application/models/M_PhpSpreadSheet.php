<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
  private $startRow = 0;
  private $endRow   = 0;
  private $columns  = [];

  /**  Get the list of rows and columns to read  */
  public function __construct($startRow, $endRow, $columns) {
      $this->startRow = $startRow;
      $this->endRow   = $endRow;
      $this->columns  = $columns;
  }

  public function readCell($column, $row, $worksheetName = '') {
      //  Only read the rows and columns that were configured
      if ($row >= $this->startRow && $row <= $this->endRow) {
          if (in_array($column,$this->columns)) {
              return true;
          }
      }
      return false;
  }
}

class M_PhpSpreadSheet extends CI_Model {  
  public function __construct(){
    parent::__construct();
  }

  public function uploadFileExcel($filename, $oldpath=null, $name="_file_"){
    if (isset($_FILES[$name]['name'])) {
      if( file_exists($_FILES[$name]['tmp_name']) ){
        $config['upload_path']          = './uploads/file/';
        $config['allowed_types']        = 'xlsx|csv|xls';
        $config['max_size']             = 1024; // 1MB
        $config['overwrite']            = TRUE;
        $config['file_name']            = $filename;
        // $config['encrypt_name']         = TRUE;
        // $config['remove_spaces']		    = TRUE;
    
        $this->load->library("upload", $config);
        if ( ! $this->upload->do_upload($name)){
          $response = array(
            "status" => "error",
            "message" => $this->upload->display_errors()
          );
        }else{
          if ($oldpath != null) {
            if (file_exists($oldpath)) {
              unlink($oldpath);
            }
          }
  
          $response = array(
            "status" => "success",
            "message" => "Image uploaded successfully.",
            "data" => $this->upload->data()
          );
        }
  
      } else {
        $response = array(
          "status" => "empty",
          "message" => "Choose file to upload."
        );
      }
    } else {
      $response = array(
        "status" => "empty",
        "message" => "Choose file to upload."
      );
    }

    return $response;
  }

  public function readFileExcel($path, $startRow, $endRow=null, $columns, $name="_file_"){
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(in_array(mime_content_type($path), $file_mimes)) {

      $inputFileType = IOFactory::identify($path);
      $reader = IOFactory::createReader($inputFileType);
      $reader->setReadDataOnly(true); 
      $reader->setReadEmptyCells(false);
      
      if ($endRow == null) {
        $endRow = $reader->load($path)->getActiveSheet()->getHighestRow();
      }

      $filterSubset = new MyReadFilter($startRow, $endRow, $columns);
      $reader->setReadFilter($filterSubset);
      $spreadsheet = $reader->load($path);
       
      $sheetData = $spreadsheet->getActiveSheet()->toArray();
      $response = array(
        "status" => "success",
        "message" => "Success read file excel",
        "mime" => mime_content_type($path),
        "data" => $sheetData
      );
      
    } else {
      $response = array(
        "status" => "error",
        "message" => "Mime type not allowed",
        "mime" => mime_content_type($path)
      );
    }
    return $response;
  }
  
  public function checkFormat($pathformat, $startRow, $endRow, $columns, $name="_file_"){
    // Compare two files to check the data format (format file vs input file)
    if (isset($_FILES[$name]["name"]) ) {
      $format = $this->readFileExcel($pathformat, $startRow, $endRow, $columns);
      $input = $this->readFileExcel($_FILES[$name]["tmp_name"], $startRow, $endRow, $columns);

      $check = array();
      for ($i=0; $i < $endRow; $i++) { 
        $ck = empty(array_diff($input["data"][$i], $format["data"][$i]));
        array_push($check, $ck);
      }

      if (in_array(false, $check, true) === false) {
        $sheet = $this->readFileExcel($_FILES[$name]["tmp_name"], $endRow+1, null, $columns);
        $success = array();
        $failed = array();
        foreach ($sheet["data"] as $key => $col) {
          if ($key < $endRow) { //lompati data baris ke 1-2 karena digunakan sebagai judul
            continue;
          } else {
            $checkallcolumn = TRUE;
            foreach ($col as $key => $data) {
              if (in_array($data, array("", null), true)) {
                $addresponse = array(
                  "status" => "error",
                  "message" => "Failed data",
                  "column" =>  $col,
                );
                array_push($failed, $col);
                $checkallcolumn = FALSE;
                break;
              }
            } 
            if ($checkallcolumn) {
              $addresponse = array(
                "status" => "success",
                "message" => "Success data",
                "column" =>  $col,
              );
              array_push($success, $addresponse);
            }
          }
        }

        if (!empty($failed)) {
          $response = array(
            "status" => "error",
            "message" => "Acceptable format but Incomplete data<br>There are ".count($failed)." incomplete data, please complete the data!",
            "total" => count($failed),
            "faileddata" => $failed,
            "sheet" => $sheet["data"],
          );
        } else {
          $response = array(
            "status" => "success",
            "message" => "Acceptable format & Complete data",
            "total" => count($success),
            "successdata" => $success,
            "sheet" => $sheet["data"],
          );
        }


      } else {
        $response = array(
          "status" => "error",
          "message" => "Unacceptable format<br>Please use the available format",
        );
      }
    } else {
      $response = array(
        "status" => "empty",
        "message" => "Choose file to upload."
      );
    }
    return $response;
  }

  public function creatSpreadSheet()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');

		$writer = IOFactory::createWriter($spreadsheet, "Xlsx");		
		$filename = 'simple';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

}
?>