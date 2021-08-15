@extends('easysale::layouts.app')

@section('content')

    <header class="header-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="content-header bg-transparant">
                        <h1 class="h2 text-center font-bold mt-3 main-text-first pt-3">Telefonunu, Tabletini, Akıllı
                            Saatini</h1>
                        <h3 class="text-center sale"><strong>HEMEN SAT</strong></h3>
                        <p class="text-center header-sub-text">En uygun fiyat teklifini al ya da takas yapmak için <a
                                href="">easycep.com</a> hediye çekini alabilirsin.

                        </p>
                        <div class="bilgiler">
                            <div class="bilgi">
                                <i class="far fa-credit-card"></i>
                                <p>Hızlı Ödeme Seçeneği</p>
                            </div>
                            <div class="bilgi">
                                <i class="far fa-star"></i>
                                <p>Müşteri Memnuniyeti</p>
                            </div>
                            <div class="bilgi">
                                <i class="fas fa-truck-moving"></i>
                                <p>Ücretsiz Kargo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="app" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h4 class="h4 category-title">Ürününü Satmak İstediğin Kategoriyi Seç</h4>
                </div>
            </div>
            <div class="row">
                @forelse($categories as $category)
                <div class="col-md-3 mt-4">
                    <div class="card">
                        <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                        <div class="card-body p-0">
                            <h5 class="card-title text-center mt-2">{{ $category->name }}</h5>
                            <a href="{{ route('easysale::category', ['slug' => \Illuminate\Support\Str::slug($category->name . '-' . $category->id)]) }}" class="w-100 btn btn-purple">ÜRÜNLERİ GÖRÜNTÜLE</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 mt-4">
                    <div class="alert alert-warning">Ekli bir kategori grubu bulunmuyor.</div>
                </div>
                @endforelse


            </div>
        </div>
    </main>

@endsection
