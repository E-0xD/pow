# Test script for Paystack Webhook
# Usage: .\test-webhook.ps1 [-EndpointType local|ngrok] [-EventType charge.success|subscription.create|subscription.not_renew|invoice.update]
# Examples:
#   .\test-webhook.ps1 -EndpointType local -EventType charge.success
#   .\test-webhook.ps1 -EndpointType local -EventType subscription.create
#   .\test-webhook.ps1 -EndpointType local -EventType invoice.update

param(
    [string]$EndpointType = "local",
    [string]$EventType = "charge.success"
)

# Set the base URL
if ($EndpointType -eq "ngrok") {
    $BaseUrl = "https://YOUR_NGROK_URL.ngrok.io"
    Write-Host "Using ngrok URL. Please update BASE_URL if needed." -ForegroundColor Yellow
} else {
    $BaseUrl = "http://localhost:8000"
}

$WebhookUrl = "$BaseUrl/webhook/paystack"

Write-Host "Testing Paystack Webhook" -ForegroundColor Green
Write-Host "Endpoint: $WebhookUrl"
Write-Host "Event: $EventType"
Write-Host "---"

# Define payloads for different events
$Payloads = @{
    "charge.success" = @{
        "event" = "charge.success"
        "data" = @{
            "id" = 302961
            "domain" = "live"
            "status" = "success"
            "reference" = "qTPrJoy9Bx"
            "amount" = 10000
            "message" = $null
            "gateway_response" = "Approved by Financial Institution"
            "paid_at" = "2016-09-30T21:10:19.000Z"
            "created_at" = "2016-09-30T21:09:56.000Z"
            "channel" = "card"
            "currency" = "NGN"
            "ip_address" = "41.242.49.37"
            "metadata" = @{
                "user_id" = 1
                "plan_code" = "PLN_test123"
                "free_months" = 0
                "extra_months" = 0
            }
            "customer" = @{
                "id" = 68324
                "first_name" = "Test"
                "last_name" = "User"
                "email" = "test@example.com"
                "customer_code" = "CUS_qo38as2hpsgk2r0"
                "phone" = $null
                "metadata" = $null
                "risk_action" = "default"
            }
            "authorization" = @{
                "authorization_code" = "AUTH_f5rnfq9p"
                "bin" = "539999"
                "last4" = "8877"
                "exp_month" = "08"
                "exp_year" = "2020"
                "card_type" = "mastercard DEBIT"
                "bank" = "Test Bank"
                "country_code" = "NG"
                "brand" = "mastercard"
                "account_name" = "Test User"
            }
            "plan" = @{}
        }
    }
    "subscription.create" = @{
        "event" = "subscription.create"
        "data" = @{
            "domain" = "test"
            "status" = "active"
            "subscription_code" = "SUB_vsyqdmlzble3uii"
            "email_token" = "086x99rmqc4qhcw"
            "amount" = 50000
            "cron_expression" = "0 0 28 * *"
            "next_payment_date" = "2026-02-19T07:00:00.000Z"
            "open_invoice" = $null
            "createdAt" = "2026-01-21T00:23:24.000Z"
            "plan" = @{
                "name" = "Monthly retainer"
                "plan_code" = "PLN_gx2wn530m0i3w3m"
                "description" = $null
                "amount" = 50000
                "interval" = "monthly"
                "send_invoices" = $true
                "send_sms" = $true
                "currency" = "NGN"
            }
            "authorization" = @{
                "authorization_code" = "AUTH_96xphygz"
                "bin" = "539983"
                "last4" = "7357"
                "exp_month" = "10"
                "exp_year" = "2027"
                "card_type" = "MASTERCARD DEBIT"
                "bank" = "GTBANK"
                "country_code" = "NG"
                "brand" = "MASTERCARD"
                "account_name" = "Test User"
            }
            "customer" = @{
                "first_name" = "Test"
                "last_name" = "User"
                "email" = "test@example.com"
                "customer_code" = "CUS_xnxdt6s1zg1f4nx"
                "phone" = ""
                "metadata" = @{}
                "risk_action" = "default"
            }
            "created_at" = "2026-01-21T10:59:59.000Z"
        }
    }
    "subscription.not_renew" = @{
        "event" = "subscription.not_renew"
        "data" = @{
            "id" = 317617
            "domain" = "test"
            "status" = "non-renewing"
            "subscription_code" = "SUB_d638sdiWAio7jnl"
            "email_token" = "086x99rmqc4qhcw"
            "amount" = 120000
            "cron_expression" = "0 0 8 10 *"
            "next_payment_date" = $null
            "open_invoice" = $null
            "integration" = 116430
            "plan" = @{
                "id" = 103028
                "name" = "(1,200) - annually - [1 - Year]"
                "plan_code" = "PLN_tlknnnzfi4w2evu"
                "description" = "Subscription not_renewed for test@example.com"
                "amount" = 120000
                "interval" = "annually"
                "send_invoices" = $true
                "send_sms" = $true
                "currency" = "NGN"
            }
            "authorization" = @{
                "authorization_code" = "AUTH_5ftfl9xrl0"
                "bin" = "424242"
                "last4" = "4081"
                "exp_month" = "06"
                "exp_year" = "2027"
                "channel" = "card"
                "card_type" = "mastercard debit"
                "bank" = "Guaranty Trust Bank"
                "country_code" = "NG"
                "brand" = "mastercard"
                "reusable" = $true
                "signature" = "SIG_biPYZE4PgDCQUJMIT4sE"
                "account_name" = $null
            }
            "customer" = @{
                "id" = 57199167
                "first_name" = "Test"
                "last_name" = "User"
                "email" = "test@example.com"
                "customer_code" = "CUS_8gbmdpvn12c67ix"
                "phone" = $null
                "metadata" = $null
                "risk_action" = "default"
                "international_format_phone" = $null
            }
            "invoices" = @()
            "invoices_history" = @()
            "invoice_limit" = 0
            "split_code" = $null
            "most_recent_invoice" = $null
            "created_at" = "2026-01-21T14:50:39.000Z"
        }
    }
    "invoice.update" = @{
        "event" = "invoice.update"
        "data" = @{
            "domain" = "test"
            "invoice_code" = "INV_kmhuaaur5c9ruh2"
            "amount" = 50000
            "period_start" = "2016-04-19T07:00:00.000Z"
            "period_end" = "2016-05-19T07:00:00.000Z"
            "status" = "success"
            "paid" = $true
            "paid_at" = "2016-04-19T06:00:09.000Z"
            "description" = $null
            "authorization" = @{
                "authorization_code" = "AUTH_jhbldlt1"
                "bin" = "539923"
                "last4" = "2071"
                "exp_month" = "10"
                "exp_year" = "2017"
                "card_type" = "MASTERCARD DEBIT"
                "bank" = "FIRST BANK OF NIGERIA PLC"
                "country_code" = "NG"
                "brand" = "MASTERCARD"
                "account_name" = "BoJack Horseman"
            }
            "subscription" = @{
                "status" = "active"
                "subscription_code" = "SUB_l07i1s6s39nmytr"
                "amount" = 50000
                "cron_expression" = "0 0 19 * *"
                "next_payment_date" = "2016-05-19T07:00:00.000Z"
                "open_invoice" = $null
            }
          "customer" = @{
    "first_name" = "BoJack"
    "last_name" = "Horseman"
    "email" = "bojack@horsinaround.com"
    "customer_code" = "CUS_n2mdrif8gczge03"
    "phone" = ""
    "metadata" = @{}
    "risk_action" = "default"
}

            "transaction" = @{
                "reference" = "rdtmivs7zf"
                "status" = "success"
                "amount" = 50000
                "currency" = "NGN"
            }
            "created_at" = "2016-04-16T13:45:03.000Z"
        }

    }
}

# Get the payload for the event type
if (-not $Payloads.ContainsKey($EventType)) {
    Write-Host "Unknown event type: $EventType" -ForegroundColor Red
    Write-Host "Supported events: charge.success, subscription.create, subscription.not_renew, invoice.update" -ForegroundColor Yellow
    exit 1
}

$Payload = $Payloads[$EventType]
$JsonPayload = $Payload | ConvertTo-Json -Depth 10

# Send the POST request
Write-Host "Sending request..." -ForegroundColor Cyan
Write-Host ""

try {
    $Response = Invoke-WebRequest -Uri $WebhookUrl `
        -Method POST `
        -ContentType "application/json" `
        -Body $JsonPayload `
        -UseBasicParsing
    
    Write-Host "Status: $($Response.StatusCode)" -ForegroundColor Green
    Write-Host "Response:" -ForegroundColor Cyan
    Write-Host $Response.Content
} catch {
    Write-Host "Error: $($_.Exception.Message)" -ForegroundColor Red
    if ($_.Exception.Response) {
        Write-Host "Status: $($_.Exception.Response.StatusCode)" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Done!" -ForegroundColor Green
