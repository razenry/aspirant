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
    <div class="h-130 max-md:h-[31.25rem]">
        <nav class="navbar rounded-box shadow-base-300/20 shadow-sm">
            <div class="navbar-start">
                <a class="link text-base-content link-neutral text-xl font-bold no-underline" href="#">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="navbar-center max-md:hidden">
                <ul class="menu menu-horizontal gap-2 p-0 text-base rtl:ml-20">
                    <li class="dropdown relative inline-flex [--auto-close:inside] [--offset:9]">
                        <button id="dropdown-end" type="button"
                            class="dropdown-toggle dropdown-open:bg-base-content/10 dropdown-open:text-base-content max-md:px-2"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            Products
                            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48" role="menu"
                            aria-orientation="vertical" aria-labelledby="nested-dropdown">
                            <li><a class="dropdown-item" href="#">Templates</a></li>
                            <li><a class="dropdown-item" href="#">UI kits</a></li>
                            <li class="dropdown relative [--auto-close:inside] [--offset:10] [--placement:right-start]">
                                <button id="nested-dropdown-2"
                                    class="dropdown-toggle dropdown-item dropdown-open:bg-base-content/10 dropdown-open:text-base-content justify-between"
                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                    Components
                                    <span class="icon-[tabler--chevron-right] size-4 rtl:rotate-180"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48" role="menu"
                                    aria-orientation="vertical" aria-labelledby="nested-dropdown-2">
                                    <li><a class="dropdown-item" href="#">Basic</a></li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            Advanced
                                            <span
                                                class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                        </a>
                                    </li>
                                    <li
                                        class="dropdown relative [--auto-close:inside] [--offset:10] [--placement:right-start]">
                                        <button id="nested-dropdown-2"
                                            class="dropdown-toggle dropdown-item dropdown-open:bg-base-content/10 dropdown-open:text-base-content justify-between"
                                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            Vendor
                                            <span class="icon-[tabler--chevron-right] size-4 rtl:rotate-180"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48" role="menu"
                                            aria-orientation="vertical" aria-labelledby="nested-dropdown-2">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    Data tables
                                                    <span
                                                        class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    Apex charts
                                                    <span
                                                        class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Clipboard</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="navbar-end items-center gap-4">
                <div class="dropdown relative inline-flex [--placement:bottom] md:hidden">
                    <button id="dropdown-default" type="button"
                        class="dropdown-toggle btn btn-text btn-secondary btn-square" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="icon-[tabler--menu-2] dropdown-open:hidden size-5"></span>
                        <span class="icon-[tabler--x] dropdown-open:block hidden size-5"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu"
                        aria-orientation="vertical" aria-labelledby="dropdown-default">
                        <li class="dropdown relative [--auto-close:inside] [--offset:9] [--placement:bottom]">
                            <button id="dropdown-end-2"
                                class="dropdown-toggle dropdown-item dropdown-open:bg-base-content/10 dropdown-open:text-base-content justify-between"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                Products
                                <span class="icon-[tabler--chevron-right] size-4 rtl:rotate-180"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48" role="menu"
                                aria-orientation="vertical" aria-labelledby="nested-dropdown">
                                <li><a class="dropdown-item" href="#">Templates</a></li>
                                <li><a class="dropdown-item" href="#">UI kits</a></li>
                                <li
                                    class="dropdown relative [--auto-close:inside] [--offset:10] md:[--placement:right-start] [--placement:bottom]">
                                    <button id="nested-dropdown-2"
                                        class="dropdown-toggle dropdown-item dropdown-open:bg-base-content/10 dropdown-open:text-base-content justify-between"
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        Components
                                        <span class="icon-[tabler--chevron-right] size-4 rtl:rotate-180"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48" role="menu"
                                        aria-orientation="vertical" aria-labelledby="nested-dropdown-2">
                                        <li><a class="dropdown-item" href="#">Basic</a></li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                Advanced
                                                <span
                                                    class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                            </a>
                                        </li>
                                        <li
                                            class="dropdown relative [--auto-close:inside] [--offset:10] md:[--placement:right-start] [--placement:bottom]">
                                            <button id="nested-dropdown-2"
                                                class="dropdown-toggle dropdown-item dropdown-open:bg-base-content/10 dropdown-open:text-base-content justify-between"
                                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                Vendor
                                                <span
                                                    class="icon-[tabler--chevron-right] size-4 rtl:rotate-180"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-48"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="nested-dropdown-2">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        Data tables
                                                        <span
                                                            class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        Apex charts
                                                        <span
                                                            class="badge badge-sm badge-soft badge-primary rounded-full">Pro</span>
                                                    </a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Clipboard</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">About</a></li>
                        <li><a class="dropdown-item" href="#">Careers</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary" href="#">Login</a>
            </div>
        </nav>
    </div>
</body>

</html>
