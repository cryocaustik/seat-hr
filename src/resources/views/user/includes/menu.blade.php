<div class="row">
    <div class="col-md-9">
        <div class="pb-3">
            <ul class="nav nav-pills">
                @foreach($menu as $menu_entry)
                    <li class="nav-item">
                        <a href="{{ route($menu_entry['route'], ['character' => $character->character_id]) }}"
                           class="nav-link @if ($viewname == $menu_entry['highlight_view']) active @endif">
                            {{ $menu_entry['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
