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
                                            Chi tiết nghệ sĩ: {{$artist->name}}
                                        </h5>
                                        <span class="badge badge-sm border 
                                                @if ($artist->status == 1) 
                                                    border-success text-success bg-success
                                                @else 
                                                    border-danger text-danger bg-danger
                                                @endif">
                                                @if ($artist->status == 1)
                                                    Đang hoạt động
                                                @else
                                                    Dừng hoạt động
                                                @endif
                                        </span>
                                        <p class="my-0">Bậc: {{$artist->type}}</p>
                                        <p class="my-0">Tổng thu nhập: {{$artistSalary->SALARY}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                    <button data-bs-toggle="modal" data-bs-target="#edittype" class="btn btn-warning me-2">Sửa bậc</button>
                                    <form action="{{ route('artists.destroy', $artist->id)}}" method="POST" style="display: inline-block;"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" name="id" class="btn btn-danger  me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button> 
                                    </form> 
                                    <a href="{{route('artists.index')}}" class="btn btn-dark">Quay lại</a>
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
                            <div class="card-header">
                                <h5>Danh sách bài hát</h5>
                            </div>
                            <div class="pt-0 card-body">
                            <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Tên bài hát
                                            </th>
                                            <th class="d-flex justify-content-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên nghệ sĩ</th>
                                            <th  class=" text-secondary text-xs font-weight-semibold opacity-7">
                                                Sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artistSongs as $artistSong)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center align-items-center ms-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">{{$artistSong->SONG_NAME}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$artistSong->ARTISTS_NAMES}}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg width="14" height="14" viewBox="0 0 15 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                            fill="#64748B" />
                                                    </svg>
                                                </a>
                                                <a href="{{route('songs.show', $artistSong->SONG_ID)}}" class="ms-2">Xem</a>
                                            </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Lịch trình</h5>
                            </div>
                            <div class="pt-0 card-body">
                            <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr class="row">
                                            <th class="col-1 text-secondary text-xs font-weight-semibold opacity-7">Mã lịch trình
                                            </th>
                                            <th class="col-2 d-flex justify-content-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên lịch trình</th>
                                            <th class="col-2 text-secondary text-xs font-weight-semibold opacity-7">
                                                Thời gian</th>
                                            <th class="col-3 text-secondary text-xs font-weight-semibold opacity-7">
                                                Địa điểm</th>
                                            <th class="col-2 text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên bài hát</th>
                                            <th class="col-2 text-secondary text-xs font-weight-semibold opacity-7">
                                                Tiền công</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($schedules)
                                        @foreach ($schedules as $schedule)
                                        <tr class="row">
                                            <td class="col-1">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center align-items-center ms-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">{{$schedule->SCHEDULE_ID}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-2">
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$schedule->SCHEDULE_NAME}}</p>
                                            </td>
                                            <td class="col-2">
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$schedule->SCHEDULE_TIME}}</p>
                                            </td>
                                            <td class="col-3">
                                                <p class="d-flex text-break text-wrap justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$schedule->SCHEDULE_ADDRESS}}</p>
                                            </td>
                                            <td class="col-2">
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$schedule->SONG_NAME}}</p>
                                            </td>
                                            <td class="col-2">
                                                <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">{{$schedule->CAST}}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <p class="d-flex justify-content-center text-sm text-dark font-weight-semibold mb-0 ">Không có lịch trình</p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal fade" id="edittype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm lịch trình</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="add-to-schedule-form" action="{{route('artists.update', $artist->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Bậc</label>
                                <select name="type" class="form-select" aria-label="Chọn bài hát" required>
                                    <option value="Hạng A" @if ($artist->type == 'Hạng A') selected @endif>
                                        Hạng A
                                    </option>
                                    <option value="Hạng B" @if ($artist->type == 'Hạng B') selected @endif>
                                        Hạng B
                                    </option>
                                    <option value="Hạng C" @if ($artist->type == 'Hạng C') selected @endif>
                                        Hạng C
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark" id="add-to-session">Sửa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
        </div>
    </main>

</x-app-layout>
