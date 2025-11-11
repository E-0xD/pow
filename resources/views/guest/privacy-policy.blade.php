<x-layouts.guest>

    <div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 md:px-10">

        <section class="flex flex-col gap-8 py-10">
            <div class="flex flex-col gap-4 text-center">
                <h1 class="text-primary dark:text-white tracking-tight text-3xl font-bold leading-tight sm:text-4xl">Privacy Policy</h1>
                <p class="text-subtle-light dark:text-subtle-dark text-base max-w-3xl mx-auto">Your privacy matters. This policy explains what we collect and why.</p>
            </div>

            <div class="prose max-w-3xl mx-auto text-subtle-light dark:text-subtle-dark">
                <h2>Overview</h2>
                <p>{{config('app.name')}} ("we", "us", "our") is a SaaS platform that provides professional portfolios and a dashboard for creators to build, edit, and share their work. This Privacy Policy describes the personal information we collect, how we use it, and the choices you have.</p>

                <h3>Information we collect</h3>
                <ul>
                    <li><strong>Account information:</strong> name, email, password (hashed), and profile details you provide when creating an account.</li>
                    <li><strong>Billing information:</strong> payment card details are processed by our payment provider (we do not store raw card numbers). We retain billing records for accounting and refund purposes.</li>
                    <li><strong>Content you create:</strong> portfolio content, uploaded files, images, links, and settings you add to your portfolio and dashboard.</li>
                    <li><strong>Usage and analytics:</strong> logs, IP addresses, device, browser, pages visited, and actions in the dashboard to help us improve the service. We use analytics providers to measure performance and product usage.</li>
                    <li><strong>Messages &amp; communications:</strong> messages sent to you or from visitors to your portfolio (stored so you can view them in your dashboard).</li>
                </ul>

                <h3>How we use your information</h3>
                <ul>
                    <li>To provide and maintain the platform and features (portfolio building, editing, analytics, messaging).</li>
                    <li>To process payments and manage subscriptions, including refunds.</li>
                    <li>To communicate account updates, billing notices, and support responses.</li>
                    <li>To analyze product usage and improve our services.</li>
                    <li>To comply with legal obligations and prevent abuse of the service.</li>
                </ul>

                <h3>Sharing and third parties</h3>
                <p>We share data only as necessary to provide the service:</p>
                <ul>
                    <li>Payment processors (to charge your card and handle refunds).</li>
                    <li>Hosting and cloud providers (to store portfolio content and files).</li>
                    <li>When required by law or to protect rights and safety.</li>
                </ul>

                <h3>Your rights</h3>
                <p>You can access, correct, export, or request deletion of your personal data from your account settings or by contacting <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>. If you are in the EU/EEA, you also have rights under data protection laws such as GDPR. We’ll respond to valid requests as required by law.</p>

                <h3>Security</h3>
                <p>We take reasonable measures to protect your data, including encrypted connections (HTTPS), secure storage, and access controls. No internet transmission is perfectly secure. We cannot guarantee absolute security.</p>

                <h3>Retention</h3>
                <p>We retain account and usage data as long as needed to provide services and as required for legal or accounting purposes. When you delete your account we remove your personal data within a reasonable period, except for data we must keep for legal reasons (e.g., transaction records).</p>

                <h3>Changes to this policy</h3>
                <p>We may update this Privacy Policy. We’ll post the updated policy on this page and update the effective date. Significant changes will be communicated via email or in-product notifications.</p>

                <h3>Contact</h3>
                <p>Questions or requests: <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>.</p>
            </div>
        </section>

        <section class="p-8 md:p-12 rounded-xl bg-primary/10 dark:bg-primary/20 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div class="flex flex-col gap-2">
                <h3 class="text-2xl font-bold text-text-light dark:text-text-dark">Privacy matters to us</h3>
                <p class="text-subtle-light dark:text-subtle-dark">If you have privacy questions, reach out and we'll help.</p>
            </div>
            <a class="flex min-w-[84px] max-w-[480px] items-center justify-center rounded-lg h-12 px-5 bg-primary text-white font-bold"
               href="mailto:{{config('mail.from.address')}}">Get in touch</a>
        </section>

    </div>

</x-layouts.guest>