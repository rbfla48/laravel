<x-userBasic-layout>
    <main>
        <!-- 중간 이미지 슬라이드 -->
        <div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-bs-ride="carousel">
            <div class="carousel-indicators">       
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="width:100%; height:750px">
                @foreach($banner as $item)
                    <div
                        class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ $item->banner_url }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
        </div>

        <p class="fs-3 text-center mt-5">이번주 신규상품</p>

        <div class="d-flex justify-content-center">
            <div class="owl-carousel owl-theme w-75 p-4">
                @foreach($product as $list)
                <div class="item card p-3" onclick="location.href=('{{ route('productDetail',['id'=>$list->id]) }}')">
                    @if($list->normal > $list->price)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    @endif
                    <img src="{{ $list->content }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $list->product_name }}</h5>
                        <p class="text-decoration-line-through">&#x20a9; {{ number_format($list->normal) }}</p>
                        <p><span class="text-danger me-3">{{ $list->discount }}%</span>&#x20a9; {{ number_format($list->price) }}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    
        <script>
            //상품타일슬라이드
            $(function() {
                $('.owl-carousel').owlCarousel({
                    items: 3,
                    margin: 10,
                    loop: true,
                    autoplay:true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause:true
                });
            });
        </script>


</x-userBasic-layout>
