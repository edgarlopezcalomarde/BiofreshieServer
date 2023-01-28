<?php
namespace Ciri\services;

use Illuminate\Http\Request;
use Ciri\DTO\CarritoDTO;

interface ICarritoService {
    public function all(): array;
    public function find($id): CarritoDTO;
    public function findByUser($id): array;
    public function insert(Request $request):bool;
    public function update(Request $request, $id):array;
    public function delete($id):bool;
}
