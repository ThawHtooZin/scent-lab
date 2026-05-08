<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ScentMatchProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScentMatchController extends Controller
{
    public function create(): View
    {
        return view('storefront.scent-match');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'daily_environment' => ['required', 'in:office,outdoors,hybrid'],
            'energy_style' => ['required', 'in:grounded,balanced,high'],
            'scent_impression' => ['required', 'in:clean,bold,approachable'],
            'climate_profile' => ['required', 'in:cool,humid,windy'],
            'social_density' => ['required', 'in:solo,small,crowded'],
            'longevity_goal' => ['required', 'in:soft,long,all_day'],
        ]);

        $match = $this->evaluate($data);

        $record = ScentMatchProfile::create([
            'user_id' => Auth::id(),
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? session('order_email'),
            'daily_environment' => $data['daily_environment'],
            'energy_style' => $data['energy_style'],
            'scent_impression' => $data['scent_impression'],
            'climate_profile' => $data['climate_profile'],
            'social_density' => $data['social_density'],
            'longevity_goal' => $data['longevity_goal'],
            'profile_key' => $match['key'],
            'profile_name' => $match['profile'],
            'headline' => $match['headline'],
            'reason' => $match['reason'],
            'recommended_products' => $match['recommendation_names'],
        ]);

        if (! empty($data['email'])) {
            session(['order_email' => $data['email']]);
        }

        return redirect()->route('scent-match.show', $record);
    }

    public function show(ScentMatchProfile $scentMatch): View
    {
        $products = Product::query()
            ->whereIn('name', $scentMatch->recommended_products ?? [])
            ->orderBy('display_order')
            ->get();

        return view('storefront.scent-match-result', [
            'match' => $scentMatch,
            'products' => $products,
        ]);
    }

    private function evaluate(array $data): array
    {
        $scores = [
            'executive' => 0,
            'adventurer' => 0,
            'commuter' => 0,
        ];

        $this->addScores($scores, 'daily_environment', $data['daily_environment']);
        $this->addScores($scores, 'energy_style', $data['energy_style']);
        $this->addScores($scores, 'scent_impression', $data['scent_impression']);
        $this->addScores($scores, 'climate_profile', $data['climate_profile']);
        $this->addScores($scores, 'social_density', $data['social_density']);
        $this->addScores($scores, 'longevity_goal', $data['longevity_goal']);

        arsort($scores);
        $winner = array_key_first($scores);

        return match ($winner) {
            'adventurer' => [
                'key' => 'adventurer',
                'profile' => 'The Adventurer',
                'headline' => 'Vivid lift for heat, movement, and open air.',
                'reason' => 'You show high-energy and climate-demanding patterns, so your profile favors projection and freshness stability under pressure.',
                'recommendation_names' => ['Solar Citrus', 'Azure Tide'],
            ],
            'commuter' => [
                'key' => 'commuter',
                'profile' => 'The Commuter',
                'headline' => 'Personal freshness that stays socially graceful.',
                'reason' => 'Your answers point to dynamic routines around people, so your match emphasizes clean comfort and crowd-aware diffusion.',
                'recommendation_names' => ['Metro Mint', 'Civic Bloom'],
            ],
            default => [
                'key' => 'executive',
                'profile' => 'The Executive',
                'headline' => 'Elegant clarity for focused, controlled spaces.',
                'reason' => 'Your profile leans refined and intentional, optimized for polished indoor presence with smooth, non-intrusive projection.',
                'recommendation_names' => ['Arctic Linen', 'Silk Morning'],
            ],
        };
    }

    private function addScores(array &$scores, string $question, string $answer): void
    {
        $map = [
            'daily_environment' => [
                'office' => ['executive' => 3, 'commuter' => 1],
                'outdoors' => ['adventurer' => 3],
                'hybrid' => ['commuter' => 2, 'adventurer' => 1, 'executive' => 1],
            ],
            'energy_style' => [
                'grounded' => ['executive' => 2],
                'balanced' => ['commuter' => 2, 'executive' => 1],
                'high' => ['adventurer' => 3],
            ],
            'scent_impression' => [
                'clean' => ['executive' => 2, 'commuter' => 1],
                'bold' => ['adventurer' => 3],
                'approachable' => ['commuter' => 2],
            ],
            'climate_profile' => [
                'cool' => ['executive' => 2],
                'humid' => ['adventurer' => 3],
                'windy' => ['adventurer' => 2, 'commuter' => 1],
            ],
            'social_density' => [
                'solo' => ['executive' => 2],
                'small' => ['executive' => 1, 'commuter' => 1],
                'crowded' => ['commuter' => 3],
            ],
            'longevity_goal' => [
                'soft' => ['executive' => 2],
                'long' => ['adventurer' => 2],
                'all_day' => ['commuter' => 2, 'adventurer' => 1],
            ],
        ];

        foreach (($map[$question][$answer] ?? []) as $key => $value) {
            $scores[$key] += $value;
        }
    }
}
