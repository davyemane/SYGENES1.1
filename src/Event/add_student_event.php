<?php
namespace App\Event;

use App\Entity\Student;

class AddStudentEvent
{
    const ADD_STUDENT_EVENT = 'create_student_account';

    public function __construct(private Student $student)
    {
        
    }


    public function getStudent(): Student
    {
        return $this->student;
    }
}