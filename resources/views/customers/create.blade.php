<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Address (Optional)</label>
                        <textarea name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full p-2 border" rows="3">{{ old('address') }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Customer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>