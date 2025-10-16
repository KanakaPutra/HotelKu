@csrf

<!-- Name -->
<div class="mb-4">
    <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Hotel Name:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $hotel->name ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" required>
    @error('name')
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<!-- Address -->
<div class="mb-4">
    <label for="address" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Address:</label>
    <input type="text" name="address" id="address" value="{{ old('address', $hotel->address ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" required>
    @error('address')
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<!-- Description -->
<div class="mb-4">
    <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description:</label>
    <textarea name="description" id="description" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" required>{{ old('description', $hotel->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<!-- Image -->
<div class="mb-6">
    <label for="image" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Hotel Image:</label>
    <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
    @error('image')
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror

    @isset($hotel)
        @if($hotel->image_path)
            <div class="mt-4">
                <p class="text-sm text-gray-500">Current Image:</p>
                <img src="{{ asset('storage/' . $hotel->image_path) }}" alt="Current Image" class="mt-2 h-32 w-auto rounded">
            </div>
        @endif
    @endisset
</div>

<div class="flex items-center justify-end">
    <a href="{{ route('admin.hotels.index') }}" class="text-gray-600 dark:text-gray-400 mr-4">Cancel</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        {{ $submitText ?? 'Save Hotel' }}
    </button>
</div>