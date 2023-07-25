<?php defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_form_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->post()) {
            $this->process_submission();
        }

        $data['forms'] = $this->Custom_form_model->get_all_forms_with_fields();
        $this->load->view('form_view', $data);
    }

    public function create_form()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('form_data[question][]', 'Question', 'required');
            $this->form_validation->set_rules('form_data[type][]', 'Type', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('create_form');
            } else {
                $formData = $this->input->post('form_data');

                $data = [];
                $fid = time();
                foreach ($formData['question'] as $index => $question) {
                    $data[] = [
                        'form_id' => $fid,
                        'question' => $question,
                        'type' => $formData['type'][$index],
                        'options' => ($formData['type'][$index] === 'dropdown' || $formData['type'][$index] === 'radio' || $formData['type'][$index] === 'checkbox') ? $formData['options'][$index] : null,
                        'is_required' => $formData['is_required'][$index] ? $formData['is_required'][$index] : 0
                    ];
                }

                $this->Custom_form_model->create_form_batch($data);
                redirect('form/submit/' . $fid);
            }
        } else {
            $this->load->view('create_form');
        }
    }

    public function submit($form_id)
    {
        if ($this->input->post()) {
            $this->process_submission();
        }

        $data['form'] = $this->Custom_form_model->get_form_by_id($form_id);
        $this->load->view('form_submit', $data);
    }

    private function process_submission()
    {
        $form_data = $this->input->post('form_data');
        $form_id = $this->input->post('form_id');
        $responses = [];

        foreach ($form_data['question_id'] as $que_id => $question) {
            $res = $form_data['response'][$que_id];
            if (gettype($form_data['response'][$que_id]) == 'array') {
                $res = implode(',', $form_data['response'][$que_id]);
            }

            $responses[] = [
                'form_id' => $form_id,
                'question_id' => $que_id,
                'response' => $res
            ];
        }

        $this->Custom_form_model->submit_response_batch($responses);
        redirect('form');
    }
}
