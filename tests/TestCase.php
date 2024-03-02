<?php

namespace Bogordesain\Enum\Test;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * @param $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return [\Bogordesain\Enum\EnumServiceProvider::class];
    }

    /**
     * @param $app
     * @return array|string[]
     */
    protected function getPackageAliases($app)
    {
        return [];
    }

    /**
     * @param $app
     * @return void
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('status');
        });
    }
}
