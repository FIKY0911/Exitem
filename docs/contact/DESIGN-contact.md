# DESIGN-contact.md — Exitem Contact Page

## Stack
- Bootstrap 5.3 · Font Awesome 6.4 · Vanilla JS · localStorage

## Layout
```
Navbar
└── Hero (hero-contact)
└── Contact Card
│   ├── Left (col-lg-7): Message Form
│   └── Right (col-lg-5): Info Boxes
└── Footer (minimal centered)
```

## Sections

### Navbar
- Dark sticky navbar, brand `EXITEM.`, links: Home · About Us · Contact (active)

### Hero `.hero-contact`
- Full-viewport, left-aligned text
- H1: `"Contact Us"` · subtext in Indonesian

### Contact Card `.contact-card`

**Left — Message Form**
- Orange label `● MESSAGE ●`, H2: `"Send Us A Message"`
- Success alert (Bootstrap, dismissible, auto-hides after 5s) — hidden by default (`d-none`)
- Form fields (`novalidate`):

| Field | Type | Required |
|---|---|---|
| Name | `text` | ✓ |
| Email | `email` | ✓ |
| Subject | `text` | ✓ |
| Message | `textarea` (5 rows) | ✓ |

- Submit: `.btn-send` → `"Submit Message"`

**Right — Info Boxes `.info-box`**

| Icon (FA) | Title | Value |
|---|---|---|
| `fa-map-marker-alt` | Our Location | Jl. Sudirman No. 123, Jakarta Selatan |
| `fa-phone-alt` | Phone Call | +62 812 3456 7890 |
| `fa-envelope` | Email Us | support@exitem.com |

### Footer
- Minimal, centered: brand `EXITEM.` + copyright text

## JS (`contact.js`)
- Validates all 4 fields (non-empty trim)
- Saves to `localStorage` key `contacts` (JSON array)
- Entry shape: `{ name, email, subject, message, date: ISO string }`
- On success: reset form → show alert → hide after 5s

## Key Custom CSS Classes

| Class | Purpose |
|---|---|
| `.hero-contact` | Full-viewport hero |
| `.contact-card` | Main white card wrapper |
| `.info-box` | Individual contact info item with icon |
| `.btn-send` | Styled submit button |
| `.text-orange` | Primary accent color |
