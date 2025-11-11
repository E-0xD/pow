<x-layouts.guest>

    <div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 md:px-10">

        <section class="flex flex-col gap-8 py-10">
            <div class="flex flex-col gap-4 text-center">
                <h1 class="text-primary dark:text-white tracking-tight text-3xl font-bold leading-tight sm:text-4xl">Terms &amp; Conditions</h1>
                <p class="text-subtle-light dark:text-subtle-dark text-base max-w-3xl mx-auto">These terms govern your use of {{config('app.name')}}; a service that lets professionals create portfolios, pick templates, choose pricing plans, and manage their portfolio from a dashboard.</p>
            </div>

            <div class="prose max-w-3xl mx-auto text-subtle-light dark:text-subtle-dark">
                <h2>1. Acceptance</h2>
                <p>By creating an account or using {{config('app.name')}}, you agree to these Terms. If you don’t agree, do not use the service.</p>

                <h2>2. Our service</h2>
                <p>{{config('app.name')}} provides templates, a drag-and-drop portfolio builder, hosting for published portfolios, and a dashboard for editing, analytics, and messaging. Features vary by plan and may change over time.</p>

                <h2>3. Accounts</h2>
                <p>You are responsible for maintaining the confidentiality of your account credentials and for all activity under your account. Notify us immediately of any unauthorized use.</p>

                <h2>4. Payment &amp; Billing</h2>
                <p>Paid plans require a valid payment method. By subscribing you authorize recurring charges for subscriptions until cancelled. Prices and features for plans are listed on our pricing page.</p>

                <h2>5. Refunds</h2>
                <p>We offer a full refund if requested within 30 days of purchase — see our <a href="{{route('guest.refund-policy')}}">Refund Policy</a> for details.</p>

                <h2>6. Use restrictions</h2>
                <p>Don’t use {{config('app.name')}} to host illegal content, infringe others’ rights, spam, or otherwise abuse the service. We reserve the right to suspend or terminate accounts that violate these terms or harm the service.</p>

                <h2>7. Intellectual property</h2>
                <p>You retain ownership of the content you upload. By uploading content you grant {{config('app.name')}} a license to host, display, and transmit that content as needed to provide the service. Templates and site code provided by {{config('app.name')}} remain our property.</p>

                <h2>8. Termination</h2>
                <p>Either party may terminate the account at any time. On termination we may delete or retain data as described in the Privacy Policy; you should export important data before terminating.</p>

                <h2>9. Disclaimers &amp; liability</h2>
                <p>{{config('app.name')}} is provided "as is" without warranties. To the extent permitted by law, our liability is limited to the amount you paid in the prior 12 months. We are not liable for indirect or consequential damages.</p>

                <h2>10. Changes</h2>
                <p>We may update these Terms. If changes are material we will notify you by email or in product. Continued use after changes constitutes acceptance.</p>

                <h2>11. Governing law</h2>
                <p>These Terms are governed by the law applicable in the jurisdiction where {{config('app.name')}} operates. If you need a specific governing law clause added, update this section or contact us.</p>

                <h2>12. Contact</h2>
                <p>Questions about these terms? Contact <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>.</p>
            </div>
        </section>

        <section class="p-8 md:p-12 rounded-xl bg-primary/10 dark:bg-primary/20 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div class="flex flex-col gap-2">
                <h3 class="text-2xl font-bold text-text-light dark:text-text-dark">Need legal help?</h3>
                <p class="text-subtle-light dark:text-subtle-dark">Contact our team for questions about these Terms.</p>
            </div>
            <a class="flex min-w-[84px] max-w-[480px] items-center justify-center rounded-lg h-12 px-5 bg-primary text-white font-bold"
               href="mailto:{{config('mail.from.address')}}">Contact Support</a>
        </section>

    </div>

</x-layouts.guest>