<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Certification;
use App\Models\CompanySetting;
use App\Models\Portfolio;
use App\Models\TeamMember;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->latest('updated_at')
            ->get()
            ->values()
            ->map(function (Portfolio $p) {
                $cat = strtolower($p->category ?? '');
                $filter = str_contains($cat, 'interior')
                    ? 'interior'
                    : (str_contains($cat, 'renov') || str_contains($cat, 'restor')
                        ? 'renovasi'
                        : (str_contains($cat, 'landscape') ? 'landscape' : 'gedung'));

                return [
                    'id' => $p->id,
                    'title' => $p->title,
                    'cat' => $p->category,
                    'filter' => $filter,
                    'loc' => $p->location ?: '-',
                    'year' => (string) ($p->year ?: '-'),
                    'area' => $p->area ?: '-',
                    'client' => $p->client ?: '-',
                    'desc' => $p->description,
                    'img' => $p->image,
                ];
            })
            ->all();

        $settings = CompanySetting::current()->publicData();

        $certifications = Certification::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $team = TeamMember::query()
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $bookedSlots = Appointment::query()
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['date', 'time'])
            ->map(fn ($a) => $a->date->format('Y-n-j') . '|' . substr($a->time, 0, 5))
            ->values()
            ->all();

        return view('landing', compact(
            'portfolios',
            'settings',
            'certifications',
            'team',
            'bookedSlots'
        ));
    }
}
