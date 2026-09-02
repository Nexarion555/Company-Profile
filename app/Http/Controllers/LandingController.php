<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Certification;
use App\Models\CompanySetting;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $settings = CompanySetting::current()->publicData();

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $portfolioCollection = Portfolio::query()
            ->with('service:id,title,is_active')
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereHas('service', fn ($serviceQuery) => $serviceQuery->where('is_active', true))
                    ->orWhereNull('service_id'); // Data lama tetap terlihat sampai admin memilih layanan.
            })
            ->orderBy('display_order')
            ->orderByDesc('updated_at')
            ->get();

        $portfolios = $portfolioCollection
            ->values()
            ->map(function (Portfolio $p) {
                $serviceId = $p->service_id;
                $category = $p->categoryLabel();

                return [
                    'id' => $p->id,
                    'title' => $p->title,
                    'service_id' => $serviceId,
                    'cat' => $category,
                    'filter' => $serviceId ? 'service-'.$serviceId : 'uncategorized',
                    'loc' => $p->location ?: '-',
                    'year' => $p->year ? (string) $p->year : '-',
                    'area' => $p->area ?: '-',
                    'client' => $p->client ?: '-',
                    'desc' => $p->description,
                    'img' => $p->image,
                ];
            })
            ->all();

        // Tombol kategori Portofolio sepenuhnya berasal dari Layanan aktif
        // yang sudah dibuat di Admin Panel. Tidak ada kategori hard-coded.
        $portfolioCategories = $services
            ->map(fn (Service $service) => [
                'id' => $service->id,
                'title' => $service->title,
                'filter' => 'service-'.$service->id,
            ])
            ->values()
            ->all();

        $certifications = Certification::query()
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $team = TeamMember::query()
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();

        $testimonials = Testimonial::query()
            ->with('service:id,title')
            ->where('status', 'published')
            ->orderBy('display_order')
            ->orderByDesc('updated_at')
            ->get();

        $bookedSlots = Appointment::query()
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['date', 'time'])
            ->map(fn ($a) => $a->date->format('Y-n-j') . '|' . substr($a->time, 0, 5))
            ->values()
            ->all();

        return view('landing', compact(
            'portfolios',
            'portfolioCategories',
            'settings',
            'services',
            'certifications',
            'team',
            'testimonials',
            'bookedSlots'
        ));
    }
}
