<?php

namespace App\Http\Middleware;

use App\Http\Models\Category;
use App\Http\Models\Page;
use Closure;
use Lavary\Menu\Menu;

class MakeMenu
{
    /**
     * Handle an incoming request.
     * TODO: convert these to helper functions so that view can call them
     *
     * Create menu objects so that it available for all the views
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menu = new Menu();

        $menu->make(
            // creates the main menu object
            'MainMenu', function ($menu) {
                $menu->add('Home');
                $menu->add('About', 'about');
                $menu->add('services', 'services');
                $menu->add('Contact', 'contact');
            }
        );

        $menu->make(
            // create category menu object
            //  TODO: obsolete now as the category function does the trick
            // unwanted object to be removed
            'CategoryMenu', function ($menu) {
                $categories = Category::all();

                foreach ($categories as $category) {
                    $menu->add($category->title, $category->category_id);
                }
            }
        );

        $menu->make(
            // created shop page menu
            'PageMenu', function ($menu) {
                $pages = Page::all();
                foreach ($pages as $page) {
                    $menu->add($page->title, $page->title.'/'.$page->page_id);
                }
            }
        );

        return $next($request);
    }
}
