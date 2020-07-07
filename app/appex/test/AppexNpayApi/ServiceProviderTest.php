<?php

namespace Tests\Unit\AppexNpayApi;

use App\Library\Services\AppexNpayApi\AppexNpayApi;
use App\Providers\AppexNpayApiServiceProvider;
use Illuminate\Foundation\Application;
use Tests\TestCase;

/**
 * Class ServiceProviderTest
 * @package Tests\Unit\AppexNpayApi
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var AppexNpayApiServiceProvider
     */
    private $provider;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->app = $this->createMock(Application::class);

        $this->provider = new AppexNpayApiServiceProvider($this->app);
    }

    public function test_register(): void
    {
        $bindings = [];

        $this->app->expects($this->once())
            ->method('singleton')
            ->willReturnCallback(static function ($abstract) use (&$bindings) {
                $bindings[] = $abstract;
            });

        $this->provider->register();

        $this->assertEqualsCanonicalizing(
            [AppexNpayApi::class],
            $bindings
        );
    }

    public function test_provides(): void
    {
        $this->assertEqualsCanonicalizing($this->provider->provides(), [
            AppexNpayApi::class
        ]);
    }
}