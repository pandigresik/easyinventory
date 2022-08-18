<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class ScaffoldJsonAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold.all.schemajson:generate {--filepath=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate scaffold infyom based file json';
    private $files;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filepath = $this->option('filepath');
        $schemaFileDirector = config(
            'infyom.laravel_generator.path.schema_files',
            resource_path('model_schemas/')
        );
        $listFile = [];
        if (empty($filepath)) {
            $filesInFolder = File::files($schemaFileDirector);
            if (!empty($filesInFolder)) {
                foreach ($filesInFolder as $file) {
                    $filename = pathinfo($file);
                    array_push($listFile, $filename);
                }
            }
        } else {
            array_push($listFile, $filepath);
        }

        if (!empty($listFile)) {
            foreach ($listFile as $file) {
                $this->info($file['dirname'].'/'.$file['basename']);
                $this->processJson($file);
            }
        } else {
            $this->error('File not exist');

            return false;
        }

        return 0;
    }

    private function processJson($jsonSchema)
    {
        $this->call('infyom:scaffold', [
            'model' => $jsonSchema['filename'],
            '--fieldsFile' => $jsonSchema['basename'],
            '--ignoreFields' => 'created_at,updated_at,deleted_at,created_by,updated_by',
            '--skip' => 'dump-autoload',
            '--forceMigrate' => '',
        ]);
    }
}
