<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Hotel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">
                    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.hotels.form', ['submitText' => 'Create Hotel'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>