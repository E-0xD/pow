<x-layouts.app>

    <div class="max-w-7xl mx-auto">
        <!-- PageHeading -->
        <x-layouts.app.page-heading title="Affiliate Dashboard" subtitle="Monitor your performance and earnings." />
        <!-- Stats -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="flex flex-col gap-2 rounded-lg p-6 bg-primary text-white ">
                <p class="text-base font-medium">Current Balance</p>
                <p class="tracking-tight text-3xl font-bold">${{ number_format($affiliate->balance ?? 0, 2) }}</p>
            </div>

            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-base font-medium">Total Referrals</p>
                <p class="tracking-tight text-3xl font-bold">{{ $totalReferrals }}</p>
            </div>

            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-base font-medium">Total Amount Made</p>
                <p class="tracking-tight text-3xl font-bold">${{ number_format($totalCommissions ?? 0, 2) }}</p>
            </div>

            <div
                class="flex flex-col gap-2 rounded-lg p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                <p class="text-base font-medium">Commission Rate</p>
                <p class="tracking-tight text-3xl font-bold">{{ $affiliate->commission_rate ?? 0 }}%</p>
            </div>

        </div>
        <!-- Referral & Payout Sections -->
        <div class="lg:col-span-2 mb-8 space-y-8">
            <div x-data="{
                showToast: false,
                toastMessage: '',
                toastType: 'success',
                copyToClipboard(value) {
                    if (!value) return;
                    navigator.clipboard.writeText(value).then(() => {
                        this.toastMessage = '{{ __('Copied to clipboard!') }}';
                        this.toastType = 'success';
                        this.showToast = true;
                        setTimeout(() => this.showToast = false, 3000);
                    }).catch(() => {
                        this.toastMessage = '{{ __('Unable to copy!') }}';
                        this.toastType = 'error';
                        this.showToast = true;
                        setTimeout(() => this.showToast = false, 3000);
                    });
                }
            }" class="relative">
                <!-- ✅ Toast Notification -->
                <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2" class="fixed top-5 right-5 z-50"
                    style="display: none;">
                    <div :class="toastType === 'success'
                        ?
                        'bg-green-500 text-white' :
                        (toastType === 'error' ?
                            'bg-red-500 text-white' :
                            'bg-blue-500 text-white')"
                        class="flex items-center gap-3 max-w-sm rounded-lg p-4 shadow-md">
                        <span class="material-symbols-outlined"
                            x-text="toastType === 'success' ? 'check_circle' 
                    : (toastType === 'error' ? 'error' : 'info')">
                        </span>
                        <span class="flex-1" x-text="toastMessage"></span>
                        <button @click="showToast = false" class="ml-2 focus:outline-none">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                </div>

                <!-- ✅ Referral Link Box -->
                <div
                    class="lg:col-span-2 bg-white dark:bg-background-dark border border-[#e0dbe6] dark:border-gray-700/50 rounded-xl p-6">
                    <h2
                        class="text-[#141118] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] mb-4">
                        Your Referral Link
                    </h2>

                    <div class="flex flex-col sm:flex-row items-stretch gap-4">
                        <div class="flex w-full flex-1 items-stretch rounded-xl">
                            <input
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl 
                    text-[#141118] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 
                    border border-[#e0dbe6] dark:border-gray-700 bg-background-light dark:bg-black/20 
                    h-14 placeholder:text-[#756189] p-[15px] text-base font-normal leading-normal"
                                readonly id="referralLink" value="{{ url('/?data=' . ($affiliate->uid ?? '')) }}" />
                        </div>

                        <button @click.prevent="copyToClipboard(document.getElementById('referralLink').value)"
                            class="flex min-w-[140px] cursor-pointer items-center justify-center overflow-hidden rounded-xl 
                h-14 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] 
                hover:bg-primary/90 transition-colors">
                            <span class="material-symbols-outlined mr-2">content_copy</span>
                            <span class="truncate">Copy Link</span>
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-background-dark border border-[#e0dbe6] dark:border-gray-700/50 rounded-xl p-6 flex flex-col justify-between">
                <div>
                    <h2
                        class="text-[#141118] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] mb-2">
                        Payouts</h2>
                    <p class="text-[#756189] dark:text-gray-400 text-sm mb-4">Payouts are processed automatically every
                        {{ config('affiliate.payout_interval_days', 30) }} days.</p>
                </div>

                <form action="{{ route('user.affiliate.store') }}" method="post">
                    @csrf
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-medium">Payout Method</label>
                        <select name="payout_method"
                            class="form-input rounded-md h-10 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                            id="payoutMethod">
                            <option value="bank" @if (($affiliate->payout_method ?? '') === 'bank') selected @endif>Bank Transfer
                            </option>
                            <option value="crypto" @if (($affiliate->payout_method ?? '') === 'crypto') selected @endif>Crypto</option>
                        </select>

                        <div id="bankFields" class="flex flex-col gap-3"
                            @if (($affiliate->payout_method ?? '') !== 'bank') style="display:none" @endif>
                            <label class="text-sm font-medium">Bank Name</label>
                            <input type="text" name="bank_name"
                                class="form-input rounded-md h-10 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                                value="{{ $affiliate->payout_details['bank_name'] ?? '' }}">

                            <label class="text-sm font-medium">Account Number</label>
                            <input type="text" name="account_number"
                                class="form-input rounded-md h-10 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                                value="{{ $affiliate->payout_details['account_number'] ?? '' }}">
                        </div>

                        <div id="cryptoFields" class="flex flex-col gap-3"
                            @if (($affiliate->payout_method ?? '') !== 'crypto') style="display:none" @endif>
                            <label class="text-sm font-medium">Network</label>
                            <input type="text" name="network"
                                class="form-input rounded-md h-10 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                                value="{{ $affiliate->payout_details['network'] ?? '' }}">

                            <label class="text-sm font-medium">Wallet Address</label>
                            <input type="text" name="wallet_address"
                                class="form-input rounded-md h-10 text-text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800"
                                value="{{ $affiliate->payout_details['wallet_address'] ?? '' }}">
                        </div>

                        <button type="submit" class="mt-2 w-full rounded-xl h-10 bg-primary text-white">Save Payout
                            Details</button>
                    </div>

                    <script>
                        document.getElementById('payoutMethod').addEventListener('change', function() {
                            const method = this.value;
                            document.getElementById('bankFields').style.display = method === 'bank' ? 'flex' : 'none';
                            document.getElementById('cryptoFields').style.display = method === 'crypto' ? 'flex' : 'none';
                        });
                    </script>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Transactions -->
            <div>
                <h2 class="text-xl font-bold tracking-tight text-text-light dark:text-text-dark mb-4">Recent
                    Transactions</h2>
                <div
                    class="overflow-x-auto bg-card-light dark:bg-card-dark rounded-lg border border-border-light dark:border-border-dark">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs uppercase bg-background-light dark:bg-gray-700 text-text-secondary-light dark:text-text-secondary-dark">
                            <tr>
                                <th class="px-6 py-3" scope="col">Date</th>
                                <th class="px-6 py-3" scope="col">Amount</th>
                                <th class="px-6 py-3" scope="col">Method</th>
                                <th class="px-6 py-3" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $t)
                                <tr class="border-b border-border-light dark:border-border-dark">
                                    <td class="px-6 py-4">{{ $t->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 font-medium">${{ number_format($t->amount, 2) }}</td>
                                    <td class="px-6 py-4">{{ $t->gateway }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full @if ($t->status === 'successful') bg-green-100 text-green-800 @elseif($t->status === 'pending') bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">{{ ucfirst($t->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Recent Link Activity -->
            <div>
                <h2 class="text-xl font-bold tracking-tight text-text-light dark:text-text-dark mb-4">Recent Link
                    Activity</h2>
                <div
                    class="overflow-x-auto bg-card-light dark:bg-card-dark rounded-lg border border-border-light dark:border-border-dark">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs uppercase bg-background-light dark:bg-gray-700 text-text-secondary-light dark:text-text-secondary-dark">
                            <tr>
                                <th class="px-6 py-3" scope="col">Date</th>
                                <th class="px-6 py-3" scope="col">Action Type</th>
                                <th class="px-6 py-3" scope="col">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Recent link activity: signups and conversions --}}
                            @foreach (\App\Models\User::where('referred_by', auth()->id())->latest()->limit(10)->get() as $r)
                                <tr class="border-b border-border-light dark:border-border-dark">
                                    <td class="px-6 py-4">{{ $r->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">Sign-up</td>
                                    <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium">Converted</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
