<p align="center">
  <a href="https://mypow.app" target="_blank">
    <img src="public\images\brand\Icon1.png" width="200" alt="POW Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/yourusername/pow/actions">
    <img src="https://github.com/yourusername/pow/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/yourusername/pow">
    <img src="https://img.shields.io/packagist/v/yourusername/pow" alt="Latest Version">
  </a>
  <a href="https://packagist.org/packages/yourusername/pow">
    <img src="https://img.shields.io/packagist/l/yourusername/pow" alt="License">
  </a>
</p>

---

## 🪶 About POW

**POW (Proof of Work)** is a modern SaaS platform that helps creators, freelancers, and professionals showcase who they are and what they can do, all in one link.

Built for people who can’t afford a developer or want something better than Linktree, **POW** lets users easily build personal portfolio pages that combine:

- Work samples and projects  
- Skills (soft + technical)  
- Contact details and social links  
- Custom branding and templates  
- Analytics for profile views and clicks  

You get a beautiful, shareable **proof of work**, all without writing code.

---

## ✨ Features

- 🪞 **Portfolio Builder:** Create and customize your personal brand page.  
- 🧠 **Skill & Link Management:** Add your skills, socials, and experiences in one place.  
- 📸 **Project Showcase:** Upload visuals, videos, or links to your work.  
- 🔍 **Profile Analytics:** See who’s viewing and engaging with your profile.  
- 🏷️ **Custom Subdomains:** yourname.pow.app  
- 💳 **Subscription System:** Accept global payments for Pro features.  
- ☁️ **Responsive Design:** Works beautifully on mobile, tablet, and desktop.  

---

## ⚙️ Tech Stack

- **Backend:** Laravel 12 (PHP 8.3)  
- **Frontend:** Tailwind CSS (HTML-first, responsive, mobile-first)  
- **Database:** MySQL
- **Authentication:** Laravel jetstream with Google and Apple Sign-In  
- **Payments:** Paystack , nowpayment, polar
- **Hosting:** Self Host with a simple Ci/CD pipeline powered by GitHub Version Control.

---

## 🚀 Installation

```bash
# Clone the repository
git clone https://github.com/E-0xD/pow.git

# Enter project directory
cd pow

# Install dependencies
composer install
npm install && npm run build

# Copy environment file and set up keys
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start the development server
php artisan serve
