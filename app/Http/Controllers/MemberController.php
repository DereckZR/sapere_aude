<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Services\CycleService;
use App\DTOs\Member\CreateMemberDTO;
use App\DTOs\Member\UpdateMemberDTO;
use App\Http\Requests\member\StoreMemberRequest;
use App\Http\Requests\member\UpdateMemberRequest;

class MemberController extends Controller
{
    public function __construct(
        protected MemberService $service,
        protected CycleService $cycleService
    ) {}

    public function index()
    {
        return view('admin.members.index');
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

    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();
        $dto = new CreateMemberDTO($data);
        return response()->json($this->service->create($dto));
    }

    public function update(UpdateMemberRequest $request, int $id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $dto = new UpdateMemberDTO($data);
        return response()->json($this->service->update($dto));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Miembro eliminado correctamente.']);
    }

    public function restore(int $id)
    {
        $this->service->restore($id);
        return response()->json(['message' => 'Miembro restaurado correctamente.']);
    }
}
