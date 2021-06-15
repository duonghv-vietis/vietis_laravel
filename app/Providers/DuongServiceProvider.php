<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Models\Post;

class DuongServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->singleton(Post::class , PostInterface::class)
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
