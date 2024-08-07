<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuscriptorHistorial;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistorialController extends Controller
{
    public function dataHistorial()
    {
        $user = Auth::user();
        $suscriptorHistorial = SuscriptorHistorial::where('refered_code',$user->unique_code)->get();
        $plans = Plan::all();

        // Group data by year
        $historialByYear = $suscriptorHistorial->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y');
        });
        $planData = [];
        foreach ($historialByYear as $year => $data) {
            $planData[$year] = [];
            foreach ($plans as $plan) {
                $monthlyData = $data->where('plan_id', $plan->id)->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->month;
                })->map->sum('membership_collected')->toArray();
                $planData[$year][$plan->name] = [
                    'data' => array_values($monthlyData),
                    'months' => array_keys($monthlyData)
                ];
            }
        }

        // dd($planData);
        return view('suscriptor_data.historial', compact('historialByYear', 'plans','planData'));
    }
}
