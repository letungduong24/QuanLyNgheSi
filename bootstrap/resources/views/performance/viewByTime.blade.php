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
                <div class="col-2 mt-2">
                    <a href="{{route('performance.lowPerformance')}}" class="btn btn-dark">Kiểm tra nghệ sĩ năng suất thấp</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.artistsActivity')}}" class="btn btn-dark">Kiểm tra hoạt động của nghệ sĩ</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.trendingSongs')}}" class="btn btn-dark">Bài hát được ưa chuộng</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.comingSchedules')}}" class="btn btn-dark">Kiểm tra lịch trình sắp tới</a>
                </div>
                <div class="col-2 mt-2">
                    <a href="{{route('performance.viewByTime')}}" class="btn btn-dark">Thống kê lượt nghe theo khoảng thời gian</a>
                </div>
            </div>
            </div>
            <x-app.footer />
        </div>
        <div class="container">
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead class="bg-gray-100">
                            <tr class="">
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                    Khoảng thời gian</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                    Lượt nghe</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($times)
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">1970-1980</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">{{ $times->TIME1 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">1981-1990</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">{{ $times->TIME2 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">1991-2000</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">{{ $times->TIME3 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">2001 - nay</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">{{ $times->TIME4 }}</p>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có lịch trình nào sắp tới.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                
        </div>
    </main>

</x-app-layout>
