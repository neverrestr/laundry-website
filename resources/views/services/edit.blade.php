<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Service') }}: {{ $service->name }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('services.update', $service) }}" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Service Name</label>
                        <input type="text" name="name" value="{{ old('name', $service->name) }}" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Price per Unit (Rp)</label>
                        <input type="number" name="price_per_unit" value="{{ old('price_per_unit', $service->price_per_unit) }}" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required min="1">
                        @error('price_per_unit') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Unit Type</label>
                        <select name="unit" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                            <option value="kg" {{ old('unit', $service->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                            <option value="item" {{ old('unit', $service->unit) == 'item' ? 'selected' : '' }}>Item (pcs)</option>
                            <option value="pair" {{ old('unit', $service->unit) == 'pair' ? 'selected' : '' }}>Pair</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>