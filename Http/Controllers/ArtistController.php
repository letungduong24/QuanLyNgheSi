<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng SQL thô để lấy tất cả các nghệ sĩ
        $artists = DB::select(query: 'SELECT * FROM artists');
        $artistsWithCategories = array_map(function ($artist) {
            $artist->categories = DB::selectOne('SELECT dbo.artist_category(?) AS categories', [$artist->id])->categories;
            return $artist;
        }, $artists);

        // Trả về view và truyền dữ liệu
        return view('artists.index', compact('artistsWithCategories'));
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
        $gender = $request->input('gender');
        $birthday = $request->input('birthday');
        $artist_field = $request->input('artist_field');
        $expired_time = $request->input('expired_time');
        $join_time = Carbon::now()->toDateString();
        $status = 1;

        DB::statement('INSERT INTO ARTISTS (NAME, GENDER, BIRTHDAY, ARTIST_FIELD, EXPIRED_TIME, JOIN_TIME, STATUS) VALUES (?,?,?,?,?,?,?)',
                [$name, $gender, $birthday, $artist_field, $expired_time, $join_time, $status]);
            return redirect()->route('artists.index')->with('success', 'Đã thêm nghệ sĩ thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedules = DB::select('SET NOCOUNT ON; EXEC Get_Artist_Schedules ?', [$id]);
        $artist = DB::select('SELECT * FROM artists where id=?', [$id]);
        $artistSalary = DB::select('SELECT DBO.GET_ARTIST_SALARY(?) AS SALARY', [$id]);
        $artistSongs = DB::select('SELECT *FROM GET_ALL_ARTIST_SONGS(?)', [$id]);
        $artist = $artist[0] ?? null;
        $artistSalary = $artistSalary[0] ?? null;
        return view('artists.show', compact('artist', 'artistSalary', 'artistSongs', 'schedules'));
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
    public function update(Request $request, $id)
    {
        $type = $request->input('type');
        try {
            // Thực hiện câu lệnh DELETE từ DB
            DB::update('UPDATE ARTISTS SET TYPE = ? WHERE ID=?', [$type, $id]);
            return redirect()->route('artists.show', $id)->with('success', 'Đã cập nhật bậc của nghệ sĩ.');
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->getCode(); 
            $errorMessage = $ex->getMessage();
            
            if (str_contains($errorMessage, 'Không thể cập nhật Hạng')) {
                return redirect()->route('artists.show',$id)
                    ->with('error', 'Lượt nghe không đủ yêu cầu để cập nhật bậc.');
            }
            return redirect()->route('artists.show',$id)
                ->with('error', 'Đã xảy ra lỗi không xác định khi cập nhật bậc.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($artist)
    {
        try {
            // Thực hiện câu lệnh DELETE từ DB
            DB::delete('DELETE FROM ARTISTS WHERE ID = ?', [$artist]);
            return redirect()->route('artists.show', $artist)->with('success', 'Đã chuyển nghệ sĩ sang trạng thái dừng hoạt động.');
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->getCode(); 
            $errorMessage = $ex->getMessage();
            
            if (str_contains($errorMessage, 'Nghệ sĩ đã ở trạng thái dừng hoạt động.')) {
                return redirect()->route('artists.show',$artist)
                    ->with('error', 'Nghệ sĩ đã ở trạng thái dừng hoạt động.');
            }
            return redirect()->route('artists.show',$artist)
                ->with('error', 'Đã xảy ra lỗi không xác định khi lưu tiết mục.');
        }
    }

}
