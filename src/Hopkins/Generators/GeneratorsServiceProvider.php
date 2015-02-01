<?php namespace Hopkins\Generators;

use Hopkins\Generators\Cache;
use Hopkins\Generators\Commands\ControllerGeneratorCommand;
use Hopkins\Generators\Commands\FormDumperCommand;
use Hopkins\Generators\Commands\MigrationGeneratorCommand;
use Hopkins\Generators\Commands\ModelGeneratorCommand;
use Hopkins\Generators\Commands\PivotGeneratorCommand;
use Hopkins\Generators\Commands\ResourceGeneratorCommand;
use Hopkins\Generators\Commands\ScaffoldGeneratorCommand;
use Hopkins\Generators\Commands\SeedGeneratorCommand;
use Hopkins\Generators\Commands\TestGeneratorCommand;
use Hopkins\Generators\Commands\ViewGeneratorCommand;
use Hopkins\Generators\Generators\ControllerGenerator;
use Hopkins\Generators\Generators\FormDumperGenerator;
use Hopkins\Generators\Generators\MigrationGenerator;
use Hopkins\Generators\Generators\ModelGenerator;
use Hopkins\Generators\Generators\ResourceGenerator;
use Hopkins\Generators\Generators\SeedGenerator;
use Hopkins\Generators\Generators\TestGenerator;
use Hopkins\Generators\Generators\ViewGenerator;
use Mustache_Engine;
use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerModelGenerator();
		$this->registerControllerGenerator();
		$this->registerTestGenerator();
		$this->registerResourceGenerator();
		$this->registerScaffoldGenerator();
		$this->registerViewGenerator();
		$this->registerMigrationGenerator();
		$this->registerPivotGenerator();
		$this->registerSeedGenerator();
		$this->registerFormDumper();

		$this->commands(
			'generate.model',
			'generate.controller',
			'generate.test',
			'generate.scaffold',
			'generate.resource',
			'generate.view',
			'generate.migration',
			'generate.seed',
			'generate.form',
			'generate.pivot'
		);
	}

	/**
	 * Register generate:model
	 *
	 * @return ModelGeneratorCommand
	 */
	protected function registerModelGenerator()
	{
		$this->app['generate.model'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new ModelGenerator($app['files'], $cache);

			return new ModelGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:controller
	 *
	 * @return ControllerGeneratorCommand
	 */
	protected function registerControllerGenerator()
	{
		$this->app['generate.controller'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new ControllerGenerator($app['files'], $cache);

			return new ControllerGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:test
	 *
	 * @return TestGeneratorCommand
	 */
	protected function registerTestGenerator()
	{
		$this->app['generate.test'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new TestGenerator($app['files'], $cache);

			return new TestGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:view
	 *
	 * @return ViewGeneratorCommand
	 */
	protected function registerViewGenerator()
	{
		$this->app['generate.view'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new ViewGenerator($app['files'], $cache);

			return new ViewGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:scaffold
	 *
	 * @return ScaffoldGeneratorCommand
	 */
	protected function registerScaffoldGenerator()
	{
		$this->app['generate.scaffold'] = $this->app->share(function($app)
		{
			$generator = new ResourceGenerator($app['files']);
			$cache = new Cache($app['files']);

			return new ScaffoldGeneratorCommand($generator, $cache);
		});
	}

	/**
	 * Register generate:scaffold
	 *
	 * @return ScaffoldGeneratorCommand
	 */
	protected function registerResourceGenerator()
	{
		$this->app['generate.resource'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new ResourceGenerator($app['files'], $cache);

			return new ResourceGeneratorCommand($generator, $cache);
		});
	}

	/**
	 * Register generate:migration
	 *
	 * @return MigrationGeneratorCommand
	 */
	protected function registerMigrationGenerator()
	{
		$this->app['generate.migration'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new MigrationGenerator($app['files'], $cache);

			return new MigrationGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:pivot
	 *
	 * @return PivotGeneratorCommand
	 */
	protected function registerPivotGenerator()
	{
		$this->app['generate.pivot'] = $this->app->share(function($app)
		{
			return new PivotGeneratorCommand;
		});
	}

	/**
	 * Register generate:seed
	 *
	 * @return MigrationGeneratorCommand
	 */
	protected function registerSeedGenerator()
	{
		$this->app['generate.seed'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new SeedGenerator($app['files'], $cache);

			return new SeedGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:migration
	 *
	 * @return MigrationGeneratorCommand
	 */
	protected function registerFormDumper()
	{
		$this->app['generate.form'] = $this->app->share(function($app)
		{
			$gen = new FormDumperGenerator($app['files'], new Mustache_Engine);

			return new FormDumperCommand($gen);
		});
	}

}