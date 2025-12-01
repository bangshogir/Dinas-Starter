@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6 xl:col-span-12">
            <div class="p-6 bg-white border border-gray-200 rounded-2xl dark:bg-gray-900 dark:border-gray-800">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Welcome to Admin Dashboard</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">This is the modular admin dashboard integrated with Laravel
                    11 and Livewire.</p>
            </div>
        </div>
    </div>
@endsection