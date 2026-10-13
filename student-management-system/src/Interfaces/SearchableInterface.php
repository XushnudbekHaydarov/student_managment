<?php
interface SearchableInterface
{
    public function search(string $query) : array;

}