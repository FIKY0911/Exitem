<?php

namespace App\Livewire\Pages;

use App\Models\Setting;
use App\Models\TeamMember;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.pages.about', [
            'heroTitle'     => Setting::get('about_hero_title',     'Elevating Excellence'),
            'heroSubtitle'  => Setting::get('about_hero_subtitle',  ''),
            'storyHeadline' => Setting::get('about_story_headline', 'Toko Elektronik Terpercaya Anda'),
            'storyText1'    => Setting::get('about_story_text1',    ''),
            'storyText2'    => Setting::get('about_story_text2',    ''),
            'stats'         => [
                ['value' => Setting::get('about_stat1_value', '15K+'), 'label' => Setting::get('about_stat1_label', 'Happy Users')],
                ['value' => Setting::get('about_stat2_value', '500+'), 'label' => Setting::get('about_stat2_label', 'Daily Transactions')],
                ['value' => Setting::get('about_stat3_value', '99%'),  'label' => Setting::get('about_stat3_label', 'Satisfaction Rate')],
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
