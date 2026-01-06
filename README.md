# 🛒 ShopLy

**Modern E-Commerce Platform** — Full-featured marketplace with seller companies, admin panel & customer storefront.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.2-FDAE4B?style=flat)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![Tests](https://img.shields.io/badge/Tests-84%20passed-22C55E?style=flat)

---

## ✨ Features

### Customer Storefront
- **Product Catalog** — Browse, filter, search products
- **Shopping Cart** — Add items, apply coupons, checkout
- **Wishlist** — Save favorite products
- **Product Comparison** — Compare products side-by-side
- **Reviews & Ratings** — Leave feedback on purchases
- **Order Tracking** — Track orders by number
- **Support Tickets** — Contact support with attachments

### Company System
- **Seller Companies** — Each seller creates a company profile
- **Public Pages** — Company profiles at `/companies/{slug}`
- **Follow System** — Users can follow favorite sellers
- **Verified Badge** — Admin-verified trusted companies
- **Product Ownership** — Products belong to companies

### Seller Panel (`/seller`)
- **Company Profile** — Logo, banner, description, contacts
- **Product Management** — Full CRUD with variants & images
- **Dashboard** — Overview of company statistics

### Admin Panel (`/admin`)
- **Products** — Moderation, CSV import/export, company assignment
- **Companies** — Verify/unverify, moderate profiles
- **Orders** — Status management, history, refunds
- **Users** — Account management, roles
- **Coupons** — Create discount codes
- **Reviews** — Approve/reject moderation
- **Tickets** — Customer support
- **Import Jobs** — Monitor bulk imports

### System
- **Multi-language** — English, Russian, Latvian
- **Dark/Light Theme** — User preference
- **Notifications** — Email & in-app
- **PDF Invoices** — Generate order invoices

---

## 🛠 Tech Stack

**Backend:** PHP 8.2+, Laravel 12, Filament 3.2, Livewire 3  
**Frontend:** Alpine.js 3, Tailwind CSS 3, Vite 7  
**Database:** MySQL 8.0+ / PostgreSQL 14+ / SQLite

---

## 🚀 Quick Start

### Docker (Recommended)

```bash
git clone <repository-url>
cd filament-test
cp .env.docker .env
make init
```

Access: http://localhost:8080

### Local Setup

```bash
git clone <repository-url>
cd filament-test

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan storage:link

php artisan serve
```

Access: http://localhost:8000

---

## 💻 Development

```bash
# Start all services (server, vite, queue, logs)
composer dev

# Or individually:
php artisan serve      # Laravel server
npm run dev            # Vite with HMR
php artisan queue:work # Background jobs
```

---

## 📁 Project Structure

```
app/
├── Filament/
│   ├── Resources/          # Admin panel (Products, Companies, Orders...)
│   └── Seller/Resources/   # Seller panel (Company, Products)
├── Http/Controllers/       # Web controllers
├── Models/                 # Eloquent models (20+)
├── Notifications/          # Email & in-app
├── Observers/              # Model events
└── Jobs/                   # Background jobs

database/
├── factories/              # Test factories
├── migrations/             # Schema
└── seeders/                # Sample data

resources/
├── css/                    # Stylesheets
├── js/                     # Alpine components
├── lang/                   # Translations (en, ru, lv)
└── views/                  # Blade templates

tests/
├── Feature/                # 84 feature tests
└── Unit/
```

---

## 🔌 API Endpoints

### Companies
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/companies` | All companies |
| GET | `/companies/{slug}` | Company profile |
| POST | `/companies/{id}/follow` | Follow/unfollow |

### Products
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/products` | Product listing |
| GET | `/products/{slug}` | Product details |
| GET | `/search` | Search products & companies |

### Cart
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/cart` | View cart |
| POST | `/cart/add/{id}` | Add to cart |
| PATCH | `/cart/update/{id}` | Update quantity |
| DELETE | `/cart/remove/{id}` | Remove item |
| POST | `/cart/coupon/apply` | Apply coupon |

### Orders
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/checkout` | Checkout page |
| POST | `/checkout` | Place order |
| GET | `/track-order/{number}` | Track order |

---

## 🧪 Testing

```bash
php artisan test
php artisan test --filter=CartTest
```

**Test Suites:**
- AuthTest (14) — Registration, login, profile
- CartTest (12) — Add, update, remove items
- OrderTest (9) — Checkout, tracking
- ProductTest (11) — Catalog, details
- WishlistTest (9) — Add, remove
- CouponTest (14) — Apply, validate
- ReviewTest (7) — Submit, moderate

---

## ⚙️ Configuration

### Environment

```env
APP_NAME=ShopLy
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=shoply

QUEUE_CONNECTION=database
```

### Languages

Supported: `en`, `ru`, `lv`

Change via: `/language/{locale}`

---

## 📝 License

MIT License
