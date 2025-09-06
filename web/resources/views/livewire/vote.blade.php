<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-2xl p-6 md:p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $poll->title }}</h1>
            <p class="text-gray-500 dark:text-gray-400">{{ $poll->description }}</p>
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
            <div class="grid grid-cols-1 gap-4">
                @foreach ($poll->options as $option)
                    <label class="block">
                        @if($poll->multiple_choice)
                            <input type="checkbox" wire:model="selected" value="{{ $option->id }}"
                                class="hidden peer">
                            <div class="flex items-center space-x-4 border border-gray-300 dark:border-gray-600 p-4 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-700 peer-checked:border-blue-500 dark:peer-checked:border-blue-400">
                                <span class="w-5 h-5 border-2 border-gray-400 rounded-md transition-all duration-200 flex items-center justify-center peer-checked:border-blue-600 peer-checked:bg-blue-600">
                                    <svg class="w-4 h-4 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $option->text }}</span>
                            </div>
                        @else
                            <input type="radio" wire:model="selected" name="poll-option" value="{{ $option->id }}"
                                class="hidden peer">
                            <div class="flex items-center space-x-4 border border-gray-300 dark:border-gray-600 p-4 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700 peer-checked:bg-blue-100 dark:peer-checked:bg-blue-700 peer-checked:border-blue-500 dark:peer-checked:border-blue-400">
                                <span class="w-5 h-5 border-2 border-gray-400 rounded-full transition-all duration-200 flex items-center justify-center peer-checked:border-blue-600 peer-checked:bg-blue-600">
                                    <div class="w-2.5 h-2.5 rounded-full bg-white hidden peer-checked:block"></div>
                                </span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $option->text }}</span>
                            </div>
                        @endif
                    </label>
                @endforeach
            </div>

            @error('selected') <p class="text-red-500 text-sm mt-4">{{ $message }}</p> @enderror

            <button type="submit"
                class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition duration-300">
                Kirim Vote
            </button>
        </form>
    </div>
</div>