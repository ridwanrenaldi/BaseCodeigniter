<?php
// ===============================================================
// BaseCodeigniter
// Author : Ridwan Renaldi (RID1)
// Date Created : 10/05/2020
// License : freely distributed/modified with credit attribution.
// Contact Me : @rid1bdbx (instagram)
// ===============================================================
defined('BASEPATH') OR exit('No direct script access allowed');
use \PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

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

?>