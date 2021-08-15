@extends('easysale::layouts.app')

@section('title', sprintf(config('easysale.page_meta_title'), $product->name))

@section('meta_desc', sprintf(config('easysale.page_meta_description'), $product->name))

@section('content')
    <main id="app" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h4 class="h4 category-title">{{ $product->name }} Ürününü Sat</h4>
                    <p>Ürününüz ile ilgili en iyi teklifi verebilmemiz için lütfen soruları uygun şekilde cevaplayınız.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="product">
                            <img class="img-responsive w-100" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            <p>{{ $product->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="" class="variants__form-action">
                        <div class="options">
                            @foreach($options as $key => $option)
                                <div class="mb-4">
                                    <div class="option"><h4>{{ $option['name'] }}</h4></div>
                                    <div class="variants">
                                        <div class="row">
                                            @foreach($option['variants'] as $x => $variant)
                                                <div class="col-sm-3">
                                                    <label for="radio-{{$variant['id']}}">{{ $variant['name'] }}</label>
                                                    <input class="radio__input" type="radio" data-price="{{ $variant['price'] }}" data-price-type="{{ $variant['price_type'] }}" name="variant[{{ $key }}]" id="radio-{{$variant['id']}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-footer" id="prices" style="display: none;">
                            <div class="row">
                                <div class="col-md-8 mt-sm-3">
                                    <div class="row" id="deal-price">
                                        <div class="col-8 text-right font-weight-bold">Takas Teklif Fiyatı</div>
                                        <div class="col-4 product_price font-weight-bold" id="takas"></div>
                                    </div>
                                    <div class="row" id="cash-price">
                                        <div class="col-8 text-right text-black-50">Nakit Teklif Fiyatı</div>
                                        <div class="col-4" id="price"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-sm-3 btn-group-vertical"><input id="satButton" type="submit" class="btn btn-block btn-success shadow" value="Sepete Ekle"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $('.radio__input').checkboxradio({
                icon: false
            });

            $('.variants__form-action').change(function () {

                var totalDiv = $('.option').length;
                var checkedInput = 0;
                var display = true;
                var i;
                var price = {{ $product->base_price }};
                var maxPrice = price;
                var minimumPrice = {{ $product->minimum_price }};

                $('.radio__input').each(function () {
                    if($(this).is(':checked')) {
                        checkedInput++;
                        var radioValue = parseFloat($(this).data('price'));
                        var radioValueType = $(this).data('price-type');

                        if (radioValueType === 'percent') {
                            radioValue = radioValue * maxPrice / 100;
                        }
                        price = price + radioValue;
                    }
                    else {
                        display = false;
                    }

                    if (price < minimumPrice) {
                        price = minimumPrice;
                    }

                });

                if (checkedInput >= totalDiv) display = true;
                price = Math.ceil(price);
                if (display) {
                    $("#price").text(new Intl.NumberFormat('tr-TR', { style: 'currency', currency: 'TRY',maximumSignificantDigits: 4 }).format(parseFloat(price.toFixed(0)),2));
                    $("#satButton").prop("disabled", false);
                    $("#takas").text(new Intl.NumberFormat('tr-TR', { style: 'currency', currency: 'TRY',maximumSignificantDigits: 4 }).format(parseFloat((price * 1.1).toFixed(0)),0));
                    $('#prices').show();
                    $('#prices').removeClass('d-none');
                }
            })
        });
    </script>
@endpush
