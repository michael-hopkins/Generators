<?php namespace Hopkins\Generators\Commands;

use Hopkins\Generators\Generators\TestGenerator;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestGeneratorCommand extends BaseGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a PHPUnit test class.';

    /**
     * Test generator instance.
     *
     * @var \Hopkins\Generators\Generators\TestGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @param TestGenerator $generator
     */
    public function __construct(TestGenerator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
       return $this->option('path') . '/' . studly_case($this->argument('name')) . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the test to generate.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
           array('path', null, InputOption::VALUE_OPTIONAL, 'Path to tests directory.', app_path() . '/tests'),
           array('template', null, InputOption::VALUE_OPTIONAL, 'Path to template.', __DIR__.'/../Generators/templates/test.txt'),
        );
    }

}
