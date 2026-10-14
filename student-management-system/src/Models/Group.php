<?php

class Group
{
    private int $group_id;
    private string $group_name;

    public function __construct(int $group_id, string $group_name)
    {
        $group_name = trim($group_name);

        if ($group_id <= 0) {
            echo "Guruh ID si noto'g'ri" . PHP_EOL;
            return;
        }

        if (!$this->validateName($group_name)) {
            echo "Guruh nomi bo'sh bo'lishi mumkin emas" . PHP_EOL;
            return;
        }

        $this->group_id = $group_id;
        $this->group_name = $group_name;
    }

    public function getGroupId(): int
    {
        return $this->group_id;
    }

    public function getGroupName(): string
    {
        return $this->group_name;
    }

    public function setGroupName(string $group_name): bool
    {
        $group_name = trim($group_name);

        if (!$this->validateName($group_name)) {
            echo "Guruh nomi bo'sh bo'lishi mumkin emas" . PHP_EOL;
            return false;
        }

        $this->group_name = $group_name;
        return true;
    }

    private function validateName(string $group_name): bool
    {
        return $group_name !== '';
    }

    public function isValid(): bool
    {
        return isset($this->group_id, $this->group_name)
            && $this->group_id > 0
            && $this->validateName($this->group_name);
    }
}