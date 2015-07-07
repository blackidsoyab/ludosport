<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datatable extends CI_Controller
{
    
    var $aColumns;
    var $eColumns;
    var $sIndexColumn;
    var $sTable;
    var $rResult;
    var $output;
    var $myWhere;
    var $groupBy;
    var $sOrder;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function datatable_process() {
        
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " . mysql_real_escape_string($_GET['iDisplayLength']);
        }
        
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i]) ] == "true") {
                    if (stripos($this->aColumns[intval($_GET['iSortCol_' . $i]) ], "AS") > 0) {
                        $fiel_explode = explode(" AS ", $this->aColumns[intval($_GET['iSortCol_' . $i]) ]);
                        $sOrder.= $fiel_explode[0] . " " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                    } else $sOrder.= $this->aColumns[intval($_GET['iSortCol_' . $i]) ] . " " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        
        if (empty($sOrder) && !empty($this->sOrder)) {
            $sOrder = $this->sOrder;
        }
        
        $sWhere = $this->myWhere;
        if (isset($_GET['sSearch'])) {
            if ($_GET['sSearch'] != "") {
                $sWhere.= ($sWhere == "") ? " WHERE (" : " AND (";
                for ($i = 0; $i < count($this->aColumns); $i++) {
                    if ($_GET['bSearchable_' . $i] == "true") {
                        if (stripos($this->aColumns[$i], "AS") > 0) {
                            $fiel_explode = explode(" AS ", $this->aColumns[$i]);
                            $sWhere.= $fiel_explode[0] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                        } else {
                            $sWhere.= $this->aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                        }
                    }
                }
                $sWhere = substr_replace($sWhere, "", -3);
                $sWhere.= ')';
            }
        }
        
        /*
         * Group By
        */
        
        $sGroupBy = $this->groupBy;
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $this->aColumns)) . "," . str_replace(" , ", " ", implode(", ", $this->eColumns)) . " FROM   $this->sTable $sWhere $sGroupBy $sOrder $sLimit";
        $this->rResult = $this->db->query($sQuery);
        //echo $this->db->last_query();
        
        /*
         * Data set length after filtering
        */
        $iFilteredTotal = $this->rResult->num_rows();
        
        /*
         * Total data set length
        */
        
        $sQuery = "SELECT COUNT(" . $this->sIndexColumn . ") AS count FROM   $this->sTable $sWhere $sGroupBy ";
        if ($sGroupBy != null) {
            $rResultTotal = $this->db->query($sQuery);
            $iTotal = $rResultTotal->num_rows();
        } else {
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->row();
            $iTotal = $aResultTotal->count;
        }
        
        /*
         * Output
        */
        
        $this->output = array("sEcho" => intval(isset($_GET['sEcho']) ? $_GET['sEcho'] : 0), "iTotalRecords" => $iTotal, "iTotalDisplayRecords" => $iTotal,
         // $iFilteredTotal,
        "aaData" => array());
    }
    
    public function datatable_process_join() {
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " . mysql_real_escape_string($_GET['iDisplayLength']);
        }
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i]) ] == "true") {
                    
                    //                    $sOrder .= $this->aColumns[intval($_GET['iSortCol_' . $i])] . "
                    //                  " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                    $pos = stripos($this->aColumns[intval($_GET['iSortCol_' . $i]) ], "as");
                    if ($pos > 0) {
                        $column_name = explode(" ", $this->aColumns[intval($_GET['iSortCol_' . $i]) ]);
                        $sOrder.= $column_name[0] . "
                " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                    } else {
                        $sOrder.= $this->aColumns[intval($_GET['iSortCol_' . $i]) ] . "
                " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                    }
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        
        $sWhere = $this->myWhere;
        if ($_GET['sSearch'] != "") {
            $sWhere.= ($sWhere == "") ? " WHERE (" : " AND (";
            for ($i = 0; $i < count($this->aColumns); $i++) {
                
                /* if($_GET['bSearchable_' . $i] == "true")
                 { */
                $sWhere.= $this->aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
                
                /* } */
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere.= ')';
        }
        
        /*
         * Group By
        */
        $sGroupBy = $this->groupBy;
        
        $data = str_replace(" , ", " ", implode(", ", $this->aColumns)) . "," . str_replace(" , ", " ", implode(", ", $this->eColumns));
        $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . substr($data, 0, strlen($data) - 1) . " FROM   $this->sTable
        $sWhere
        $sGroupBy
        $sOrder
        $sLimit
        ";
        $this->rResult = $this->db->query($sQuery);
        
        //echo $this->db->last_query();
        /*
         * Data set length after filtering
        */
        $iFilteredTotal = $this->rResult->num_rows();
        
        /*
         * Total data set length
        */
        $sQuery = "
        SELECT COUNT(" . $this->sIndexColumn . ") AS count
        FROM   $this->sTable
        $sWhere
        $sGroupBy
        ";
        if ($sGroupBy != null) {
            $rResultTotal = $this->db->query($sQuery);
            $iTotal = $rResultTotal->num_rows();
        } else {
            $rResultTotal = $this->db->query($sQuery);
            $aResultTotal = $rResultTotal->row();
            $iTotal = $aResultTotal->count;
        }
        
        /*
         * Output
        */
        $this->output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $iTotal, "iTotalDisplayRecords" => $iTotal,
         // $iFilteredTotal,
        "aaData" => array());
    }
}
