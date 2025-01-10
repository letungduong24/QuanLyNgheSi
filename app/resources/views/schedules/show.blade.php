<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-2 py-4 container-fluid ">
                <div class="mt-2 mb-5 mt-lg-9 row justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="card card-body" id="profile">
                            <img src="../../../assets/img/header-orange-purple.jpg" alt="pattern-lines"
                                class="top-0 rounded-2 position-absolute start-0 w-100 h-100">

                            <div class="row z-index-2 justify-content-center align-items-center">
                                
                                <div class="col-sm-auto col-8 my-auto">
                                    <div class="h-100">
                                        <h5 class="mb-1 font-weight-bolder">
                                            Chi tiết lịch trình: {{$schedule->name}}
                                        </h5>
                                        <span class="badge badge-sm border 
                                                @if ($schedule->status == 1) 
                                                    border-success text-success bg-success
                                                @else 
                                                    border-danger text-danger bg-danger
                                                @endif">
                                                @if ($schedule->status == 1)
                                                    Đang diễn ra
                                                @else
                                                    Đã kết thúc
                                                @endif
                                        </span>
                                        <p class="my-0">Thời gian: {{$schedule->time}}</p>
                                        <p class="my-0">Địa điểm: {{$schedule->address}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                    <a href="{{route('schedules.index')}}" class="btn btn-dark">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header d-flex justify-content-between">
                                <h5>Danh sách tiết mục</h5>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addtoschedule">
  Thêm tiết mục vào lịch trình
</button>
                            </div>
                            <div class="pt-0 card-body">
                            <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên bài hát
                                            </th>
                                            <th class="d-flex justify-content-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên nghệ sĩ
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Tiền công
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scheduleDetails as $scheduleDetail)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center align-items-center ms-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">{{$scheduleDetail->SONG}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$scheduleDetail->ARTIST}}</p>
                                            </td>
                                            <td>
                                                <p class="d-flex justify-content-start text-sm text-dark font-weight-semibold mb-0 ">{{$scheduleDetail->CAST}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


<!-- Modal -->
        <div class="modal fade" id="addtoschedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm tiết mục vào lịch trình</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="add-to-schedule-form" action="{{route('scheduledetails.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="song" class="form-label">Bài hát</label>
                                <select name="song_id" class="form-select" aria-label="Chọn bài hát" required>
                                    @foreach ($songs as $song)
                                        <option value="{{$song->id}}">{{$song->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="artist" class="form-label">Nghệ sĩ biểu diễn</label>
                                <select name="artist_id" class="form-select" aria-label="Chọn nghệ sĩ biểu diễn" required>
                                    @foreach ($artists as $artist)
                                        <option value="{{$artist->id}}">{{$artist->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cast" class="form-label">Tiền công</label>
                                <input name="cast" type="text" class="form-control" placeholder="100000" required>
                            </div>
                            <input type="text" value="{{$schedule->id}}" hidden name="schedule_id">
                            <button type="submit" class="btn btn-dark" id="add-to-session">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
        </div>
    </main>
</x-app-layout>
