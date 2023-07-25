<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CUSTOM_FORM_MODEL extends CI_Model
{
    public function get_all_forms_with_fields()
    {
        return $this->db->get('forms')->result();
    }

    public function create_form_batch($data)
    {
        $this->db->insert_batch('forms', $data);
        return $this->db->insert_id(); // Return the last inserted form_id
    }

    public function submit_response_batch($data)
    {
        $this->db->insert_batch('responses', $data);
    }

    public function get_form_by_id($form_id)
    {
        return $this->db->where('form_id', $form_id)->get('forms')->result();
    }
}