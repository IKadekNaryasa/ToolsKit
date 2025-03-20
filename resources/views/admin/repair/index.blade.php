<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.repair.repair-data :repairs="$repairs"></x-admin.repair.repair-data>
        </div>
    </div>
</x-layout>