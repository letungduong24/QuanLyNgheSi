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
                <form method="GET" action="{{route('performance.resultBulb')}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Chọn thể loại cần hợp tác</label>
                                <select name="category" class="form-select" aria-label="Chọn nghệ sĩ biểu diễn" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark" id="add-to-session">Gợi ý</button>
                </form>
                
        </div>
                
        </div>
    </main>

</x-app-layout>
