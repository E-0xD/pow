<x-layouts.guest>

    <div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 md:px-10">

        <section class="flex flex-col gap-8 py-10">
            <div class="flex flex-col gap-4 text-center">
                <h1 class="text-primary dark:text-white tracking-tight text-3xl font-bold leading-tight sm:text-4xl">Refund Policy</h1>
                <p class="text-subtle-light dark:text-subtle-dark text-base max-w-3xl mx-auto">We want you to love {{config('app.name')}}. If you’re not satisfied, here’s how refunds work.</p>
            </div>

            <div class="prose max-w-3xl mx-auto text-subtle-light dark:text-subtle-dark">
                <h2>Full refund within 30 days</h2>
                <p>
                    We offer a full refund for any paid purchase made on {{config('app.name')}} if you request it within 30 days of the purchase date.
                    This applies to one-time purchases(in the event this becomes a pricing plan) and subscription sign-ups (monthly or annual) for the same plan purchased by the same account.
                </p>

                <h3>How to request a refund</h3>
                <ol>
                    <li>Log in to your {{config('app.name')}} account and go to the <strong>Billing</strong> section, or contact our support team at <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>.</li>
                    <li>Include your account email, transaction reference, and a short reason for the request.</li>
                    <li>We will respond within 5 business days and process any approved refund within 7–14 business days depending on your payment provider.</li>
                </ol>

                <h3>Limitations &amp; conditions</h3>
                <ul>
                    <li>Refunds must be requested within 30 days of the original purchase date. Requests after 30 days are evaluated on a case-by-case basis but are not guaranteed.</li>
                    <li>Refunds only apply to the amount paid for the subscription or plan. Fees charged by payment processors (if any) may not be refundable and depend on the processor.</li>
                    <li>If you purchased additional products or third-party services through {{config('app.name')}} (for example, premium templates sold by third parties), refunds for those items may be subject to the third party's policies.</li>
                    <li>Abuse of the refund policy (repeated purchases and refunds to avoid payment) may result in account suspension and denial of future refunds.</li>
                </ul>

                <h3>Prorated refunds and cancellations</h3>
                <p>
                    If you cancel a recurring subscription, you will retain access to the paid features until the end of the current billing period. Prorated refunds for mid-period cancellations are handled per the payment provider and the specific plan terms; our 30-day full refund window still applies from the purchase date.
                </p>

                <h3>Contact</h3>
                <p>If you have questions about refunds, contact <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a> or use the support link in your dashboard.</p>
            </div>
        </section>

        <section class="p-8 md:p-12 rounded-xl bg-primary/10 dark:bg-primary/20 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div class="flex flex-col gap-2">
                <h3 class="text-2xl font-bold text-text-light dark:text-text-dark">Need help?</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Contact our support team and we’ll sort it out — quickly.</p>
            </div>
            <a class="flex min-w-[84px] max-w-[480px] items-center justify-center rounded-lg h-12 px-5 bg-primary text-white font-bold"
               href="mailto:{{config('mail.from.address')}}">Contact Support</a>
        </section>

    </div>

</x-layouts.guest>