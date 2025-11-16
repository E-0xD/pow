<p align="center">
  <a href="https://mypow.app" target="_blank">
    <img src="public/images/brand/Icon1.png" width="200" alt="POW Logo">
  </a>
</p>

---

## About POW

**POW (Proof of Work)** is a modern SaaS platform that helps creators, freelancers, and professionals showcase who they are and what they can do, all in one link.

Designed for individuals who cannot afford a developer or prefer a better alternative to Linktree, **POW** enables users to build personal portfolio pages that combine:

-   Work samples and projects
-   Skills (soft and technical)
-   Contact details and social links
-   Custom branding and templates
-   Analytics for profile views and clicks

The result is a professional, shareable **proof of work** that requires no coding.

---

## Features

-   **Portfolio Builder:** Create and customize your personal brand page.
-   **Skill and Link Management:** Add your skills, social links, and experiences in one place.
-   **Project Showcase:** Upload visuals, videos, or links to your work.
-   **Profile Analytics:** View engagement metrics and visitor data.
-   **Custom Subdomains:** `yourname.pow.app`
-   **Subscription System:** Accept global payments for Pro features.
-   **Responsive Design:** Optimized for mobile, tablet, and desktop devices.

---

## Tech Stack

-   **Backend:** Laravel 12 (PHP 8.3)
-   **Frontend:** Tailwind CSS
-   **Database:** MySQL
-   **Authentication:** Laravel Jetstream with Google and Apple Sign-In
-   **Payments:** Paystack, NowPayments, Polar
-   **Hosting:** Self-hosted with a GitHub-powered CI/CD pipeline

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
```

---

## Local Domain Configuration (Windows)

This configuration allows the **admin subdomain** (`admin.pow.test`) to share the same login session as the main app (`pow.test`).

### Purpose

Laravel sessions are domain-specific. By mapping both domains locally and setting `SESSION_DOMAIN=.pow.test`, you ensure that logging in on the main domain keeps you authenticated on the admin subdomain.

### Steps

1. **Open Notepad as Administrator**

    - Press **Start**, type “Notepad”, right-click, and select **Run as Administrator**.

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

POW integrates with **Polar** and **paystack** for subscription billing and **NowPayments** for cryptocurrency payment handling.

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

### 3. Paystack Setup & Webhook Configuration

This section explains how to configure Paystack for subscription payments, set up API keys, define webhook URLs, and securely connect Paystack events with your backend.

---

#### Step 1 — Configure Paystack Keys

Add your Paystack **Public** and **Secret** keys to `.env`:

```env
PAYSTACK_PUBLIC=pk_live_xxxxxxxxxxxxxxxxxxxxx
PAYSTACK_SECRET=sk_live_xxxxxxxxxxxxxxxxxxxxx
PAYSTACK_URL=https://api.paystack.co/transaction/
```

---

#### **Step 2 — Create Paystack Subscription Plans**

Paystack subscriptions require predefined **Plan Codes**.

Go to:

**Plans → Create Plan**

Then set:

-   **Amount**
-   **Interval**
-   **Name**
-   **Currency**

After creation, Paystack will generate:

```
plan_code: PLN_XXXXXXXX
```

Save this code in your Plans table, for example:

`plans` table → `paystack_plan_code` column

---

#### **Step 3 — Webhook URL Setup**

### Add your webhook URL inside Paystack Settings:

Go to:

**Settings → API Keys & Webhooks → Webhook URL**

Add this:

```
https://yourdomain.com/webhooks/paystack
```

Use **Ngrok** to test locally:

```bash
ngrok http 8000
```

Then set webhook URL in Paystack as:

```
https://<ngrok-id>.ngrok-free.app/webhooks/paystack
```

---

## Authentication Configuration

### 1. Google OAuth Setup

POW supports Google Sign-In for user authentication.  
Follow the steps below to configure Google OAuth in your Laravel application.

#### Step 1. Create a Google Cloud Project

1. Go to the [Google Cloud Console](https://console.cloud.google.com/).
2. Sign in with your Google account.
3. Click **Select a Project → New Project** and give it a name (for example, `POW Authentication`).
4. Click **Create**.

#### Step 2. Configure the OAuth Consent Screen

1. In the left sidebar, navigate to **APIs & Services → OAuth consent screen**.
2. Select **External** and click **Create**.
3. Enter your app name, user support email, and developer contact information.
4. Save and continue through the steps until the app is published.

#### Step 3. Create OAuth 2.0 Credentials

1. Go to **APIs & Services → Credentials**.
2. Click **+ Create Credentials → OAuth client ID**.
3. Choose **Web application** as the application type.
4. Under **Authorized JavaScript origins**, add your local domain:

```

http://127.0.0.1:8000
http://pow.test

```

5. Under **Authorized redirect URIs**, add your Laravel callback route.  
   It must match exactly the callback route defined in your Laravel API routes file(the route name is 'auth.google.callback'):

```

[http://127.0.0.1:8000/api/google/callback](http://127.0.0.1:8000/api/google/callback)

```

or, if using a custom local domain:

```

[http://pow.test/api/google/callback](http://pow.test/api/google/callback)

```

6. Click **Create**, then copy your **Client ID** and **Client Secret**.

#### Step 4. Add the Credentials to `.env`

Add the following environment variables to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_CLIENT_REDIRECT=http://pow.test/api/google/callback
```

> If you use a different local domain or port, update `GOOGLE_CLIENT_REDIRECT` to match your actual callback route.

#### Step 5. Verify `config/services.php`

Ensure your `config/services.php` file includes the Google configuration:

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_CLIENT_REDIRECT'),
],
```

The `redirect` URL must match exactly with the one registered in your Google Cloud Console.

---

After saving your configuration, you can authenticate users via Google OAuth by visiting the corresponding login route defined in your Laravel application.

## Queue Monitor Script

The **`queue-monitor.sh`** script ensures that the Laravel queue worker is always running.
It automatically checks every minute (via Laravel’s Task Scheduler) and restarts the queue worker if it has stopped; keeping your background jobs processing reliably.

### Scheduling

The script is scheduled inside Laravel’s `routes/console.php`:

```php
$schedule->exec(base_path('queue-monitor.sh'))->everyMinute();
```

This ensures it runs every minute automatically when you’ve set up your Laravel scheduler.

### Starting the Scheduler

Make sure your Laravel scheduler itself is running (usually via cron):

```bash
* * * * * php /project path/artisan schedule:run >> /dev/null 2>&1
```

Once this is in place, Laravel will run the queue monitor script every minute automatically.

### Script Permissions

To ensure the script is executable, run :

```bash
chmod +x queue-monitor.sh
```

### Notes

-   The script should live in your project root (same directory as `artisan`).
-   You can edit it to customize queue behavior if needed.
-   Check `storage/logs/queue-monitor.log` to confirm restarts if needed.

---

## Development Notes

-   The `composer dev` script automatically rebuilds assets while watching for file changes.
-   When switching between local and production environments, ensure webhook and payment URLs are updated accordingly.
-   For production deployments, replace sandbox credentials and Ngrok URLs with your live domain and production API keys.

---

## License

This project is licensed under the [MIT License](LICENSE).

```

```
