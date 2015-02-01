<?php namespace Hopkins\Generators\Commands;

use Config;
use Hopkins\Generators\Generators\ViewGenerator;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewGeneratorCommand extends BaseGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new view.';

    /**
     * Model generator instance.
     *
     * @var \Hopkins\Generators\Generators\ViewGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @param ViewGenerator $generator
     */
    public function __construct(ViewGenerator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the view to generate.'),
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
           array('path', null, InputOption::VALUE_OPTIONAL, 'Path to views directory.', Config::get('generators.view_target_path')),
           array('template', null, InputOption::VALUE_OPTIONAL, 'Path to template.', __DIR__.'/../Generators/templates/view.txt'),
        );
    }

}
