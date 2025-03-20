<x-layout :active="$active" :open="$open" :link="$link">
    <!-- content here -->
    <!-- Basic Badges -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.category.category-data class="category catgory-data" :categories="$categories"></x-admin.category.category-data>
        </div>
    </div>
</x-layout>