<?php
/**
 * Class studentModel
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
require_once 'models/dbModel.php';

class studentModel {
    /**
     * studentModel constructor.
     */
    public function __construct()
    {
        $this->dbModel = new dbModel();
    }

    /**
     * Get Student Details
     * @return array
     */
    public function getStudents()
    {
        try {
            $sql = "SELECT * FROM student";
            $studentArr = $this->dbModel->fetchResult($sql);
            if (is_array($studentArr) && count($studentArr) > 0) {
                foreach ($studentArr as $key=>$student) {
                    $sql = "SELECT s.subject 
                            FROM student_subject AS ss 
                            LEFT JOIN subject AS s ON ss.subject_id = s.subject_id 
                            WHERE student_id = " . $student['student_id'] . " ";
                    $stdSubjectArr = $this->dbModel->fetchResult($sql);

                    if (is_array($stdSubjectArr) && count($stdSubjectArr) > 0) {
                        $subjects = '';
                        foreach ($stdSubjectArr as $subject) {
                            $subjects[] = $subject['subject'];
                        }

                        $studentArr[$key]['subjects'] = implode(", ", $subjects);
                    } else {
                        $studentArr[$key]['subjects'] = '';
                    }
                }
            }
        } catch (Exception $e) {
            exit('Could not retrieve student data');
        }

        return $studentArr;
    }

    /**
     * Get Subjects
     * @return array
     */
    public function getSubjects()
    {
        try {
            $sql = "SELECT * 
                    FROM subject";
            $subjects = $this->dbModel->fetchResult($sql);
        } catch (Exception $e){
            exit("Could not retrieve subject data.");
        }

        return $subjects;
    }

    /**
     * Save Student
     * @param $postArr
     * @return bool|mysqli_result
     */
    public function saveStudent($postArr)
    {
        try {
            $studentSql = "INSERT INTO student(first_name, last_name) VALUES ('" . $postArr['firstname'] . "', '" . $postArr['lastname'] . "')";
            $result = $this->dbModel->execQuery($studentSql);
            $maxStudentId = $this->dbModel->insertId();
            if ($result) {
                foreach ($postArr['subjects'] as $subject) {
                    $stSubSql = "INSERT INTO student_subject(subject_id, student_id) VALUES ('" . $subject . "', '" . $maxStudentId . "')";
                    $result = $this->dbModel->execQuery($stSubSql);
                }
            }
        } catch (Exception $e){
            exit("Could not save student data. Please check and try again");
        }

        return $result;
    }
}
?>