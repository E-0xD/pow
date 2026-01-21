# Paystack Webhook Testing Guide

## Webhook Endpoint
- **URL**: `POST /webhook/paystack`
- **Full URL (Local)**: `http://localhost:8000/webhook/paystack`
- **No Authentication Required**: Webhook is publicly accessible

## Quick Start

### Option 1: PowerShell (Windows)
```powershell
# Test charge.success event
.\test-webhook.ps1 -EndpointType local -EventType charge.success

# Test subscription.create event
.\test-webhook.ps1 -EndpointType local -EventType subscription.create

# Test subscription.not_renew event
.\test-webhook.ps1 -EndpointType local -EventType subscription.not_renew

# Test invoice.update event (renewal)
.\test-webhook.ps1 -EndpointType local -EventType invoice.update
```

### Option 2: Bash (Git Bash / WSL)
```bash
# Test charge.success event
bash test-webhook.sh local charge.success

# Test subscription.create event
bash test-webhook.sh local subscription.create

# Test subscription.not_renew event
bash test-webhook.sh local subscription.not_renew

# Test invoice.update event (renewal)
bash test-webhook.sh local invoice.update
```

### Option 3: CURL Command
```bash
# Make sure your Laravel app is running on localhost:8000

# Charge Success
curl -X POST http://localhost:8000/webhook/paystack \
  -H "Content-Type: application/json" \
  -d '{
    "event": "charge.success",
    "data": {
      "id": 302961,
      "customer": {
        "id": 68324,
        "first_name": "Test",
        "last_name": "User",
        "email": "test@example.com",
        "customer_code": "CUS_qo38as2hpsgk2r0"
      },
      "metadata": {
        "user_id": 1,
        "plan_code": "PLN_test123"
      },
      "plan": {}
    }
  }'

# Subscription Create
curl -X POST http://localhost:8000/webhook/paystack \
  -H "Content-Type: application/json" \
  -d '{
    "event": "subscription.create",
    "data": {
      "subscription_code": "SUB_vsyqdmlzble3uii",
      "email_token": "086x99rmqc4qhcw",
      "next_payment_date": "2026-02-19T07:00:00.000Z",
      "customer": {
        "first_name": "Test",
        "last_name": "User",
        "email": "test@example.com",
        "customer_code": "CUS_xnxdt6s1zg1f4nx"
      }
    }
  }'

# Invoice Update (Renewal)
curl -X POST http://localhost:8000/webhook/paystack \
  -H "Content-Type: application/json" \
  -d '{
    "event": "invoice.update",
    "data": {
      "invoice_code": "INV_test123",
      "amount": 50000,
      "paid_at": "2026-01-19T06:00:09.000Z",
      "subscription": {
        "subscription_code": "SUB_l07i1s6s39nmytr",
        "next_payment_date": "2026-02-19T07:00:00.000Z"
      },
      "customer": {
        "first_name": "Test",
        "last_name": "User",
        "email": "test@example.com",
        "customer_code": "CUS_xnxdt6s1zg1f4nx"
      },
      "transaction": {
        "reference": "rdtmivs7zf",
        "status": "success",
        "amount": 50000
      }
    }
  }'
```

### Option 4: Postman
1. Create a new POST request
2. Set URL to: `http://localhost:8000/webhook/paystack`
3. Set headers:
   - `Content-Type: application/json`
4. Copy any of the JSON payloads from the `.ps1` or `.sh` files into the Body (raw)
5. Click Send

## Test Data Notes

### Charge Success Event
- Creates/finds user via email
- Creates/links PaystackCustomer record
- Updates or creates subscription based on plan_code

### Subscription Create Event
- Finds/creates user
- Updates subscription to ACTIVE
- Sets expiration date from next_payment_date

### Subscription Not Renew Event
- Finds/creates user
- Marks active subscription as CANCELLED

### Invoice Update Event (Renewal)
- Finds/creates user
- Marks current ACTIVE subscription as RENEWED
- Creates new ACTIVE subscription
- Creates Transaction record
- Sends renewal confirmation email

## Checking Results

### Check logs
```bash
tail -f storage/logs/laravel.log
```

### Check database
```bash
# List all users
php artisan tinker
>>> User::all()

# List all PaystackCustomer records
>>> PaystackCustomer::with('user')->get()

# List all subscriptions for a user
>>> User::find(1)->subscriptions
```

## Testing with ngrok (for real Paystack)

1. Make sure ngrok is running:
```bash
ngrok http 8000
```

2. Update your Paystack dashboard webhook URL to: `https://YOUR_NGROK_ID.ngrok.io/webhook/paystack`

3. Then use the test script with ngrok endpoint:
```powershell
.\test-webhook.ps1 -EndpointType ngrok -EventType charge.success
```

## Troubleshooting

### Issue: User not found error
- The test user email should match an existing user in your database
- Or use the test scripts which automatically create users based on the email

### Issue: Subscription not found error
- Make sure the user has a pending or active subscription before testing subscription events
- Test charge.success first to create a subscription

### Issue: 404 error
- Make sure Laravel app is running: `php artisan serve`
- Check that the route is registered in `routes/services.php` or `routes/payment.php`

### Issue: Connection refused
- Make sure your Laravel development server is running
- Default port is 8000 if using `php artisan serve`

## Event Flow

Typical payment flow:
1. **charge.success** - Initial payment successful
2. **subscription.create** - Subscription activated
3. **invoice.update** - Subscription renewal (repeats monthly/yearly)
4. **subscription.not_renew** - User cancels subscription (optional)
