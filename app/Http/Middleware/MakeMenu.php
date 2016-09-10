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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $menu= new Menu;

        $menu->make('MainMenu', function($menu){

            $menu->add('Home');
            $menu->add('About',    'about');
            $menu->add('services', 'services');
            $menu->add('Contact',  'contact');

        });


        $menu->make('CategoryMenu', function($menu){

            $categories=  Category::all();

            foreach ($categories as $category){

                $menu->add($category->title, $category->category_id);

            }



        });


        $menu->make('PageMenu', function($menu){

            $pages=  Page::all();

            foreach ($pages as $page){

                $menu->add($page->title, $page->title."/".$page->page_id );

            }



        });



        return $next($request);

    }
}
