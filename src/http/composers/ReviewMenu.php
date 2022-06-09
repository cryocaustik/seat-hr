<?php

namespace Cryocaustik\SeatHr\http\composers;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Seat\Web\Http\Composers\AbstractMenu;

class ReviewMenu extends AbstractMenu
{
    private $corporation;

    public function __construct()
    {
        $this->corporation = request()->corporation;
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

        foreach (config('seat-hr.review.menu') as $menu_data) {
            $prepared_menu = $this->load_plugin_menu('seat-hr.review', $menu_data, true);
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
        return Gate::any($permissions, $this->corporation);
    }
}
