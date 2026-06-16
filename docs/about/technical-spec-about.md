# 🛠️ Technical Specification (Tech Spec)
**Module:** About Us Page
**Stack:** Laravel 12, Livewire 3, Alpine.js, Swiper.js

## 1. Arsitektur Komponen Livewire
* **Full-Page Component:** `app/Livewire/Pages/About.php`
  * **Tugas:** Menangani logika pemanggilan data (jika statistik dan tim ditarik dari *database*).
  * **View:** `resources/views/livewire/pages/about.blade.php`

## 2. Manajemen State & Properti
Jika data dibuat dinamis (direkomendasikan):
```php
class About extends Component
{
    public array $stats = [];
    public array $teams = [];

    public function mount()
    {
        // Simulasi query database atau cache
        $this->stats = [
            ['value' => '15K+', 'label' => 'Happy Users'],
            ['value' => '500+', 'label' => 'Daily Transactions'],
            ['value' => '99%', 'label' => 'Satisfaction Rate'],
        ];
        // Fetch teams from DB: Team::where('is_active', true)->get();
    }
}
