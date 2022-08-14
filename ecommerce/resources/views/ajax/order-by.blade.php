<!-- Products Category -->
{{--                    @foreach($category->products as $product)--}}
@foreach($products as $product)

    @php
        // вызываем название метод $product->images() как свойство
        // dd($product->images);

        $image = '';

        // если у нас количество картинок продукта больше нуля
        // то выберем первую картинку
        if (count($product->images) > 0) {

            $image = $product->images[0]['img'];

        } else { // Иначе выводим просто картинку по умолчанию

            $image = 'no_image.png';
        }

    @endphp

    <div class="product">
        <div class="product_image">
            <img src="images/{{ $image }}" alt="{{ $product->title }}">
        </div>
        <div class="product_extra product_new">
            <a href="{{ route('show.category', $product->category['alias']) }}">
                {{ $product->category['title'] }}
            </a>
        </div>
        <div class="product_content">
            <div class="product_title">
                <a href="{{ route('show.product', ['category', $product->id]) }}">{{ $product->title }}</a>
            </div>

            @if($product->new_price != null)
                <div style="text-decoration: line-through">${{ $product->price }}</div>
                <div class="product_price">${{ $product->new_price }}</div>
            @else
                <div class="product_price">${{ $product->price }}</div>
            @endif

        </div>
    </div>
@endforeach
