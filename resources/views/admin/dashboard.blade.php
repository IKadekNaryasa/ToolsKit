<x-layout :active="$active" :open="$open" :link="$link">
    Welcome, {{ auth()->user()->name }}
</x-layout>