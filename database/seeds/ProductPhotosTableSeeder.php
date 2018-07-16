<?php
declare(strict_types=1);

use CodeShopping\Models\Product;
use CodeShopping\Models\ProductPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ProductPhotosTableSeeder extends Seeder
{
    /**
     *  @var Collection
     */
    private $allFakerPhotos;
    private $fakerPhotosPath = 'app/faker/product_photos';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->allFakerPhotos = $this->getFakerPhotos();
        /** @var \Illuminate\Database\Eloquent\Collection $products */
        $products = Product::all();
        $this->deleteAllPhotosInProductsPath();
        $self = $this;
        $products->each(function($product) use($self){
            $self->createPhotoDir($product);
            $self->createPhotosModels($product);
        });
    }
    
    private function getFakerPhotos(): Collection{
        $path = storage_path($this->fakerPhotosPath);
        return collect(\File::allFiles($path));
    }
    
    private function deleteAllPhotosInProductsPath(){
        $path = ProductPhoto::PRODUCTS_PATH;
        \File::deleteDirectory(storage_path($path), true);
    }
    
    private function createPhotoDir(Product $product){
        $path = ProductPhoto::photosPath($product->id);
        \File::makeDirectory($path, 0777, true);
    }
    
    private function createPhotosModels(Product $product){
        foreach (range(1,5) as $v){
            $this->createPhotoModels($product);
        }
    }
    
    private function createPhotoModels(Product $product){
        $photo = ProductPhoto::create([
            'product_id' => $product->id,
            'file_name' => 'imagem.jpg'
        ]);
        $this->generatePhoto($photo);
    }
    
    private function generatePhoto(ProductPhoto $photo){
        $photo->file_name = $this->upalodPhoto($photo->product_id);
        $photo->save();
    }

    private function upalodPhoto($productId): string
    {
        /** @var SplFileInfo $photoFile */
        $photoFile = $this->allFakerPhotos->random();
        $uploadFile = new Illuminate\Http\UploadedFile(
                $photoFile->getRealPath(),
                str_random(16) . '.' . $photoFile->getExtension()
        );
        ProductPhoto::uploadFiles($productId,[$uploadFile]);
        //upload da photo
        return $uploadFile->hashName();
    }
    
}
