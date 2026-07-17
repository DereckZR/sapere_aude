<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\DTOs\Product\CreateProductDTO;
use App\DTOs\Product\UpdateProductDTO;
use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    public function index()
    {
        return view('admin.products.index');
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function getAllTrashed()
    {
        return response()->json($this->service->getAllTrashed());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $dto = new CreateProductDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $dto = new UpdateProductDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Product restored successfully.']);
    }
}
