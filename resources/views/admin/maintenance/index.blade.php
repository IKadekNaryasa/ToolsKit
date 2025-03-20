<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.maintenance.maintenance-data :maintenances="$maintenances"></x-admin.maintenance.maintenance-data>
        </div>
    </div>
</x-layout>