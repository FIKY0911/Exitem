<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        $totalUsers = User::where('role', 'customer')->count();
        $dailyTransactions = Transaction::whereDate('created_at', today())->count();
        $paidTransactions = Transaction::where('is_paid', true)->count();
        $totalTransactions = Transaction::count();
        $satisfactionRate = $totalTransactions > 0 
            ? round(($paidTransactions / $totalTransactions) * 100) 
            : 99;

        return view('livewire.pages.about', [
            'heroTitle'     => Setting::get('about_hero_title',     'Elevating Excellence'),
            'heroSubtitle'  => Setting::get('about_hero_subtitle',  ''),
            'storyHeadline' => Setting::get('about_story_headline', 'Toko Elektronik Terpercaya Anda'),
            'storyText1'    => Setting::get('about_story_text1',    ''),
            'storyText2'    => Setting::get('about_story_text2',    ''),
            'stats'         => [
                ['value' => number_format($totalUsers), 'label' => 'Happy Users'],
                ['value' => number_format($dailyTransactions), 'label' => 'Daily Transactions'],
                ['value' => $satisfactionRate . '%', 'label' => 'Satisfaction Rate'],
            ],
            'vision'      => Setting::get('about_vision',    ''),
            'mission'     => array_filter([
                Setting::get('about_mission_1', ''),
                Setting::get('about_mission_2', ''),
                Setting::get('about_mission_3', ''),
            ]),
            'teamMembers' => TeamMember::orderBy('order')->get(),
        ])->layout('components.layouts.app');
    }
}
