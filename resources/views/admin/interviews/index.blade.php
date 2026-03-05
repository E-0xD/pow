<x-layouts.app>
    <div class="mx-auto max-w-7xl">
        <!-- Page Heading -->
        <div class="flex flex-col gap-2 mb-8">
            <p class="text-text-light dark:text-text-dark text-3xl lg:text-4xl font-black tracking-tighter">
                Interview Dashboard
            </p>
            <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal">
                Manage volunteer team interview scheduling and reminders
            </p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            @php
                $statCards = [
                    [
                        'label' => 'Total Applicants',
                        'value' => $stats['total'],
                        'icon' => 'group',
                        'color' => 'text-blue-500',
                    ],
                    [
                        'label' => 'Invitations Sent',
                        'value' => $stats['invitations_sent'],
                        'icon' => 'mail',
                        'color' => 'text-green-500',
                    ],
                    [
                        'label' => '6h Reminders',
                        'value' => $stats['reminders_6h'],
                        'icon' => 'schedule',
                        'color' => 'text-amber-500',
                    ],
                    [
                        'label' => '1h Reminders',
                        'value' => $stats['reminders_1h'],
                        'icon' => 'alarm',
                        'color' => 'text-red-500',
                    ],
                    [
                        'label' => 'Upcoming',
                        'value' => $stats['upcoming'],
                        'icon' => 'event',
                        'color' => 'text-purple-500',
                    ],
                ];
            @endphp

            @foreach ($statCards as $card)
                <div
                    class="flex flex-col items-center gap-2 p-4 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-2xl {{ $card['color'] }}">{{ $card['icon'] }}</span>
                    <p class="text-2xl font-bold text-text-light dark:text-text-dark">{{ $card['value'] }}</p>
                    <p class="text-xs text-subtle-light dark:text-subtle-dark text-center">{{ $card['label'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Actions Row -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <!-- Upload Section -->
            <form action="{{ route('admin.interviews.upload') }}" method="POST" enctype="multipart/form-data"
                class="flex-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 p-4 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                @csrf
                <label class="flex-1">
                    <span class="text-sm font-medium text-text-light dark:text-text-dark">Upload XLSX</span>
                    <input type="file" name="file" accept=".xlsx,.xls"
                        class="mt-1 block w-full text-sm text-subtle-light dark:text-subtle-dark file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer" />
                </label>
                <button type="submit"
                    class="px-6 py-2 rounded-md bg-primary text-white font-semibold text-sm hover:bg-primary/90 transition-colors self-end sm:self-center">
                    Upload
                </button>
            </form>

            <!-- Manual Process Button -->
            <form action="{{ route('admin.interviews.process') }}" method="POST"
                class="flex items-center p-4 rounded-lg bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
                @csrf
                <button type="submit"
                    class="px-6 py-2 rounded-md bg-green-600 text-white font-semibold text-sm hover:bg-green-700 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">play_arrow</span>
                    Process Now
                </button>
            </form>
        </div>

        <!-- Applicants Table -->
        <x-table.index>
            <x-table.thead>
                <x-table.th>#</x-table.th>
                <x-table.th>Name</x-table.th>
                <x-table.th>Email</x-table.th>
                <x-table.th>Role</x-table.th>
                <x-table.th>Scheduled (WAT)</x-table.th>
                <x-table.th>Invitation</x-table.th>
                <x-table.th>6h Reminder</x-table.th>
                <x-table.th>1h Reminder</x-table.th>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($applicants as $i => $applicant)
                    <x-table.tr>
                        <x-table.td>{{ $i + 1 }}</x-table.td>
                        <x-table.td class="font-medium">{{ $applicant->full_name }}</x-table.td>
                        <x-table.td>{{ $applicant->email }}</x-table.td>
                        <x-table.td>
                            @if ($applicant->role)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/20 text-primary">
                                    {{ $applicant->role }}
                                </span>
                            @else
                                —
                            @endif
                        </x-table.td>
                        <x-table.td>
                            <code class="text-xs bg-background-light dark:bg-background-dark px-2 py-1 rounded">
                                {{ $applicant->scheduledAtWAT()->format('D M j, g:i A') }}
                            </code>
                        </x-table.td>
                        <x-table.td>
                            @if ($applicant->invitation_sent_at)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    ✓ Sent
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                    Pending
                                </span>
                            @endif
                        </x-table.td>
                        <x-table.td>
                            @if ($applicant->reminder_6h_sent_at)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    ✓ Sent
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                    Pending
                                </span>
                            @endif
                        </x-table.td>
                        <x-table.td>
                            @if ($applicant->reminder_1h_sent_at)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    ✓ Sent
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                    Pending
                                </span>
                            @endif
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td class="text-center text-subtle-light dark:text-subtle-dark" colspan="8">
                            No applicants found. Upload an xlsx file and click "Process Now" to get started.
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-table.tbody>
        </x-table.index>
    </div>
</x-layouts.app>
