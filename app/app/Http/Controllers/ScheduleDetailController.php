<?php

namespace App\Http\Controllers;

use App\Models\ScheduleDetail;
use DB;
use Illuminate\Http\Request;

class ScheduleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            DB::statement('INSERT INTO SCHEDULE_DETAILS(SCHEDULE_ID, SONG_ID, ARTIST_ID, CAST) VALUES (?, ?, ?, ?)', [
                $request->input('schedule_id'),
                $request->input('song_id'),
                $request->input('artist_id'),
                $request->input('cast')
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $errorCode = $ex->getCode(); 
            $errorMessage = $ex->getMessage();
            
            if (str_contains($errorMessage, 'Tiết mục đã tồn tại trong lịch trình')) {
                return redirect()->route('schedules.show', $request->input('schedule_id'))
                    ->with('error', 'Tiết mục đã tồn tại trong lịch trình.');
            } elseif (str_contains($errorMessage, 'Một lịch trình chỉ được phép có tối đa 7 tiết mục')) {
                return redirect()->route('schedules.show', $request->input('schedule_id'))
                    ->with('error', 'Lịch trình chỉ có thể chứa tối đa 7 tiết mục.');
            }
            return redirect()->route('schedules.show', $request->input('schedule_id'))
                ->with('error', 'Đã xảy ra lỗi không xác định khi lưu tiết mục.');
        }
        return redirect()->route('schedules.show', $request->input('schedule_id'))->with('success', 'Tiết mục đã được lưu thành công.');
    }   

    /**
     * Display the specified resource.
     */
    public function show(ScheduleDetail $scheduleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduleDetail $scheduleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduleDetail $scheduleDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleDetail $scheduleDetail)
    {
        //
    }
}
