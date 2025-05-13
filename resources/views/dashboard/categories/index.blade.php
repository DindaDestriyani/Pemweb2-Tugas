<x-layouts.app :title="('Dashboard')">
<flux:heading>Product Categories</flux:heading>
<flux:text class="mt-2">informasi tentang data product data categories</flux:text>

<flux:button href="{{ route('categories.create') }}" icon="plus" class="mt-4 mb-4">
    Add New Product Category
</flux:button>

<div class="overflow-x-auto">
<table class="min-w-full divide-y divide-gray-200 border border-gray-300">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($categories as $key => $category)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <img 
                    src="{{ Storage::url(  $category->image) }}" 
                    alt="{{ $category->name }}" 
                    class="w-16 h-16 object-cover rounded-md">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->slug }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->description }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                    <flux:button 
                    href="{{ route('categories.edit', $category->id) }}" 
                    icon="pencil" 
                    variant="primary" 
                    size="sm">Edit</flux:button>

                    <flux:button 
                    href="{{ route('categories.destroy', $category->id) }}" 
                    icon="trash" 
                    variant="danger" 
                    size="sm"
                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) 
                    document.getElementById('delete-form-{{$category->id }}').submit();">Delete</flux:button>
 
                    <form 
                    id="delete-form-{{ $category->id }}" 
                    action="{{ route('categories.destroy', $category->id) }}" 
                    method="POST" 
                    style="display: none;">
                        @csrf
                        @method('DELETE')
                        </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3">
{{ $categories->links() }}
</div>
</div>
</x-layouts.app>