@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
    @endforeach
@endif