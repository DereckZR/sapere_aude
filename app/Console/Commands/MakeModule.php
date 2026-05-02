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

        $this->createDirectories();

        $this->createController($name);
        $this->createService($name);
        $this->createRepository($name);
        $this->createInterface($name);
        $this->createDTO($name);

        $this->registerBinding($name);

        $this->info("Module {$name} created successfully");
    }

    private function createDirectories()
    {
        $dirs = [
            app_path('Services'),
            app_path('Repositories'),
            app_path('Repositories/Interfaces'),
            app_path('DTOs'),
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
use App\DTOs\\Create{$name}DTO;

class {$name}Controller extends Controller
{
    public function __construct(protected {$name}Service \$service) {}

    public function store(Request \$request)
    {
        \$dto = new Create{$name}DTO(\$request->all());
        return response()->json(\$this->service->create(\$dto));
    }
}";

        File::put($path, $content);
    }

    private function createService(string $name)
    {
        $path = app_path("Services/{$name}Service.php");

        $content = "<?php

namespace App\Services;

use App\DTOs\\Create{$name}DTO;
use App\Repositories\Interfaces\\{$name}RepositoryInterface;

class {$name}Service
{
    public function __construct(protected {$name}RepositoryInterface \$repository) {}

    public function create(Create{$name}DTO \$dto)
    {
        return \$this->repository->create(\$dto);
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
use App\DTOs\\Create{$name}DTO;
use App\Repositories\Interfaces\\{$name}RepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    public function create(Create{$name}DTO \$dto)
    {
        return {$name}::create((array) \$dto);
    }
}";

        File::put($path, $content);
    }

    private function createInterface(string $name)
    {
        $path = app_path("Repositories/Interfaces/{$name}RepositoryInterface.php");

        $content = "<?php

namespace App\Repositories\Interfaces;

use App\DTOs\\Create{$name}DTO;

interface {$name}RepositoryInterface
{
    public function create(Create{$name}DTO \$dto);
}";

        File::put($path, $content);
    }

    private function createDTO(string $name)
    {
        $path = app_path("DTOs/Create{$name}DTO.php");

        $content = "<?php

namespace App\DTOs;

class Create{$name}DTO
{
    public function __construct(
        public readonly array \$data
    ) {}
}";

        File::put($path, $content);
    }

    private function registerBinding(string $name)
    {
        $providerPath = app_path('Providers/AppServiceProvider.php');

        $interface = "\\App\\Repositories\\Interfaces\\{$name}RepositoryInterface::class";
        $repository = "\\App\\Repositories\\{$name}Repository::class";

        $binding = "\n        \$this->app->bind({$interface}, {$repository});";

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
