<?php
class SubjectRepository{
    private array $subjects;
    public function __construct(array $subjects){
        $this->$subjects = $subjects;
    }
    public function add(){}
    public function findById(){}
    public function getAll(){}
    public function update(){}
    public function delete(){}
    public function findByStudentId(){}
    public function findBySubjectId(){}
}