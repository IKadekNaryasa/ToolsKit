<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.user.user-data :users="$users"></x-admin.user.user-data>
        </div>
    </div>
</x-layout>