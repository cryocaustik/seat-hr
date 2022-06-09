<?php

namespace Cryocaustik\SeatHr\http\composers;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Seat\Web\Http\Composers\AbstractMenu;

class ProfileMenu extends AbstractMenu
{
    private $character;

    public function __construct()
    {
        $this->character = request()->character;
    }

    public function getRequiredKeys(): array
    {
        return [
            'name', 'permission', 'highlight_view', 'route',
        ];
    }

    public function compose(View $view)
    {
        $menu = [];

        foreach (config('seat-hr.profile.menu') as $menu_data) {
            $prepared_menu = $this->load_plugin_menu('seat-hr.profile', $menu_data, true);
            if (! is_null($prepared_menu) ){
                array_push($menu, $prepared_menu);
            }
        }

        $menu = array_values(Arr::sort($menu, function ($value) {
            return $value['name'];
        }));

        $view->with('menu', $menu);
    }

    public function userHasPermission(array $permissions): bool
    {
        return Gate::any($permissions, $this->character);
    }
}
