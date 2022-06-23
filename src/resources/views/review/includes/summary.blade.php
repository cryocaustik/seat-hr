<div class="card card-gray card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ trans('seat-hr::hr.summary') }}</h3>

        <div class="dropdown float-right">
            <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                {{ $corporation->name }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($registered_corporations as $r_id => $r_name)
                    <a href="{{ route(Route::currentRouteName(), [ 'corporation' => $r_id ]) }}" class="dropdown-item">
                        {{ $r_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body box-profile">

        <div class="text-center">
            {!! img('corporations', 'logo', $corporation->corporation_id, 128, ['class' => 'profile-user-img img-fluid img-circle']) !!}
        </div>
        <h3 class="profile-username text-center">
            {{ $corporation->corporation->name }}
        </h3>

        @if($corporation->corporation->alliance_id)
            <p class="text-muted text-center">
                <span class="id-to-name" data-id="{{ $corporation->corporation->alliance_id }}">{{ trans('seat-hr::hr.unknown') }}</span>
            </p>
        @endif

        <dl>
            @if($corporation->corporation->alliance_id)
                <dt>{{ trans('seat-hr::review.alliance') }}</dt>
                <dd><span class="id-to-name" data-id="{{ $corporation->corporation->alliance_id }}">{{ trans('seat-hr::hr.unknown') }}</span></dd>
            @endif

            <dt>{{ trans('seat-hr::review.corp.ticker') }}</dt>
            <dd>{{ $corporation->corporation->ticker }}</dd>

            <dt>{{ trans('seat-hr::review.corp.url') }}</dt>
            <dd>
                <a href="{{ $corporation->url }}" target="_blank">{{ $corporation->corporation->url }}</a>
            </dd>

            <dt>{{ trans('seat-hr::review.corp.tax_rate') }}</dt>
            <dd>{{ number_format($corporation->tax_rate * 100) }}%</dd>

            <dt>{{ trans('seat-hr::review.corp.member_count') }}</dt>
            <dd>
                @if(!is_null($corporation->memberLimit) && $corporation->corporation->memberLimit > 0)
                    {{ $corporation->corporation->member_count }} / {{ $corporation->corporation->memberLimit }}
                @else
                    {{ $corporation->corporation->member_count }}
                @endif
            </dd>

            <dt>{{ trans('seat-hr::review.corp.members_registered') }}</dt>
            <dd>
                {{ $corporation->corporation->characters->count() }} / {{ $corporation->corporation->member_count }}
            </dd>

        </dl>

    </div>

</div>
