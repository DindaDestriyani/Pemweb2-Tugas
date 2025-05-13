<x-layouts.app :title="('Edit Product Category')">

    <flux:heading>Edit Product Category</flux:heading>
    <flux:text class="mt-2">Form untuk mengubah data kategori produk</flux:text>
    <flux:separator variant="subtle"/>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">
            {{ session()->get('successMessage') }}
        </flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">
            {{ session()->get('errorMessage') }}
        </flux:badge>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:input 
            name="name" 
            label="Name" 
            placeholder="Product Category Name" 
            required 
            value="{{ old('name', $category->name) }}" 
        />

        <flux:input 
            name="slug" 
            label="Slug" 
            placeholder="product-category-slug" 
            required 
            value="{{ old('slug', $category->slug) }}" 
        />

        <flux:textarea 
            name="description" 
            label="Description" 
            placeholder="Product Description" 
            required
        >{{ old('description', $category->description) }}</flux:textarea>

        @if ($category->image)
            <div class="mb-4">
                <img 
                    src="{{ Storage::url($category->image) }}" 
                    alt="{{ $category->name }}" 
                    class="w-16 h-16 object-cover rounded-md">
            </div>
        @endif

        <flux:input 
            name="image" 
            type="file" 
            label="Image" 
            placeholder="Product Image" 
        />

        <flux:separator />

        <div>
            <flux:button type="submit" icon="plus" variant="primary" class="mt-4">
                Simpan
            </flux:button>
            <flux:button href="{{ route('categories.index') }}" variant="ghost" class="ml-3">
                Kembali
            </flux:button>
        </div>
    </form>

</x-layouts.app>