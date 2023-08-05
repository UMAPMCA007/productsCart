<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ url('/updateProduct/'.$product->id) }}" enctype="multipart/form-data">
        @csrf

        <!--product Name -->
        <div>
            <x-input-label for="Product Name" :value="__('Product Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required autofocus  />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!--Product Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Product Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{$product->price}}" required  />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Product Discription')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$product->description}}" required  />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    @if($product->image != null)
        <div class="mt-4">
            <x-input-label for="Image" :value="__('Product Image')" />
            <img src="{{asset('uploads/product/'.$product->image)}}" alt="image" width="100px" height="100px">
        </div>
        <div class="mt-4">
            <x-input-label for="Image" :value="__('Product Image')" />
            <x-text-input id="Image" class="block mt-1 w-full" type="file" name="image"/>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
    @else
        <div class="mt-4">
            <x-input-label for="Image" :value="__('Product Image')" />
            <x-text-input id="Image" class="block mt-1 w-full" type="file" name="image"/>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
     @endif


        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
