<x-layout :active="$active" :open="$open" :link="$link">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-admin.request.request-data :requests="$requests"></x-admin.request.request-data>
        </div>
    </div>
</x-layout>