@extends('layouts.app')

@section('content')
    <header>
        <h1>{{ __('Calendar') }}</h1>
    </header>

    <div class="row m-2">
        <div class="card">
            <div class="card-body d-flex">
                <a href="{{ route('calendar.index') }}" class="btn btn-outline-dark me-2"
                    title="{{ __('Today') }}">{{ __('Today') }}</a>
                <a href="{{ route('calendar.index',$date->copy()->subMonth()->toDateString()) }}"
                    class="btn btn-outline-dark me-2" title="{{ __('Previous month') }}"><i
                        class="las la-chevron-left"></i></a>
                <a href="{{ route('calendar.index',$date->copy()->addMonth()->toDateString()) }}"
                    class="btn btn-outline-dark me-2" title="{{ __('Next month') }}"><i
                        class="las la-chevron-right"></i></a>
                <span class="fs-5">{{ $date->format('F Y') }}</span>
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col text-center border">{{ __('Monday') }}</div>
                    <div class="col text-center border">{{ __('Tuesday') }}</div>
                    <div class="col text-center border">{{ __('Wednesday') }}</div>
                    <div class="col text-center border">{{ __('Thursday') }}</div>
                    <div class="col text-center border">{{ __('Friday') }}</div>
                    <div class="col text-center border">{{ __('Saturday') }}</div>
                    <div class="col text-center border">{{ __('Sunday') }}</div>
                </div>
                <div class="row" style="height: 14vh;">

                    @while ($startOfCalendar <= $endOfCalendar)
                        <div class="col text-center border d-flex flex-column" onclick="Calendar.scheduleEvent('{{ $startOfCalendar->toDateString() }}')">
                            <span class="mb-1">{{ $startOfCalendar->format('j') }}</span>
                            @foreach ( $events->where('start_date', $startOfCalendar) as $event)
                                <span class="badge text-bg-secondary mb-1">{{ $event->title }}</span>
                            @endforeach
                        </div>

                        @if ($startOfCalendar->isoWeekday() == 7 && $startOfCalendar->copy()->addDay() <= $endOfCalendar)
                            </div>
                            <div class="row" style="height: 14vh;">
                        @endif

                        @php
                            $startOfCalendar->addDay();
                        @endphp
                    @endwhile
                </div>
            </div>
        </div>
    </div>

    @include('calendar.modal.event_create')

    @push('scripts')
        <script src="{{ asset('/asset/js/Calendar.js') }}"></script>
    @endpush
@endsection
