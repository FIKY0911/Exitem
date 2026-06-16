<?php

namespace App\Livewire\Components;

use App\Models\Banner;
use Livewire\Component;

class HeroBanner extends Component
{
    public $categories = [];

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function render()
    {
        return view('livewire.components.hero-banner', [
            'banners' => Banner::active()->get(),
        ]);
    }
}
