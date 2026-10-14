<?php

require_once __DIR__ . '/../Models/Group.php';
require_once __DIR__ . '/../Interfaces/ManageableInterface.php';
require_once __DIR__ . '/../Interfaces/SearchableInterface.php';

class GroupRepository implements ManageableInterface, SearchableInterface
{
    private array $groups = [];

    public function __construct(array $groups = [])
    {
        foreach ($groups as $group) {
            if ($group instanceof Group && $group->isValid()) {
                $this->add($group);
            }
        }
    }

    public function add(object $item): bool
    {
        if (!$item instanceof Group || !$item->isValid()) {
            return false;
        }

        if ($this->findById($item->getGroupId()) !== null) {
            return false;
        }

        $this->groups[] = $item;

        return true;
    }

    public function getAll(): array
    {
        return $this->groups;
    }

    public function findById(int $id): ?Group
    {
        foreach ($this->groups as $group) {
            if ($group->getGroupId() === $id) {
                return $group;
            }
        }

        return null;
    }

    public function update(object $item): bool
    {
        if (!$item instanceof Group || !$item->isValid()) {
            return false;
        }

        foreach ($this->groups as $index => $existingGroup) {
            if ($existingGroup->getGroupId() === $item->getGroupId()) {
                $this->groups[$index] = $item;

                return true;
            }
        }

        return false;
    }

    public function delete(int $id): bool
    {
        foreach ($this->groups as $index => $group) {
            if ($group->getGroupId() === $id) {
                unset($this->groups[$index]);
                $this->groups = array_values($this->groups);

                return true;
            }
        }

        return false;
    }

    public function search(string $query): array
    {
        $results = [];
        $query = trim($query);

        foreach ($this->groups as $group) {
            if (
                stripos($group->getGroupName(), $query) !== false
                || (string) $group->getGroupId() === $query
            ) {
                $results[] = $group;
            }
        }

        return $results;
    }
}
