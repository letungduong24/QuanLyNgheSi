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
            <x-app.footer />
        </div>
        <div class="container">
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead class="bg-gray-100">
                            <tr class="">
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                    Mã bài hát</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                    Tên bài hát</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nghệ sĩ
                                </th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Số lần được biểu diễn
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($songs)
                            @foreach ($songs as $song)  
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">{{ $song->SONG_ID }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">{{ $song->SONG_NAME }}</p>
                                </td>
                                <td>
                                    <span class="text-sm font-weight-normal">{{ $song->ARTISTS_NAMES }}</span>
                                </td>
                                <td>
                                    <span class="text-sm font-weight-normal">{{ $song->USETIME }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy bài hát nào.</td>
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
