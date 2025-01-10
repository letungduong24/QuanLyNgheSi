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
                                            Chi tiết album: {{$album->albumname}}
                                        </h5>
                                        <p class="my-0">Thời gian phát hành: {{$album->release_time}}</p>
                                        <p class="my-0">Nghệ sĩ: {{$album->artistname}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                <form action="{{ route('albums.destroy', $album->id)}}" method="POST" style="display: inline-block;"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" name="id" class="btn btn-danger  me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button> 
                                    </form> 
                                    <a href="{{route('albums.index')}}" class="btn btn-dark">Quay lại</a>
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
                                <h5>Danh sách bài hát</h5>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addtoalbum">
                                    Thêm bài hát vào album
                                </button>
                            </div>
                            <div class="pt-0 card-body">
                            <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Tên bài hát
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            nghệ sĩ</th>   
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            </th>    
                                        </tr>
                                        <tr>
                                            
                                    </thead>
                                    <tbody>
                                        @foreach ($songsOfAlbum as $song)
                                        <tr>
                                            <td>
                                                <p class=" text-sm text-dark font-weight-semibold mb-0 ">{{$song->SONG_NAME}}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center align-items-center ms-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">{{$song->ARTISTS_NAMES}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <form action="{{ route('albums.remove', $album->id)}}" method="POST" style="display: inline-block;"> 
                                                @csrf 
                                                @method('PUT') 
                                                <button type="submit" value="{{$song->SONG_ID}}" name="id" class="btn btn-danger  me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button> 
                                            </form> 
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
        <x-app.footer />
        </div>
        <div class="modal fade" id="addtoalbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bài hát vào album</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="add-to-schedule-form" action="{{route('albums.add', $album->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="song" class="form-label">Bài hát</label>
                                <select name="song_id" class="form-select" aria-label="Chọn bài hát" required>
                                    @foreach ($songs as $song)
                                        <option value="{{$song->id}}">{{$song->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark" id="add-to-session">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>
