<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // id -> unsignedBigInteger + primary + auto-increment

            $table->string('name', 255); // name -> required

            $table->string('slug', 255)->unique(); // slug -> unique, SEO-friendly

            $table->text('description')->nullable(); // deskripsi -> boleh kosong

            $table->string('sku', 50)->unique(); // sku -> unik

            $table->decimal('price', 10, 2)->unsigned(); // price -> >= 0

            $table->integer('stock')->default(0)->unsigned(); // stock -> >= 0

            $table->foreignId('product_category_id')
                  ->nullable()
                  ->constrained('product_categories')
                  ->onUpdate('cascade')
                  ->onDelete('set null'); // foreign key

            $table->string('image_url', 255)->nullable(); // URL gambar

            $table->boolean('is_active')->default(true); // aktif/tidak

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
