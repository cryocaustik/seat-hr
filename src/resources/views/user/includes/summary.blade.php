<div class="card card-gray card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ trans('seat-hr::hr.summary') }}</h3>
    </div>
    <div class="card-body box-profile">

        <div class="text-center">
            {!! img('characters', 'portrait', $character->character_id, 128, ['class' => 'profile-user-img img-fluid img-circle']) !!}
        </div>
        <h3 class="profile-username text-center">
            {{ $character->name }}
        </h3>

        <p class="text-muted text-center">
            @include('seat-hr::partials.corporation', ['corporation' => $character->affiliation->corporation])
        </p>

        <ul class="list-group list-group-unbordered mb-3">
            @if(! is_null($character->refresh_token))
                @foreach($character->refresh_token->user->characters->where('character_id', '<>', $character->character_id)->sortBy('name') as $character_info)

                    <li class="list-group-item">
                        {!! img('characters', 'portrait', $character_info->character_id, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
                        {{ $character_info->name }}
                        <span class="id-to-name text-muted float-right" data-id="{{ $character_info->affiliation->corporation_id }}">{{ $character_info->affiliation->corporation->name }}</span>
                    </li>

                @endforeach
            @endif
        </ul>

    </div>

</div>
