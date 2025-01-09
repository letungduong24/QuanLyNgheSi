<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng SQL thô để lấy tất cả các nghệ sĩ
        $topArtists = DB::select('SELECT *FROM Get_Top3_Artists');
        $topAlbums = DB::select('SELECT *FROM GET_ALL_TOP10_ALBUMS');
        $topSongs = DB::select('SELECT TOP 10 * FROM GETSONG() ORDER BY VIEWS DESC');
        $countAll = DB::select('SELECT * FROM countall()');
        $hotCategory = DB::select('SELECT * FROM HOT_CATEGORY');
        $hotCategory = $hotCategory[0];
        $countAllData = $countAll[0];
        return view('dashboard', compact('topArtists','topAlbums', 'topSongs', 'countAllData', 'hotCategory'));
    }

    public function indexActive()
    {
        // Sử dụng SQL thô để lấy tất cả các nghệ sĩ
        $artists = DB::select('SELECT * FROM artists WHERE status = 1');
    
        // Trả về view và truyền dữ liệu
        return view('artists.index', compact('artists'));
    }

    public function indexDeactive()
    {
        // Sử dụng SQL thô để lấy tất cả các nghệ sĩ
        $artists = DB::select('SELECT * FROM artists WHERE status = 0');
    
        // Trả về view và truyền dữ liệu
        return view('artists.index', compact('artists'));
    }

    public function top3Artists()
    {
        // Sử dụng SQL thô để lấy tất cả các nghệ sĩ
        $topArtists = DB::select('SELECT * FROM top3_artists()');
    
        // Trả về view và truyền dữ liệu
        return view('dashboard', compact('topArtists'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
