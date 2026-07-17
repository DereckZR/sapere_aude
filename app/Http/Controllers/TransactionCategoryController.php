<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionCategoryService;
use App\DTOs\TransactionCategory\CreateTransactionCategoryDTO;
use App\DTOs\TransactionCategory\UpdateTransactionCategoryDTO;
use App\Http\Requests\transactionCategory\StoreTransactionCategoryRequest;
use App\Http\Requests\transactionCategory\UpdateTransactionCategoryRequest;

class TransactionCategoryController extends Controller
{
    public function __construct(protected TransactionCategoryService $service) {}

    public function index()
    {
        return view('admin.transactionCategories.index');
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function getAllForSelect()
    {
        return response()->json($this->service->getAllForSelect());
    }

    public function getAllTrashed()
    {
        return response()->json($this->service->getAllTrashed());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(StoreTransactionCategoryRequest $request)
    {
        $data = $request->all();
        $dto = new CreateTransactionCategoryDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(UpdateTransactionCategoryRequest $request, int $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $dto = new UpdateTransactionCategoryDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'TransactionCategory deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'TransactionCategory restored successfully.']);
    }
}
