@if ($corporation->name && $corporation->name !== trans('seat-hr::hr.unknown'))
    {!! img('corporations', 'logo', $corporation->corporation_id ?? $corporation->entity_id, 32, ['class' => 'img-circle eve-icon small-icon'], false) !!}
    {{ $corporation->name }}
@else
    {!! img('corporations', 'logo', $corporation->corporation_id ?? $corporation->entity_id, 32, ['class' => 'img-circle eve-icon small-icon'], false) !!}
    <span class="id-to-name" data-id="{{ $corporation->corporation_id ?? $corporation->entity_id }}">{{ trans('seat-hr::hr.unknown') }}</span>
@endif
