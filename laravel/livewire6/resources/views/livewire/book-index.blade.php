<div class="max-w-6xl mx-auto">
    <div class="text-right m-2 p-2">
        <input type="text" wire:model="search" id="search" class="border-gray-300 rounded-md" placeholder="キーワード" />
        <x-button class="bg-blue-600" wire:click="showBookModal">登録</x-button>
    </div>

    <div class="m-2 p-2">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-gray-500 text-left">Id</th>
                    <th class="p-4 text-gray-500 text-left">Title</th>
                    <th class="p-4 text-gray-500 text-left">Image</th>
                    <th class="p-4 text-gray-500 text-left">price</th>
                    <th class="p-4 text-gray-500 text-left">Description</th>
                    <th class="p-4 text-gray-500 text-right">Edit</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($books as $book)
                <tr>
                    <td class="p-4 whitespace-nowrap">{{ $book->id }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $book->title }}</td>
                    <td class="p-4 whitespace-nowrap">
                        <img class="w-12 h-9 rounded" src="{{ Storage::url($book->image) }}" />
                    </td>
                    <td class="p-4 whitespace-nowrap">{{ $book->price }}</td>
                    <td class="p-4 whitespace-nowrap">{!! nl2br($book->description) !!}</td>
                    <td class="p-4 text-right text-sm">
                        <x-button class="bg-green-600" wire:click="showEditBookModal({{ $book->id }})">編集</x-button>
                        <x-button class="bg-red-400" wire:click="deleteBook({{ $book->id }})">削除</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="m-2 p-2">{{ $books->links() }}</div>
    </div>

    <x-dialog-modal wire:model="liveModal">
        {{-- <x-slot name="title"><h2 class="text-green-600">登録</h2></x-slot>   --}}
        @if ($editWork)
        <x-slot name="title"><h2 class="text-green-600">編集</h2></x-slot>
        @else
        <x-slot name="title"><h2 class="text-blue-600">登録</h2></x-slot>
        @endif
        <x-slot name="content">
            @if (session()->has('message'))
            <h3 class="p-2 text-2xl text-green-600">{{ session('message') }}</h3>
            @endif

            <form enctype="multipart/form-data">
                <x-label for="title" value="Title" />
                <input type="text" id="title" wire:model.lazy="title" 
                class="block w-full bg-white border border-gray-400 rounded-md" />
                @error('title') <span class="error text-red-400">{{ $message }}</span> @enderror
    
                <x-label for="image" value="Book Image" class="mt-2" />
                {{-- @if ($newImage)
                Photo Preview:
                <img src="{{ $newImage->temporaryUrl() }}" class="w-48">
                @endif --}}
                @if ($newImage)
                    Photo Preview:
                    <img src="{{ $newImage->temporaryUrl() }}" class="w-48">
                @else
                    @if ($oldImage)
                        <img src="{{ Storage::url($oldImage) }}" class="w-48">
                    @endif
                @endif

                <input type="file" id="image" wire:model="newImage" 
                class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3" />
                @error('newImage') <span class="error text-red-400">{{ $message }}</span> @enderror
    
                <x-label for="price" value="Price" />
                <input type="text" id="price" wire:model.lazy="price" 
                class="block w-full bg-white border border-gray-400 rounded-md" />
                @error('price') <span class="error text-red-400">{{ $message }}</span> @enderror
    
                <x-label for="description" value="Description" class="mt-2" />
                <textarea id="description" rows="3" wire:model.lazy="description" 
                class="block w-full border-gray-400 rounded-md"></textarea>
                @error('description') <span class="error text-red-400">{{ $message }}</span> @enderror
    
            </form>
        </x-slot>
        <x-slot name="footer">
            {{-- <x-button wire:click="bookPost">登録実行</x-button> --}}
            @if ($editWork)
            <x-button wire:click="updateBook({{ $Id }})">編集実行</x-button>
            @else
            <x-button wire:click="bookPost">登録実行</x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
