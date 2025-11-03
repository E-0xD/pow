<p align="center">
  <a href="https://mypow.app" target="_blank">
    <img src="public\images\brand\Icon1.png" width="200" alt="POW Logo">
  </a>
</p>

---

## About POW

**POW (Proof of Work)** is a modern SaaS platform that helps creators, freelancers, and professionals showcase who they are and what they can do, all in one link.

Built for people who can’t afford a developer or want something better than Linktree, **POW** lets users easily build personal portfolio pages that combine:

- Work samples and projects  
- Skills (soft + technical)  
- Contact details and social links  
- Custom branding and templates  
- Analytics for profile views and clicks  

You get a beautiful, shareable **proof of work**, all without writing code.

---

##  Features

- **Portfolio Builder:** Create and customize your personal brand page.  
- **Skill & Link Management:** Add your skills, socials, and experiences in one place.  
- **Project Showcase:** Upload visuals, videos, or links to your work.  
- **Profile Analytics:** See who’s viewing and engaging with your profile.  
- **Custom Subdomains:** yourname.pow.app  
- **Subscription System:** Accept global payments for Pro features.  
- **Responsive Design:** Works beautifully on mobile, tablet, and desktop.  

---

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.3)  
- **Frontend:** Tailwind CSS (HTML-first, responsive, mobile-first)  
- **Database:** MySQL
- **Authentication:** Laravel jetstream with Google and Apple Sign-In  
- **Payments:** Paystack , nowpayment, polar
- **Hosting:** Self Host with a simple Ci/CD pipeline powered by GitHub Version Control.

---

## Installation

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

#or to build assets as you develop

composer dev


### 🧭 Configure Hosts File (Windows Only)

To make sure the **admin subdomain** (`admin.pow.test`) can access the **same login session** as the main app (`pow.test`), you’ll need to map both domains locally.

> **Reason:**
> Laravel sessions are domain-specific.
> By mapping both domains and setting `SESSION_DOMAIN=.pow.test`, you ensure that logging in on the main domain also keeps you authenticated on the admin subdomain.

---

#### 🪜 Step-by-Step (Windows)

1. **Open Notepad as Administrator**

   * Press **Start → type “Notepad” → right-click → “Run as Administrator”**

2. **Open the hosts file**

   ```
   C:\Windows\System32\drivers\etc\hosts
   ```

3. **Add these lines at the bottom**

   ```
   127.0.0.1 pow.test
   127.0.0.1 admin.pow.test
   ```

   > This tells Windows to resolve both domains locally to your development server.

4. **Save and close the file**

---

#### Clear Your DNS Cache

After editing your hosts file, run this command in **Command Prompt (as Administrator):**

```bash
ipconfig /flushdns
```

You should see:

```
Successfully flushed the DNS Resolver Cache.
```

This ensures Windows picks up your new domain mappings immediately.

---

#### Laravel `.env` Configuration

In your `.env` file, make sure your session settings allow both domains to share the same login:

```env
SESSION_DRIVER=database
SESSION_DOMAIN=.pow.test
SESSION_PATH=/
```

> This means `pow.test` and `admin.pow.test` will **share authentication cookies**.
> Other subdomains (like `user.pow.test`) won’t be affected.
