# Easy Sale

## Kurulum
Paketi kurmak için aşağıdaki adımları izleyin.

```sh
composer require ademozmermer/easysale
```

İsteğe bağlı: Servis sağlayıcı otomatik olarak kaydedilir. Veya servis sağlayıcıyı `config/app.php` dosyanıza manuel olarak ekleyebilirsiniz:

```sh
/*
 * Package Service Providers...
 */
\AdemOzmermer\EasySaleServiceProvider::class,
```

Yapılandırma, migration ve blade dosyaları için aşağıdaki kodu terminalde çalıştırın.

```
php artisan vendor:publish --provider="AdemOzmermer\EasySaleServiceProvider"
php artisan migrate // İlgili tabloları veritabanınızda oluşturur
```


## Config Yapılandırması

Paket içi yapılandırma dosyanızda gelen açıklamalar

| Index | Detay |
| ------ | ------ |
| prefix | Paketin çalışacağı url |
| middleware | Kullanıcıların prefix indexinde ziyaret edeceği sayfadaki middleware |
| auth_middleware | @todo |
| default_meta_title | Varsayılan site title |
| page_meta_title | İç sayfalardaki site title |
| default_meta_description | Varsayılan meta açıklama |
| page_meta_description | İç sayfalardaki meta açıklama |

## Kullanım

Veri eklemeker ile ilgili örnekler
```
// Kategori
$category = \AdemOzmermer\Entity\Category::create([
    'name' => 'Cep Telefonu',
    'image' => 'image.jpg',
    'status' => true,
    'sort_by' => 1,
]);

// Ürün
\AdemOzmermer\Entity\Product::create([
    'category_id' => $category->id,
    'name' => 'Iphone X',
    'image' => 'image.jpg',
    'base_price' => 1000.00,
    'minimum_price' => 500.00,
    'status' => true,
    'sort_by' => 1
]);

// Seçenek ve varyan oluşturma
$option = \AdemOzmermer\Entity\Option::create([
    'name' => 'Hafıza',
    'sort_by' => 1
]);

\AdemOzmermer\Entity\Variant::create([
    'option_id' => $option->id,
    'name' => '64 GB',
    'sort_by' => 1
]);

// Ürünlere varyan ekleme
$variant = [
                1 => ['price' => 500, 'price_type' => 'price'],
                2 => ['price' => -40, 'price_type' => 'percent']
            ];
$product->variants()->attach($variant);
```