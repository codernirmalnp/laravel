<?php
namespace App\Contracts;
interface BaseContract{
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function all($columns=array('*'),string $orderby='id',string $sortBy='desc');
    public function find(int $id);
    public function findOneOrFail(int $id);
    public function findBy(array $data);
    public function findOneBy(array $data);
    public function findOneByOrFail(array $data);
    public function delete(int $id);
}