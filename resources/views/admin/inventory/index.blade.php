<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.inventory.inventory-data :inventories="$inventories"></x-admin.inventory.inventory-data>
        </div>
    </div>
</x-layout>