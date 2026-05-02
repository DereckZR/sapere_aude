<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeBiding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:biding {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a binding in the AppServiceProvider';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));

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
