<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Hiệu suất</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row">
                <div class="col-2 mt-2">
                    <a href="{{route('performance.bulb')}}" class="btn btn-dark">Gợi ý hợp tác nghệ sĩ</a>
                </div>
                <div class="col-3 mt-2">
                    <a href="{{route('performance.lowPerformance')}}" class="btn btn-dark">Kiểm tra nghệ sĩ năng suất thấp</a>
                </div>
                <div class="col-3 mt-2">
                    <a href="{{route('performance.artistsActivity')}}" class="btn btn-dark">Kiểm tra hoạt động của nghệ sĩ</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.trendingSongs')}}" class="btn btn-dark">Bài hát được ưa chuộng</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.comingSchedules')}}" class="btn btn-dark">Kiểm tra lịch trình sắp tới</a>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
