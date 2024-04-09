<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Menu;

class UserBasicLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // $menudata = Menu::where('parent_id', NULL)
        // ->get();

        return view('layouts.userBasic');
    }
}