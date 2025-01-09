<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background"
                            style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Quản lý bài hát</h3>
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
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
            <div class="row my-4">
                <div class="col-lg-12 col-md-12">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="pb-3 d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Danh sách Bài hát</h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-dark me-2 mb-0" data-bs-toggle="modal" data-bs-target="#addsong">
                                        Thêm bài hát
                                    </button>
                                    <form class="input-group w-sm-25 ms-auto flex-grow-1" method="GET" action="{{ route('songs.search') }}">
                                        @csrf
                                        <input name="find" type="text" class="form-control" placeholder="Tìm kiếm" value="{{ request('find') }}">
                                        <button type="submit" class="mb-0 btn btn-primary">Tìm</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr class="">
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Tên bài hát</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Lượt nghe</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Thời gian phát hành
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nghệ sĩ</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Thể loại</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Album</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($songs && count($songs) > 0)
                                        @foreach ($songs as $song)  
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{ $song->SONG_NAME }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-normal mb-0">{{ $song->VIEWS }}</p>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-normal">{{ $song->RELEASE_TIME }}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-normal">{{ $song->ARTISTS_NAMES }}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-normal">{{ $song->CATEGORIES }}</span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-normal">{{ $song->ALBUM_NAME }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('songs.show', $song->SONG_ID) }}" class="text-secondary font-weight-bold text-xs">
                                                    Sửa
                                                </a>
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
            </div>
            <x-app.footer />
        </div>
        <div class="modal fade" id="addsong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bài hát</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('songs.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên bài hát</label>
                                <input name="name" type="text" class="form-control" placeholder="Nơi này có anh" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nghệ sĩ</label>
                                <select name="artist1" class="form-select" aria-label="Chọn bài hát" required>
                                    @foreach ($artists as $artist)
                                        <option value="{{$artist->id}}">{{$artist->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nghệ sĩ khác(nếu có)</label>
                                <select name="artist2" class="form-select" aria-label="Chọn bài hát" required>
                                    <option selected value="0">Không có</option>
                                    @foreach ($artists as $artist)
                                        <option value="{{$artist->id}}">{{$artist->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thể loại</label>
                                <select name="category1" class="form-select" aria-label="Chọn nghệ sĩ biểu diễn" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thể loại khác(nếu có)</label>
                                <select name="category2" class="form-select" aria-label="Chọn nghệ sĩ biểu diễn" required>
                                    <option selected value="0">Không có</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lượt nghe</label>
                                <input name="views" type="text" class="form-control" placeholder="100000" required>
                            </div>
                            <button type="submit" class="btn btn-dark" id="add-to-session">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>
