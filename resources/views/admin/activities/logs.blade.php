@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<style>
    .arrow::after {
        content: "\23F7";
        /* Down arrow ▼ */
        font-size: 14px;
        transition: transform 0.3s ease;
        display: inline-block;
        margin-left: 8px;
    }

    .arrow[aria-expanded="true"]::after {
        transform: rotate(180deg);
        /* Flip up ▲ */
    }
</style>
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('clear.log') }}" class="btn btn-primary" style="float: right;margin-right:3px;"><i
                            class="fa fa fa-history fa-xs"></i>
                        {{ __('Clear Log') }}</a>
                </div>
                <div class="accordion mt-2" id="logAccordion">
                    @forelse($logs as $index => $log)
                    @php

                    $levelColors = [
                    'error' => 'bg-danger text-white',
                    'warning' => 'bg-warning text-dark',
                    'info' => 'bg-info text-white',
                    'debug' => 'bg-secondary text-white',
                    'notice' => 'bg-primary text-white',
                    'alert' => 'bg-dark text-white',
                    ];

                    $headerClass = $levelColors[strtolower($log['level'])] ?? 'bg-light text-dark';
                    @endphp

                    <div class="card mb-1">
                        <div class="card-header p-2 d-flex justify-content-between align-items-center {{ $headerClass }}"
                            id="heading{{ $index }}">
                            <button class="btn btn-link text-left flex-grow-1 collapsed text-white" type="button"
                                data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="false"
                                aria-controls="collapse{{ $index }}">
                                [{{ $log['timestamp'] }}] {{ strtoupper($log['level']) }}
                            </button>
                            <!-- Right Arrow -->
                            <span class="arrow collapsed" data-toggle="collapse" data-target="#collapse{{ $index }}"
                                aria-expanded="false" aria-controls="collapse{{ $index }}"></span>
                        </div>

                        <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}"
                            data-parent="#logAccordion">
                            <div class="card-body">
                                <pre class="mb-0" style="white-space: pre-wrap;">{{ $log['message'] }}</pre>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">No logs available.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</section>
@endsection