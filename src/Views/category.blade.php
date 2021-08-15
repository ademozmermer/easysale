@extends('easysale::layouts.app')

@section('title', sprintf(config('easysale.page_meta_title'), $category->name))

@section('meta_desc', sprintf(config('easysale.page_meta_description'), $category->name))

@section('content')
    <main id="app" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h4 class="h4 category-title">{{ $category->name }} Ürününü Bize Sat</h4>
                </div>
            </div>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-2 col-6 mt-4">
                        <div class="card">
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body p-0">
                                <h5 class="card-title text-center mt-2">{{ $product->name }}</h5>
                                <a href="{{ route('easysale::product', ['slug' => \Illuminate\Support\Str::slug($product->name . '-' . $product->id)]) }}" class="w-100 btn btn-purple">HEMEN SAT</a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-md-12 mt-4">
                        <div class="alert alert-warning">Ekli bir ürün grubu bulunmuyor.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
