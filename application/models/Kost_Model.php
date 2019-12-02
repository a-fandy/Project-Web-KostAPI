<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Kost_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * Get kost by idKost
     */
    function get_kost($idKost)
    {
        return $this->db->get_where('kost',array('idKost'=>$idKost))->row_array();
    }
        
    /*
     * Get all kost
     */
    function get_all_kost()
    {
        $this->db->order_by('idKost', 'desc');
        return $this->db->get('kost')->result_array();
    }
        
    /*
     * function to add new kost
     */
    function add_kost($params)
    {
        $this->db->insert('kost',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update kost
     */
    function update_kost($idKost,$params)
    {
        $this->db->where('idKost',$idKost);
        return $this->db->update('kost',$params);
    }
    
    /*
     * function to delete kost
     */
    function delete_kost($idKost)
    {
        return $this->db->delete('kost',array('idKost'=>$idKost));
    }
}
