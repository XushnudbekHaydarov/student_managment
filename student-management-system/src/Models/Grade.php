<?php


class Grade extends Student {

    private int $score;
    public function __construct(int $student_id, int $subject_id,int $score){
        $this->student_id = $student_id;
        $this->$subject_id = $subject_id;

        $this->score = $score;
    }
    public function getScore(): int
    {
        return $this->score;
    }
    public function setScore(int $score): void{
        $this->score = $score;
    }
    public function isValid($score):int
    {
        if(0==$score<=100){
            return true;
        }
        return false;
    }
}

