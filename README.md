
<p align="center">
  <a href="https://mypow.app" target="_blank">
    <img src="public/images/brand/Icon1.png" width="200" alt="POW Logo">
  </a>
</p>

---

## About POW

**POW (Proof of Work)** is a modern SaaS platform that helps creators, freelancers, and professionals showcase who they are and what they can do, all in one link.

Designed for individuals who cannot afford a developer or prefer a better alternative to Linktree, **POW** enables users to build personal portfolio pages that combine:

- Work samples and projects  
- Skills (soft and technical)  
- Contact details and social links  
- Custom branding and templates  
- Analytics for profile views and clicks  

The result is a professional, shareable **proof of work** that requires no coding.

---

## Features

- **Portfolio Builder:** Create and customize your personal brand page.  
- **Skill and Link Management:** Add your skills, social links, and experiences in one place.  
- **Project Showcase:** Upload visuals, videos, or links to your work.  
- **Profile Analytics:** View engagement metrics and visitor data.  
- **Custom Subdomains:** `yourname.pow.app`  
- **Subscription System:** Accept global payments for Pro features.  
- **Responsive Design:** Optimized for mobile, tablet, and desktop devices.  

---

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.3)  
- **Frontend:** Tailwind CSS  
- **Database:** MySQL  
- **Authentication:** Laravel Jetstream with Google and Apple Sign-In  
- **Payments:** Paystack, NowPayments, Polar  
- **Hosting:** Self-hosted with a GitHub-powered CI/CD pipeline  

---

## Installation

```bash
# Clone the repository
git clone https://github.com/E-0xD/pow.git

# Enter the project directory
cd pow

# Install dependencies
composer install
npm install && npm run build

# Copy environment file and generate the application key
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Start the development server
php artisan serve

# Or use the development script
composer dev
````

---

## Local Domain Configuration (Windows)

This configuration allows the **admin subdomain** (`admin.pow.test`) to share the same login session as the main app (`pow.test`).

### Purpose

Laravel sessions are domain-specific. By mapping both domains locally and setting `SESSION_DOMAIN=.pow.test`, you ensure that logging in on the main domain keeps you authenticated on the admin subdomain.

### Steps

1. **Open Notepad as Administrator**

   * Press **Start**, type “Notepad”, right-click, and select **Run as Administrator**.

2. **Open the hosts file**

   ```
   C:\Windows\System32\drivers\etc\hosts
   ```

3. **Add these lines at the bottom**

   ```
   127.0.0.1 pow.test
   127.0.0.1 admin.pow.test
   ```

   This maps both domains to your local server.

4. **Save and close the file**

### Clear Your DNS Cache

After editing the hosts file, run the following command in **Command Prompt (as Administrator):**

```bash
ipconfig /flushdns
```

Expected output:

```
Successfully flushed the DNS Resolver Cache.
```

### `.env` Configuration

Ensure your session configuration allows subdomain sharing:

```env
SESSION_DRIVER=database
SESSION_DOMAIN=.pow.test
SESSION_PATH=/
```

> Replace `pow.test` with your own local domain if you use a different setup (for example, `myapp.local` and `admin.myapp.local`).

---

## Payment and Webhook Configuration

POW integrates with **Polar** for subscription billing and **NowPayments** for cryptocurrency payment handling.

### 1. Polar Setup

1. Create an account at [Polar Sandbox](https://sandbox.polar.sh/).

2. Generate an **Access Token** and a **Webhook Secret**.

3. Add them to your `.env` file:

   ```env
   POLAR_ACCESS_TOKEN=
   POLAR_WEBHOOK_SECRET=
   ```

4. Start your Laravel development server:

   ```bash
   php artisan serve
   ```

   By default, this runs at:

   ```
   http://127.0.0.1:8000
   ```

5. Start Ngrok to expose your local server to the internet:

   ```bash
   ngrok http 8000
   ```

   Ngrok will generate a public URL like:

   ```
   https://abc123.ngrok.io
   ```

6. In your Polar sandbox dashboard, add this URL as your webhook endpoint:

   ```
   https://abc123.ngrok.io/polar/webhook
   ```

   This ensures Polar can communicate with your local Laravel app during testing.

---

### 2. NowPayments Setup

1. Create a sandbox account at [NowPayments](https://api-sandbox.nowpayments.io).

2. Retrieve your **API Key** and add it to your `.env` file:

   ```env
   NOWPAYMENT_KEY=your_sandbox_key_here
   NOWPAYMENT_INVOICE_URL=https://api-sandbox.nowpayments.io/v1/invoice
   NOWPAYMENT_PAYMENT_URL=https://api-sandbox.nowpayments.io/v1/payment
   ```

3. These credentials enable POW to create invoices and process cryptocurrency payments through the NowPayments sandbox environment.

---

## Development Notes

* The `composer dev` script automatically rebuilds assets while watching for file changes.
* When switching between local and production environments, ensure webhook and payment URLs are updated accordingly.
* For production deployments, replace sandbox credentials and Ngrok URLs with your live domain and production API keys.

---

## License

This project is licensed under the [MIT License](LICENSE).

```

