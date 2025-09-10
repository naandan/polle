<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-xl p-6 md:p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $poll->title }}</h1>
            <p class="text-gray-500 dark:text-gray-400">{{ $poll->description }}</p>
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
            <div class="grid grid-cols-1 gap-4">
                @foreach ($poll->options as $option)
                    <label class="block group cursor-pointer">
                        @if($poll->multiple_choice)
                            <input type="checkbox" wire:model="selected" value="{{ $option->id }}"
                                class="hidden peer">
                            <div class="flex items-center justify-between border border-gray-300 dark:border-gray-600 p-4 rounded-xl transition-all duration-300 bg-white dark:bg-gray-800 group-hover:shadow-md peer-checked:border-blue-500 peer-checked:text-blue-500 peer-checked:ring-2 peer-checked:ring-blue-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-700/40">
                                <span class="font-medium">{{ $option->text }}</span>
                            </div>
                        @else
                            <input type="radio" wire:model="selected" name="poll-option" value="{{ $option->id }}"
                                class="hidden peer">
                            <div class="flex items-center justify-between border border-gray-300 dark:border-gray-600 p-4 rounded-xl transition-all duration-300 bg-white dark:bg-gray-800 group-hover:shadow-md peer-checked:border-blue-500 peer-checked:text-blue-500 peer-checked:ring-2 peer-checked:ring-blue-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-700/40">
                                <span class="font-medium">{{ $option->text }}</span>
                            </div>
                        @endif
                    </label>
                @endforeach
            </div>

            @error('selected') 
                <p class="text-red-500 text-sm mt-4">{{ $message }}</p> 
            @enderror

            <button type="submit"
                class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition duration-300">
                Kirim Vote
            </button>
        </form>
    </div>
</div>
