<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row text-end mb-1">
        <div class="col-">
            <a href="{{ route('admin.borrowing.new-transaction') }}">
                <button class="btn btn-sm btn-primary"><i class="bx bx-plus bx-xs"></i></button>
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.borrowing.borrowing-data :borrowings="$borrowings"></x-admin.borrowing.borrowing-data>
        </div>
    </div>
</x-layout>