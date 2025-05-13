<x-layouts.app :title="('Create new Product Category')">

<flux:heading>Create New Product Categories</flux:heading>
<flux:text class="mt-2">Form untuk menambah data product category baru</flux:text>
<flux:separator variant="subtle"/>

<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
        <flux:input name="name" label="Name" placeholder="Product Category Name" required/>

        <flux:input name="slug" label="Slug" placeholder="Product Category Name" required/>

        <flux:textarea name="description" label="Description" placeholder="Product Description" required/>

        <flux:input name="image" type="file" label="Image" placeholder="Product Image"/>
        
        <flux:separator />
        <div>
        <flux:button type="submit" icon="plus" variant="primary" class="mt-4">Simpan</flux:button>
        <flux:link href="{{ route('categories.index') }}" variant="ghost"
        class="ml-3">Kembali</flux:link>
        </div> 
</form>
</x-layouts.app>