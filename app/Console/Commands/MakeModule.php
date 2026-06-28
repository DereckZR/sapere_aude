<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create full module (Controller, Service, Repository, DTO)';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $this->createDirectories($name);

        $this->createController($name);
        $this->createService($name);
        $this->createRepository($name);
        $this->createInterface($name);
        $this->createDTO($name);
        $this->updateDTO($name);

        $this->registerBinding($name);

        $this->info("Module {$name} created successfully");
    }

    private function createDirectories(string $name)
    {
        $dirs = [
            app_path('Services'),
            app_path('Repositories'),
            app_path('Repositories/Interfaces'),
            app_path("DTOs/{$name}"),
        ];

        foreach ($dirs as $dir) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
        }
    }

    private function createController(string $name)
    {
        $path = app_path("Http/Controllers/{$name}Controller.php");

        $content = "<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\\{$name}Service;
use App\DTOs\\{$name}\\Create{$name}DTO;
use App\DTOs\\{$name}\\Update{$name}DTO;

class {$name}Controller extends Controller
{
    public function __construct(protected {$name}Service \$service) {}

    public function index()
    {
        // Implement index method if needed
    }

    public function getAll()
    {
        return response()->json(\$this->service->getAll());
    }

    public function getAllTrashed()
    {
        return response()->json(\$this->service->getAllTrashed());
    }

    public function findById(int \$id)
    {
        return response()->json(\$this->service->findById(\$id));
    }

    public function store(Request \$request)
    {
        \$data = \$request->all();
        \$dto = new Create{$name}DTO(\$data);
        return response()->json(\$this->service->create(\$dto));
    }

    public function update(Request \$request, int \$id)
    {
        \$data = \$request->all();
        \$data['id'] = \$id;
        \$dto = new Update{$name}DTO(\$data);
        return response()->json(\$this->service->update(\$dto));
    }

    public function delete(int \$id)
    {
        \$this->service->delete(\$id);
        return response()->json(['message' => '{$name} deleted successfully.']);
    }

    public function restore(int \$id)
    {
        \$this->service->restore(\$id);
        return response()->json(['message' => '{$name} restored successfully.']);
    }
}";

        File::put($path, $content);
    }

    private function createService(string $name)
    {
        $path = app_path("Services/{$name}Service.php");

        $content = "<?php

namespace App\Services;

use App\DTOs\\{$name}\\Create{$name}DTO;
use App\DTOs\\{$name}\\Update{$name}DTO;
use App\Repositories\Interfaces\\{$name}RepositoryInterface;

class {$name}Service
{
    public function __construct(protected {$name}RepositoryInterface \$repository) {}

    public function getAll()
    {
        return \$this->repository->getAll();
    }

    public function getAllTrashed()
    {
        return  \$this->repository->getAllTrashed();
    }

    public function findById(int \$id)
    {
        return \$this->repository->findById(\$id);
    }

    public function create(Create{$name}DTO \$dto)
    {
        return \$this->repository->create(\$dto);
    }

    public function update(Update{$name}DTO \$dto)
    {
        return \$this->repository->update(\$dto);
    }

    public function delete(int \$id)
    {
        return \$this->repository->delete(\$id);
    }

    public function restore(int \$id)
    {
        return \$this->repository->restore(\$id);
    }
}";

        File::put($path, $content);
    }

    private function createRepository(string $name)
    {
        $path = app_path("Repositories/{$name}Repository.php");

        $content = "<?php

namespace App\Repositories;

use App\Models\\{$name};
use App\DTOs\\{$name}\\Create{$name}DTO;
use App\DTOs\\{$name}\\Update{$name}DTO;
use App\Repositories\Interfaces\\{$name}RepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    public function getAll()
    {
        return {$name}::all();
    }

    public function getAllTrashed()
    {
        return {$name}::withTrashed()->get();
    }

    public function findById(int \$id)
    {
        return {$name}::findOrFail(\$id);
    }

    public function create(Create{$name}DTO \$dto)
    {
        return {$name}::create((array) \$dto);
    }

    public function update(Update{$name}DTO \$dto)
    {
        \$item = {$name}::findOrFail(\$dto->id);
        \$item->update((array) \$dto);
        return \$item;
    }

    public function delete(int \$id)
    {
        \$item = {$name}::findOrFail(\$id);
        \$item->delete();
    }

    public function restore(int \$id)
    {
        \$item = {$name}::withTrashed()->findOrFail(\$id);
        \$item->restore();
    }
}";

        File::put($path, $content);
    }

    private function createInterface(string $name)
    {
        $path = app_path("Repositories/Interfaces/{$name}RepositoryInterface.php");

        $content = "<?php

namespace App\Repositories\Interfaces;

use App\DTOs\\{$name}\\Create{$name}DTO;
use App\DTOs\\{$name}\\Update{$name}DTO;

interface {$name}RepositoryInterface
{
    public function getAll();
    public function getAllTrashed();
    public function findById(int \$id);
    public function create(Create{$name}DTO \$dto);
    public function update(Update{$name}DTO \$dto);
    public function delete(int \$id);
    public function restore(int \$id);
}";

        File::put($path, $content);
    }

    private function createDTO(string $name)
    {
        $path = app_path("DTOs/{$name}/Create{$name}DTO.php");

        $content = "<?php

namespace App\DTOs\\{$name};

class Create{$name}DTO
{
    public function __construct(
        public readonly array \$data
    ) {}
}";

        File::put($path, $content);
    }

    private function updateDTO(string $name)
    {
        $path = app_path("DTOs/{$name}/Update{$name}DTO.php");

        $content = "<?php

namespace App\DTOs\\{$name};

class Update{$name}DTO
{
    public int \$id;

    public function __construct(
        public readonly array \$data
    ) {
        \$this->id = \$data['id'];
    }
}";

        File::put($path, $content);
    }

    private function registerBinding(string $name)
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');

        $interface = "\\App\\Repositories\\Interfaces\\{$name}RepositoryInterface::class";
        $repository = "\\App\\Repositories\\{$name}Repository::class";

        $binding = "\n        \$this->app->scoped({$interface}, {$repository});";

        $content = file_get_contents($providerPath);

        // Evitar duplicados
        if (str_contains($content, "{$name}RepositoryInterface")) {
            $this->warn("Binding for {$name} already exists.");
            return;
        }

        // Insertar dentro del método register()
        $content = preg_replace(
            '/public function register\(\): void\s*\{/',
            "public function register(): void\n    {{$binding}",
            $content
        );

        file_put_contents($providerPath, $content);

        $this->info("Binding registered in AppServiceProvider");
    }
}
