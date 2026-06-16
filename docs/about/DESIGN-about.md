# DESIGN-about.md — Exitem About Us Page

## Stack
- Bootstrap 5.3 · Font Awesome 6.4 · Swiper 10 · Vanilla JS

## Layout
```
Navbar
└── Hero (hero-about)
└── Stats Bar (stats-section)
└── Who We Are (2-col: image | text)
└── Vision & Mission (2 vm-cards)
└── Team Carousel (Swiper)
└── Footer (multi-column)
```

## Sections

### Navbar
- Dark sticky navbar, brand `EXITEM.`, links: Home · About Us (active) · Contact

### Hero `.hero-about`
- Full-viewport, dark overlay, centered text
- H1: `"Elevating Excellence"` · subtext in Indonesian

### Stats Bar `.stats-section`
- 3-col with shadow: `15K+ Happy Users` · `500+ Daily Transactions` · `99% Satisfaction Rate`

### Who We Are
- `col-lg-6`: Unsplash image (rounded-4, shadow)
- `col-lg-6`: orange label `● WHO WE ARE ●`, h2 headline, 2 paragraphs (`text-muted`)

### Vision & Mission
- 2 × `.vm-card` (shadow-sm, text-center)
- Vision: FA `fa-eye` icon + paragraph
- Mission: FA `fa-rocket` icon + `<ul>` list (3 items)

### Team Carousel `.team-section`
- Swiper: autoplay 3s, loop, pagination dots, prev/next arrows
- Breakpoints: 1 slide → 2 (≥768px) → 3 (≥1024px)
- Card: circular `.team-img-wrapper` photo + name + role

| Member | Role |
|---|---|
| Marcel Immanuel | Founder & CEO |
| Jonathan Erhandoyo | Backend Developer |
| Fiky Ba'dafitro | Frontend Developer |
| Gloria Tesalonika | UI/UX Designer |
| Harlyn | Data Analyst |

### Footer
- 4-col: brand + description + social icons · Navigation · Services · Contact info
- Bottom: copyright with heart icon

## JS (`about.js`)
Swiper initialization only — no business logic.

```js
new Swiper(".mySwiper", {
  slidesPerView: 1, spaceBetween: 30, loop: true,
  autoplay: { delay: 3000 },
  pagination: { el: ".swiper-pagination", clickable: true },
  navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
  breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
});
```

## Key Custom CSS Classes

| Class | Purpose |
|---|---|
| `.hero-about` | Full-viewport hero with dark overlay |
| `.stats-section` | White bar with shadow |
| `.vm-card` | Vision/Mission card with icon |
| `.team-section` | Dark background team section |
| `.team-card` / `.team-img-wrapper` | Card with circular photo |
| `.text-orange` | Primary accent color |
