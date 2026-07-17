<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\DTOs\Transaction\CreateTransactionDTO;
use App\DTOs\Transaction\UpdateTransactionDTO;
use App\Http\Requests\transaction\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $service) {}

    public function index()
    {
        return view('admin.transactions.index');
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    // public function getAllForSelect()
    // {
    //     return response()->json($this->service->getAllForSelect());
    // }

    public function getAllTrashed()
    {
        return response()->json($this->service->getAllTrashed());
    }

    public function findById(int $id)
    {
        return response()->json($this->service->findById($id));
    }

    public function store(StoreTransactionRequest $request)
    {
        $data = $request->all();
        $dto = new CreateTransactionDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(Request $request, int $id)
    {
        throw new \Exception('Cannot update transaction.');

        $data = $request->all();
        $data['id'] = $id;
        $dto = new UpdateTransactionDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Transaction deleted successfully.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Transaction restored successfully.']);
    }
}
