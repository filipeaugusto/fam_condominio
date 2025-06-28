<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeAllModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-all-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera Models automaticamente com base nas tabelas do banco de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schema = DB::getSchemaBuilder();
        $tables = $schema->getTables($schema->getCurrentSchemaName());
        $modelPath = app_path('Models');

        if (!File::exists($modelPath)) {
            File::makeDirectory($modelPath, 0755, true);
            $this->info("📁 Diretório app/Models criado.");
        }

        foreach ($tables as $table) {

            $modelName = Str::studly(Str::singular($table['name']));
            $modelFile = $modelPath . "/{$modelName}.php";

            if (!File::exists($modelFile)) {
                $this->info("📦 Gerando Model: {$modelName}");
                Artisan::call('make:model', [
                    'name' => $modelName
                ]);
            } else {
                $this->warn("⚠️ Model {$modelName} já existe, pulando...");
            }
        }

        $this->info("✅ Todos os models foram gerados com sucesso!");
        return 0;
    }
}
