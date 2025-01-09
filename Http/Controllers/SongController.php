<?php

namespace App\Http\Controllers;

use App\Models\Song;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $artists = DB::select(query: 'SELECT * FROM artists');
        $categories = DB::select(query: 'SELECT * FROM categories');
        $albums = DB::select(query: 'SELECT * FROM albums');
        $songs = DB::select('SELECT * from GETSONG() ORDER BY RELEASE_TIME DESC');
        

        // Trả về view và truyền dữ liệu
        return view('songs.index', compact('songs', 'artists', 'categories', 'albums'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $name = $request->input('name');
            $release_time = Carbon::now()->toDateString();
            $album_id = $request->input('album');
            $views = $request->input('views');
            $artist1 = $request->input('artist1');
            $category1 = $request->input('category1');
            $artist2 = $request->input('artist2');
            $category2 = $request->input('category2');
            $songid = 0;

            DB::statement('EXEC InsertSong @name = ?, @release_time = ?, @album_id = ?, 
                                @views = ?, @artist1 = ?, @category1 = ?, @artist2 = ?, @category2 = ?, @songid = ? OUTPUT',
                [$name, $release_time, $album_id, $views, $artist1, $category1, $artist2, $category2, &$songid]);

            return redirect()->route('songs.index')->with('success', 'Bài hát đã được thêm thành công.');
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error('Lỗi khi gọi stored procedure: ' . $ex->getMessage());
            return redirect()->route('songs.index')
                ->with('error', 'Đã có lỗi xảy ra khi thêm bài hát. Chi tiết lỗi: ' . $ex->getMessage());
        }
    }

    public function search(Request $request)
    {
        $artists = DB::select(query: 'SELECT * FROM artists');
        $categories = DB::select('SELECT * FROM categories');
        $albums = DB::select('SELECT * FROM albums');
        $songs = DB::select('SET NOCOUNT ON; EXEC Search_Song ?', [$request->input('find')]);
        return view('songs.index', compact('songs', 'artists', 'categories', 'albums'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $song = DB::select('SELECT * FROM GETSONG() WHERE SONG_ID = ?', [$id]);
        $song = $song[0] ?? null;
        return view('songs.edit', compact('song'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $views = $request->input('views');
        DB::statement('UPDATE SONGS SET VIEWS = ? WHERE ID = ?',
            [$views, $id]);

        return redirect()->route('songs.show', $id)->with('success', 'Đã cập nhật lượt nghe của bài hát.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::delete('DELETE FROM SONGS WHERE ID = ?', [$id]);
            return redirect()->route('songs.index', $id)->with('success', 'Đã xóa bài hát thành công.');
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->getCode(); 
            $errorMessage = $ex->getMessage();
            
            if (str_contains($errorMessage, 'Không thể xóa bài hát nằm trong lịch trình sắp tới.')) {
                return redirect()->route('songs.show',$id)
                    ->with('error', 'Không thể xóa bài hát nằm trong lịch trình sắp tới.');
            }
            if (str_contains($errorMessage, 'Không thể xóa bài hát đang nằm trong album.')) {
                return redirect()->route('songs.show',$id)
                    ->with('error', 'Không thể xóa bài hát đang nằm trong album.');
            }
            return redirect()->route('songs.show',$id)
                ->with('error', 'Đã xảy ra lỗi không xác định khi xóa bài hát.');
        }
    }
}
