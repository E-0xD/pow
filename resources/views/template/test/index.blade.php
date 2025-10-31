<!DOCTYPE html>

<html class="dark" lang="en">

    <head>
        @include('partials.teamplate-head')

        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;family=Poppins:wght@700&amp;display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#38e07b",
                            "background-light": "#f6f8f7",
                            "background-dark": "#122017",
                            "electric-blue": "#007BFF",
                            "magenta": "#E020E0",
                            "bright-yellow": "#FFC700",
                        },
                        fontFamily: {
                            "display": ["Inter", "sans-serif"],
                            "heading": ["Poppins", "sans-serif"],
                        },
                        borderRadius: {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                    },
                },
            }
        </script>
        <style>
            .material-symbols-outlined {
                font-variation-settings:
                    'FILL' 0,
                    'wght' 400,
                    'GRAD' 0,
                    'opsz' 24
            }
        </style>
    </head>

    <body class="bg-background-light dark:bg-background-dark font-display text-zinc-700 dark:text-zinc-300 antialiased">
        <div class="relative w-full overflow-x-hidden">
            <main class="container mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                <div class="flex flex-col gap-24 sm:gap-32">
                    @foreach ($portfolio->sectionOrders->sortBy('position') as $sectionOrder)
                        @switch($sectionOrder->section_id)
                            @case('about')
                                @include('template.test.about')
                            @break

                            @case('experience')
                                @include('template.test.experience')
                            @break

                            @case('education')
                                @include('template.test.education')
                            @break

                            @case('skills')
                                @include('template.test.skills')
                            @break

                            @case('projects')
                                @include('template.test.project')
                            @break
                        @endswitch
                    @endforeach

                    @if ($portfolio->accept_messages)
                        @include('template.test.message')
                    @endif
                </div>
            </main>
        </div>
    </body>

</html>
