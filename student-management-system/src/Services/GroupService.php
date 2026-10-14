<?php

require_once __DIR__ . '/../Models/Group.php';
require_once __DIR__ . '/../Repositories/GroupRepository.php';

class GroupService
{
    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createGroup(int $id, string $name): bool
    {
        $group = new Group($id, $name);

        if (!$group->isValid()) {
            return false;
        }

        return $this->repository->add($group);
    }

    public function getAllGroups(): array
    {
        return $this->repository->getAll();
    }

    public function getGroupById(int $id): ?Group
    {
        return $this->repository->findById($id);
    }

    public function updateGroup(int $id, string $name): bool
    {
        $group = new Group($id, $name);

        if (!$group->isValid()) {
            return false;
        }

        return $this->repository->update($group);
    }

    public function deleteGroup(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function searchGroups(string $query): array
    {
        return $this->repository->search($query);
    }
}