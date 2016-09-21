<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Http\Models\Product;
use App\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
    use DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function adminLogin()
    {
        $user = User::findorFail(1);
        $this->be($user);
    }

    public function userLogin()
    {
        $user = User::findorFail(2);
        $this->be($user);
    }

    public function getSampleProduct()
    {
        $product = Product::findorFail(1);

        return $product;
    }
}
