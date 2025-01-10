<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('performance.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function bulb(Request $request)
    {
        $categories = DB::select('SELECT * FROM categories');
        return view('performance.bulb', compact('categories'));
    }
    public function resultBulb(Request $request)
    {
        $categories = DB::select('SELECT * FROM categories');
        $artists = DB::select('SET NOCOUNT ON; EXEC GET_ARTISTS_BY_CATEGORY ?', [$request->input('category')]);
        return view('performance.resultBulb', compact('artists', 'categories'));
    }

    public function lowPerformance()
    {
        $artists = DB::select('SET NOCOUNT ON; EXEC GET_ARTISTS_LOW_PERFORMANCE');
        return view('performance.lowPerformance', compact('artists'));
    }

    public function artistsActivity()
    {
        $activities = DB::select('SELECT *FROM ARTISTS_ACTIVITY');
        return view('performance.artistsActivity', compact('activities'));
    }

    public function trendingSongs()
    {
        $songs = DB::select('SELECT TOP 10 *FROM TRENDING_SONG ORDER BY USETIME DESC');
        return view('performance.trendingSongs', compact('songs'));
    }

    public function comingSchedules()
    {
        $schedules = DB::select('SELECT *FROM COMING_SOON_SCHEDULES');
        return view('performance.comingSchedules', compact('schedules'));
    }

    public function viewByTime()
    {
        $times = DB::select('SELECT *FROM SONGS_VIEWS_BY_TIME');
        $times = $times[0];
        return view('performance.viewByTime', compact('times'));
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
