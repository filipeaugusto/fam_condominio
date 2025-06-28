<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeAllPolicies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-all-policies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera uma policy para cada model localizado em app/Models';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $modelPath = app_path('Models');

        if (!File::exists($modelPath)) {
            $this->error("Diretório app/Models não encontrado.");
            return 1;
        }

        $models = collect(File::files($modelPath))
            ->filter(fn($file) => $file->getExtension() === 'php')
            ->map(fn($file) => $file->getFilenameWithoutExtension());

        foreach ($models as $model) {
            $policy = "{$model}Policy";
            $this->info("Gerando policy para: {$model}");
            Artisan::call('make:policy', [
                'name' => $policy,
                '--model' => "App\\Models\\$model"
            ]);
        }

        $this->info('✅ Todas as policies foram geradas com sucesso!');
        return 0;
    }
}
