<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>

<body>
    <div class="bg-base-100">
        <header class="border-base-content/20 bg-base-100 fixed top-0 z-10 w-full border-b py-0.25">
            <nav class="navbar mx-auto max-w-7xl rounded-b-xl px-4 sm:px-6 lg:px-8">
                <div class="w-full lg:flex lg:items-center lg:gap-2">
                    <div class="navbar-start items-center justify-between max-lg:w-full">
                        <a class="text-base-content flex items-center gap-3 text-xl font-bold" href="#">
                            <img src="https://cdn.flyonui.com/fy-assets/logo/logo.png" class="size-8"
                                alt="brand-logo" />
                            FlyonUI
                        </a>
                        <div class="flex items-center gap-5 lg:hidden">
                            <a href="#" class="btn btn-primary">Login</a>
                            <button type="button" class="collapse-toggle btn btn-outline btn-secondary btn-square"
                                data-collapse="#navbar-block-4" aria-controls="navbar-block-4"
                                aria-label="Toggle navigation">
                                <span class="icon-[tabler--menu-2] collapse-open:hidden size-5.5"></span>
                                <span class="icon-[tabler--x] collapse-open:block hidden size-5.5"></span>
                            </button>
                        </div>
                    </div>
                    <div id="navbar-block-4"
                        class="lg:navbar-center transition-height collapse hidden grow overflow-hidden font-medium duration-300 lg:flex">
                        <div class="text-base-content flex gap-6 text-base max-lg:mt-4 max-lg:flex-col lg:items-center">
                            <a href="#" class="hover:text-primary">Home</a>
                            <a href="#" class="hover:text-primary">Products</a>
                            <a href="#" class="hover:text-primary">About Us</a>
                            <a href="#" class="hover:text-primary">Contacts</a>
                        </div>
                    </div>
                    <div class="navbar-end max-lg:hidden">
                        <a href="#" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </nav>
        </header>

    </div>
    <main class="h-screen">

        {{-- Hero Section start --}}

        <div
            class="flex h-full flex-col justify-between gap-18 overflow-x-hidden pt-40 md:gap-24 md:pt-45 lg:gap-35 lg:pt-40.5">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center gap-8 justify-self-center px-4 text-center sm:px-6 lg:px-8">
                <div
                    class="bg-base-200 border-base-content/20 flex w-fit items-center gap-2.5 rounded-full border px-3 py-2">
                    <span class="badge badge-primary shrink-0 rounded-full">AI-Powered</span>
                    <span class="text-base-content/80">Solution for client-facing businesses</span>
                </div>
                <h1
                    class="text-base-content relative z-1 text-5xl leading-[1.15] font-bold max-md:text-2xl md:max-w-3xl md:text-balance">
                    <span>Sizzling Summer Delights Effortless Recipes for Parties!</span>
                    <svg width="223" height="12" viewBox="0 0 223 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute -bottom-1.5 left-10 -z-1 max-lg:left-4 max-md:hidden">
                        <path
                            d="M1.30466 10.7431C39.971 5.28788 76.0949 3.02 115.082 2.30401C143.893 1.77489 175.871 0.628649 204.399 3.63102C210.113 3.92052 215.332 4.91391 221.722 6.06058"
                            stroke="url(#paint0_linear_10365_68643)" stroke-width="2" stroke-linecap="round" />
                        <defs>
                            <linearGradient id="paint0_linear_10365_68643" x1="19.0416" y1="4.03539" x2="42.8362"
                                y2="66.9459" gradientUnits="userSpaceOnUse">
                                <stop offset="0.2" stop-color="var(--color-primary)" />
                                <stop offset="1" stop-color="var(--color-primary-content)" />
                            </linearGradient>
                        </defs>
                    </svg>
                </h1>
                <p class="text-base-content/80 max-w-3xl">
                    Dive into a world of flavor this summer with our collection of Sizzling Summer Delights! From
                    refreshing
                    appetizers to delightful desserts
                </p>

                <a href="#" class="btn btn-primary btn-gradient btn-lg">
                    Try it Now
                    <span class="icon-[tabler--arrow-right] size-5 rtl:rotate-180"></span>
                </a>
            </div>
        </div>

        {{-- Hero Section end --}}
    </main>

    {{-- Aspirations Preview Section start --}}

    <div class="bg-base-100 py-8 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center sm:mb-16 lg:mb-24">
                <h2 class="text-base-content mb-4 text-2xl font-semibold md:text-3xl lg:text-4xl">
                    Get to Know Our Amazing Team
                </h2>
                <p class="text-base-content/80 text-xl">
                    Meet the Passionate Experts Behind Our Success and Learn More About Their Roles .
                </p>
            </div>
            <!-- Team Members -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-6 lg:gap-y-10 xl:grid-cols-4">
                <!-- Team Member 1 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-6.png"
                            alt="Phillip Bothman" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Phillip Bothman</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Founder & CEO</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-7.png"
                            alt="James Kenter" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">James Kenter</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Engineering Manager</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-8.png"
                            alt="Cristofer Kenter" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Cristofer Kenter</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Product Designer</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 4 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-5.png"
                            alt="Alena Lubin" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Alena Lubin</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Frontend Developer</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 5 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-9.png"
                            alt="Jayden Lipshultz" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Jayden Lipshultz</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Sales Lead</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 6 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-3.png"
                            alt="Maria Donin" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Maria Donin</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Product Manager</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 7 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-2.png"
                            alt="Carter Saris" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Carter Saris</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">UX Researcher</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 8 -->
                <div class="card card-border hover:border-primary h-max shadow-none">
                    <figure class="bg-base-200 pt-6">
                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/team/team-4.png"
                            alt="Ahmad Donin" class="h-60 w-auto" />
                    </figure>
                    <div class="card-body gap-3">
                        <h3 class="text-base-content text-lg font-medium">Ahmad Donin</h3>
                        <div class="divider"></div>
                        <div>
                            <p class="text-base-content mb-1 font-medium">Customer Success</p>
                            <p class="text-base-content/80">A visionary leader driving innovation and
                                collaboration.</p>
                        </div>
                        <div class="card-actions h-5 gap-3">
                            <a href="#" class="text-accent"><span
                                    class="icon-[tabler--brand-facebook] size-5.5"></span></a>
                            <a href="#" class="text-primary"><span
                                    class="icon-[tabler--brand-twitter] size-5.5"></span></a>
                            <a href="#" class="text-base-content"><span
                                    class="icon-[tabler--brand-github] size-5.5"></span></a>
                            <a href="#" class="text-pink-500"><span
                                    class="icon-[tabler--brand-instagram] size-5.5"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Aspirations Preview Section end --}}

    <footer>
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
            <div class="flex items-center justify-between gap-3 max-md:flex-col">
                <div class="text-base-content flex items-center gap-3 text-xl font-bold">
                    <img src="https://cdn.flyonui.com/fy-assets/logo/logo.png" class="size-8" alt="brand-logo" />
                    <span>FlyonUI</span>
                </div>
                <!-- Navigation -->
                <nav class="flex items-center gap-6">
                    <a href="#" class="link link-animated text-base-content/80 font-medium">About</a>
                    <a href="#" class="link link-animated text-base-content/80 font-medium">Features</a>
                    <a href="#" class="link link-animated text-base-content/80 font-medium">Works</a>
                    <a href="#" class="link link-animated text-base-content/80 font-medium">Career</a>
                </nav>
                <!-- Social Icons -->
                <div class="text-base-content flex h-5 gap-4">
                    <a href="#" aria-label="Facebook">
                        <span class="icon-[tabler--brand-facebook] size-5"></span>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <span class="icon-[tabler--brand-instagram] size-5"></span>
                    </a>
                    <a href="#" aria-label="Twitter">
                        <span class="icon-[tabler--brand-x] size-5"></span>
                    </a>
                    <a href="#" aria-label="Github">
                        <span class="icon-[tabler--brand-github] size-5"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="text-base-content text-center text-base">
                &copy;2024
                <a href="" class="text-primary">FlyonUI</a>
                ,
                <br class="md:hidden" />
                Made With ❤ for a better web.
            </div>
        </div>
    </footer>
</body>

</html>
