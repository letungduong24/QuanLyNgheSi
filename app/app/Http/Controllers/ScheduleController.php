<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\Song;
use DB;
use Illuminate\Http\Request;
use PDO;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Chạy stored procedure và lấy kết quả về dưới dạng mảng kết hợp
        $schedulesEmpty = DB::select('SET NOCOUNT ON; EXEC Check_Empty_Schedules');
        $schedules = DB::select('SELECT * FROM schedules order by status desc');
        return view('schedules.index', compact('schedules', 'schedulesEmpty'));
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
            $time = $request->input('time');
            $address = $request->input('address');
            $status = $request->input('status');

            DB::statement('INSERT INTO SCHEDULES (NAME, TIME, ADDRESS, STATUS) VALUES (?,?,?,?)',
                [$name, $time, $address, $status]);
            return redirect()->route('schedules.index')->with('success', 'Đã thêm lịch trình thành công.');
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorMessage = $ex->getMessage();
            if (str_contains($errorMessage, 'Ngày bắt đầu lịch trình phải lớn hơn ngày hiện tại.')) {
                return redirect()->route('schedules.index')
                    ->with('error', 'Ngày bắt đầu lịch trình phải lớn hơn ngày hiện tại.');
            }
            if (str_contains($errorMessage, 'Lịch trình đã tồn tại trong ngày này.')) {
                return redirect()->route('schedules.index')
                    ->with('error', 'Lịch trình đã tồn tại trong ngày này.');
            }
            return redirect()->route('schedules.index')
                ->with('error', 'Đã có lỗi xảy ra khi thêm lịch trình. Chi tiết lỗi: ' . $ex->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Lấy thông tin của schedule dựa trên ID
        $schedule = DB::select('SELECT * FROM schedules WHERE id = ?', [$id]);
        $scheduleDetails = DB::select('SELECT * FROM dbo.schedule_detail(?)', [$id]);
        $schedule = $schedule[0];
        $artists = DB::select('SELECT * FROM artists WHERE status = 1 order by artists.name asc');
        $songs = DB::select('SELECT * FROM songs order by songs.name asc');
        return view('schedules.show', compact('schedule', 'scheduleDetails', 'artists', 'songs'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

}
