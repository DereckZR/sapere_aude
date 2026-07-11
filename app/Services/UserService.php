<?php

namespace App\Services;

use App\DTOs\User\CreateUserDTO;
use App\DTOs\User\UpdateUserDTO;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use App\Helpers\NameHelper;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected MemberRepositoryInterface $memberRepository,
    ) {}

    public function getAll()
    {
        $users = $this->userRepository->getAll();

        $users->each(function ($user) {
            $user->full_name =
                $user->member->getFullNameAttribute();
            $user->role_name = $user->role->name;
        });

        return $users;
    }

    // TODO: preguntar si se puede mostrar los usuarios cuyo miembro también fue eliminado y restaurar este por ende
    public function getAllTrashed()
    {
        $users = $this->userRepository->getAllTrashed();
        $users->each(function ($user) {
            $user->full_name =
                $user->member->getFullNameAttribute();
            $user->role_name = $user->role->name;
        });

        return $users;
    }

    public function findById(int $id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(CreateUserDTO $dto)
    {
        $member = $this->memberRepository->findById($dto->member_id);

        $username = null;

        for ($i = 0; $i < 10; $i++) {
            $usernameValue = $this->generateUsername($member->first_name, $member->last_name, $member->document_number);

            $existsUsername = $this->userRepository->existsBy('username', $usernameValue);

            if (!$existsUsername) {
                $username = $usernameValue;
                break;
            }
        }

        if ($username === null) {
            throw new RuntimeException('No fue posible generar un nombre de usuario único, verifique que no exista otro usuario registrado para este miembro o vuelva a intentar.');
        }

        $hashedPassword = Hash::make($dto->password, ['rounds' => 12]);

        return $this->userRepository->create([
            'username' => $username,
            'member_id' => $dto->member_id,
            'role_id' => $dto->role_id,
            'password' => $hashedPassword,
        ]);
    }

    public function update(UpdateUserDTO $dto)
    {
        return $this->userRepository->update($dto);
    }

    public function delete(int $id)
    {
        $authUserId = Auth::id();

        if ($id === $authUserId) {
            throw new RuntimeException('No es posible eliminar a su propio usuario.');
        }

        return $this->userRepository->delete($id);
    }

    public function restore(int $id)
    {
        return $this->userRepository->restore($id);
    }

    private function generateUsername(string $firstName, string $lastName, string $documentNumber): string
    {
        $lastNameInitial = NameHelper::getSurnameInitial(Str::ascii($lastName));
        $initialLetters = strtoupper(substr(Str::ascii($firstName), 0, 1) . $lastNameInitial);

        $digitsDocumentNumber = substr($documentNumber, 0, 2);

        $number = random_int(100, 999);

        return "{$initialLetters}{$number}{$digitsDocumentNumber}";
    }
}
