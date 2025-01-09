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
                                            Bài hát: {{$song->SONG_NAME}}
                                        </h5>
                                        
                                        <p class="my-0">Nghệ sĩ: {{$song->ARTISTS_NAMES}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                    <form action="{{ route('songs.destroy', $song->SONG_ID)}}" method="POST" style="display: inline-block;"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" name="id" class="btn btn-danger  me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button> 
                                    </form> 
                                    <a href="{{route('songs.index')}}" class="btn btn-dark">Quay lại</a>
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
                <div class="container">
                <form method="POST" action="{{route('songs.update', $song->SONG_ID)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Lượt nghe</label>
                                <input name="views" type="text" class="form-control" value="{{$song->VIEWS}}" required>
                            </div>
                            <button type="submit" class="btn btn-dark" id="add-to-session">Sửa</button>
                </form>
                </div>
        </div>


<!-- Modal -->
        
        <x-app.footer />
        </div>
    </main>
</x-app-layout>
