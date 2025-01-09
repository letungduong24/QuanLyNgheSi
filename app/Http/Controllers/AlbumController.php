<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = DB::select(query: 'SELECT * FROM artists');
        $albums = DB::select('SELECT albums.id, albums.name as albumname, albums.release_time, artists.name as artistname from albums, artists where albums.artist_id = artists.id order by release_time desc');
        

        // Trả về view và truyền dữ liệu
        return view('albums.index', compact('albums', 'artists'));
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
            $name = $request->input('name');
            $release_time = Carbon::now()->toDateString();
            $artist = $request->input('artist');

            DB::statement('INSERT INTO ALBUMS (NAME, RELEASE_TIME, ARTIST_ID) VALUES (?,?,?)',
                [$name, $release_time, $artist]);

            return redirect()->route('albums.index')->with('success', 'Albums đã được thêm thành công.');

    }
    public function add(Request $request, $id)
    {
            $song = $request->input('song_id');
            DB::statement('UPDATE SONGS SET ALBUM_ID = ? WHERE ID = ?',
                [$id, $song]);

            return redirect()->route('albums.show', $id)->with('success', 'Đã thêm bài hát vào album.');
    }
    public function remove(Request $request, $id)
    {
            $song = $request->input('id');
            DB::statement('UPDATE SONGS SET ALBUM_ID = NULL WHERE ID = ?',
                [$song]);

            return redirect()->route('albums.show', $id)->with('success', 'Đã xóa bài hát khỏi album.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $songs = DB::select('SELECT * FROM songs where album_id IS NULL order by songs.name asc');
        $album = DB::select('SELECT albums.id, albums.name as albumname, albums.release_time, artists.name as artistname from albums, artists where albums.artist_id = artists.id and albums.id=?', [$id]);
        $album = $album[0] ?? null;
        $songsOfAlbum = DB::select('SELECT * from DBO.GETSONG() where ALBUM_ID = ?', [$id]);;
        return view('albums.show', compact('album', 'songsOfAlbum', 'songs'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Thực hiện câu lệnh DELETE từ DB
            DB::delete('DELETE FROM albums WHERE ID = ?', [$id]);
            return redirect()->route('albums.index')->with('success', 'Đã xóa album thành công.');
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->getCode(); 
            $errorMessage = $ex->getMessage();
            
            if (str_contains($errorMessage, 'Không thể xóa album có bài hát bên trong.')) {
                return redirect()->route('albums.show',$id)
                    ->with('error', 'Không thể xóa album có bài hát bên trong.');
            }
            return redirect()->route('albums.show',$id)
                ->with('error', 'Đã xảy ra lỗi không xác định xóa album.');
        }
    }
}
