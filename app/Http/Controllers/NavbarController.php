<?php

namespace L2\Http\Controllers;

use Auth;
use Illuminate\Database\QueryException;
use L2\Http\Requests\NavbarCheck;
use L2\Http\Requests\NavbarUpdateCheck;
use L2\Repositories\NavbarRepository as Navbar;

class NavbarController extends Controller
{

    private $navbar;

    public function __construct(Navbar $navbar)
    {
        $this->middleware(['auth','admin']);
        $this->navbar = $navbar;
    }

    public function store(NavbarCheck $request)
    {
        $this->navbar->create([
            'description' => $request->input('description'),
            'shortcode' => $request->input('shortcode'),
            'navbar' => $request->input('navbar')
        ]);

        return response('Navigation bar was successfully created.', 200);
    }

    public function update($id, NavbarUpdateCheck $request)
    {
        $navbar = $this->navbar->getById($id);

        try {
            $navbar->update([
                'description' => $request->input('description'),
                'shortcode' => $request->input('shortcode'),
                'navbar' => $request->input('navbar'),
            ]);
        } catch (QueryException $e)
        {
            return response($e->getMessage(),422);
        }

        return response('Navigation bar was successfully updated.', 200);
    }

    public function destroy($id)
    {
        $navbar = $this->navbar->getById($id);

        try {
            $navbar->delete();
        }
        catch (QueryException $e)
        {
            return response($e->getMessage(),422);
        }

        return response('Navigation bar was successfully deleted', 200);
    }
}
