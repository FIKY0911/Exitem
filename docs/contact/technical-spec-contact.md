# 🛠️ Technical Specification (Tech Spec)
**Module:** Contact Us Page
**Stack:** Laravel 12, Livewire 3

## 1. Skema Database (Laravel Migration)
Berubah dari SQL murni menjadi format *Migration* Laravel:
`database/migrations/xxxx_xx_xx_create_contacts_table.php`
```php
Schema::create('contacts', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100);
    $table->string('email')->index(); // Indexing untuk kecepatan pencarian admin
    $table->string('subject', 150);
    $table->text('message');
    $table->timestamps();
});
