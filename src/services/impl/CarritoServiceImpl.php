<?php
namespace Ciri\services\impl;

use Ciri\DAO\ICarritosDAO;
use Ciri\DAO\impl\CarritosDAO;
use Ciri\DTO\CarritoDTO;
use Ciri\services\ICarritoService;
use Illuminate\Http\Request;

class CarritoServiceImpl implements ICarritoService{

    private ICarritosDAO $carritos;

    function __construct()
    {
        $this->carritos = new CarritosDAO();
    }

    public function all(): array{
        return $this->carritos->read();
    }

    public function find($id): CarritoDTO
    {
        return $this->carritos->findById($id);
    }

    public function findByUser($id): array
    {
        return $this->carritos->findByUser($id);
    }

    public function insert(Request $request): bool
    {
        return $this->carritos->create($request);
    }

    public function update(Request $request, $id): array
    {
        return $this->carritos->update($request, $id);

    }

    public function delete($id): bool
    {
        return $this->carritos->delete($id);
    }

}
