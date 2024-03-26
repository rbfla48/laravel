<x-userBasic-layout>
    <main>
        <div class="container my-5">
            <div class="p-5 text-center bg-body-tertiary rounded-3">
                <div class="d-flex justify-content-center">
                    <img  class="img-responsive center-block" src="/images/kkrmall_logo.png">
                </div>
                <h1 class="mt-3 fs-2 text-body-emphasis">결제가 완료되었습니다</h1>
                <p class="mt-3 col-lg-8 mx-auto fs-5 text-muted">
                    주문확인은 <b>내정보 > 주문내역</b> 에서 확인가능합니다<br/>
                    배송 소요일은 약 2~3일 입니다.<br/>
                    문의사항은 고객문의를 이용해주세요<br/>
                    감사합니다.<br/>
                </p>
                <div class="mt-3 d-inline-flex gap-2 mb-5">
                    <button class="btn btn-dark bg-dark text-center btn-lg px-4 rounded-pill" type="button"  onclick="location.href='{{ route('home') }}'">
                        홈으로
                    </button>
                    <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button" onclick="location.href='#'">
                        주문내역 확인
                    </button>
                </div>
            </div>
        </div>
    </main>
</x-userBasic-layout>
