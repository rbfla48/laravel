<x-userBasic-layout>


    <!-- 중간 이미지 슬라이드 -->
    <div id="carouselExampleSlidesOnly" class="carousel slide mt-100" data-bs-ride="carousel">
        <div class="carousel-inner"  style="width:100%; height:350px">    
            @foreach($banner as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                    <img src="{{$item->banner_url}}" class="d-block w-100" alt="...">
                </div>
            @endforeach
        </div>
    </div>

    <!-- 상품 타일 리스트 -->
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <img src="product1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Description of Product 1.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="product2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Description of Product 2.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Description of Product 3.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-userBasic-layout>
