<?php
interface ManageableInterface{
    public function add(Student $student): bool;
    public function findById(int $id): ?Student;
    public function update(Student $student): bool;
    public function delete(int $id): bool;
}