<?php

require_once __DIR__ . '/../Models/Subject.php';
require_once __DIR__ . '/../Interfaces/ManageableInterface.php';
require_once __DIR__ . '/../Interfaces/SearchableInterface.php';

class SubjectRepository implements ManageableInterface, SearchableInterface
{
    private array $subjects = [];

    public function __construct(array $subjects = [])
    {
        $this->subjects = $subjects;
    }

    public function getAll(): array
    {
        return $this->subjects;
    }

    public function add(object $item): bool
    {
        if (!$item instanceof Subject || !$item->isValid()) {
            echo "Fan ma'lumotlari noto'g'ri" . PHP_EOL;
            return false;
        }

        if ($this->findById($item->getSubjectId()) !== null) {
            echo "Bu ID bilan fan allaqachon mavjud" . PHP_EOL;
            return false;
        }

        $this->subjects[] = $item;

        return true;
    }

    public function findById(int $id): ?object
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getSubjectId() === $id) {
                return $subject;
            }
        }

        return null;
    }

    public function update(object $item): bool
    {
        if (!$item instanceof Subject || !$item->isValid()) {
            echo "Fan ma'lumotlari noto'g'ri" . PHP_EOL;
            return false;
        }

        foreach ($this->subjects as $index => $subject) {
            if ($subject->getSubjectId() === $item->getSubjectId()) {
                $this->subjects[$index] = $item;
                return true;
            }
        }

        echo "Yangilanadigan fan topilmadi" . PHP_EOL;
        return false;
    }

    public function delete(int $id): bool
    {
        foreach ($this->subjects as $index => $subject) {
            if ($subject->getSubjectId() === $id) {
                unset($this->subjects[$index]);
                $this->subjects = array_values($this->subjects);

                return true;
            }
        }

        echo "O'chiriladigan fan topilmadi" . PHP_EOL;
        return false;
    }

    public function search(string $query): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            if (
                stripos($subject->getSubjectName(), trim($query)) !== false ||
                (string) $subject->getSubjectId() === trim($query)
            ) {
                $results[] = $subject;
            }
        }

        return $results;
    }
}
