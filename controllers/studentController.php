<?php
/**
 * Class studentController
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class studentController {
    /**
     * studentController constructor.
     */
    public function __construct()
    {
        $this->load = new Load();
        $this->studentModel = new studentModel();
    }

    /**
     * index action
     */
    public function indexAction() {
        $errorMsg = false;
        $successMsg = false;

        if(isset($_SESSION['error_msg'])) {
            $errorMsg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        if(isset($_SESSION['success_msg'])) {
            $successMsg = $_SESSION['success_msg'];
            unset($_SESSION['success_msg']);
        }

        $vars['subjects'] = $this->studentModel->getSubjects();
        $vars['students'] = $this->studentModel->getStudents();
        $vars['errorMsg'] = $errorMsg;
        $vars['successMsg'] = $successMsg;

        $this->load->view('student', $vars);
    }

    /**
     * save action
     */
    public function saveAction() {
        if(isset($_POST)) {
            if ($_POST['firstname'] != '' && $_POST['lastname'] != '' && isset($_POST['subjects']) && count($_POST['subjects'])  > 0){
                $saveStudent = $this->studentModel->saveStudent($_POST);
                if($saveStudent == 1)
                {
                    $_SESSION['success_msg'] = "Student data successfully saved";
                } else {
                    $_SESSION['error_msg'] = "Unable to save student data. Please try again.";
                }

            } else {
                $_SESSION['error_msg'] = "Please fill all the fields.";
            }
        }

        header("Location: " . BASE_URL, true);
    }
}
