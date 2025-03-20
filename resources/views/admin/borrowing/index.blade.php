<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.borrowing.borrowing-data :borrowings="$borrowings"></x-admin.borrowing.borrowing-data>
        </div>
    </div>
</x-layout>