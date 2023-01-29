<?php
namespace Ciri\DAO;

use Ciri\DTO\CarritoDTO;
use Illuminate\Http\Request;

interface ICarritosDAO{
    public function read():array;
    public function findById(string $id): CarritoDTO;
    public function findByUser(string $id): array;
    public function delete(string $id): bool;
    public function create(Request $request): bool;
    public function update(Request $request, $id ): array;
}
