<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dulce Rincón - POS Terminal</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&amp;family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container": "#f1ede8",
                        "primary-container": "#4a1524",
                        "surface-container-highest": "#e6e2dd",
                        "surface-dim": "#ddd9d5",
                        "background": "#fdf9f4",
                        "on-tertiary": "#ffffff",
                        "surface": "#fdf9f4",
                        "on-primary-fixed-variant": "#703342",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#e7c34d",
                        "secondary-container": "#ffa1b1",
                        "on-tertiary-fixed": "#231b00",
                        "surface-tint": "#8c4a59",
                        "primary": "#2f0210",
                        "on-secondary-container": "#7a3443",
                        "primary-fixed": "#ffd9df",
                        "on-surface": "#1c1c19",
                        "outline-variant": "#d7c1c4",
                        "primary-fixed-dim": "#ffb1c0",
                        "tertiary-container": "#caa833",
                        "on-surface-variant": "#524345",
                        "on-tertiary-fixed-variant": "#564500",
                        "on-error-container": "#93000a",
                        "surface-bright": "#fdf9f4",
                        "surface-container-high": "#ebe8e3",
                        "on-secondary-fixed-variant": "#75303f",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#735c00",
                        "secondary-fixed-dim": "#ffb2bd",
                        "surface-variant": "#e6e2dd",
                        "on-error": "#ffffff",
                        "on-background": "#1c1c19",
                        "on-primary-container": "#c57a89",
                        "secondary": "#924756",
                        "outline": "#857375",
                        "on-secondary-fixed": "#3d0415",
                        "error-container": "#ffdad6",
                        "surface-container-low": "#f7f3ee",
                        "error": "#ba1a1a",
                        "on-primary-fixed": "#3a0818",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#ffe083",
                        "inverse-primary": "#ffb1c0",
                        "inverse-on-surface": "#f4f0eb",
                        "on-tertiary-container": "#4e3e00",
                        "secondary-fixed": "#ffd9de",
                        "inverse-surface": "#31302d"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Newsreader"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }

        .font-serif {
            font-family: 'Newsreader', serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-surface text-on-surface flex h-screen overflow-hidden">
    <!-- SideNavBar (Authority: JSON & Design System) -->
    <aside class="fixed left-0 top-0 h-full flex flex-col p-4 z-40 bg-[#fdf9f4] dark:bg-stone-950 docked left-0 h-full w-64 border-r-0 shadow-[4px_0_24px_rgba(47,2,16,0.04)]">
        <div class="mb-10 px-4">
            <h1 class="font-['Newsreader'] text-xl text-[#2f0210] dark:text-rose-50 font-bold tracking-tight">Dulce Rincón</h1>
            <p class="font-['Manrope'] font-semibold text-xs text-[#2f0210]/60">Artisanal Bakery</p>
        </div>
        <nav class="flex-1 space-y-2">
            <!-- Active Navigation State Applied to 'Register' (POS) -->
            <div class="flex items-center gap-3 px-4 py-3 bg-[#924756] text-white rounded-xl shadow-lg shadow-[#924756]/20 cursor-pointer active:scale-95 transition-all">
                <span class="material-symbols-outlined" data-icon="point_of_sale">point_of_sale</span>
                <span class="font-['Manrope'] font-semibold text-sm">Register</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-3 text-[#2f0210]/70 dark:text-stone-400 hover:bg-[#ffe083]/10 hover:translate-x-1 transition-transform duration-200 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="query_stats">query_stats</span>
                <span class="font-['Manrope'] font-semibold text-sm">Analytics</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-3 text-[#2f0210]/70 dark:text-stone-400 hover:bg-[#ffe083]/10 hover:translate-x-1 transition-transform duration-200 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="bakery_dining">bakery_dining</span>
                <span class="font-['Manrope'] font-semibold text-sm">Inventory</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-3 text-[#2f0210]/70 dark:text-stone-400 hover:bg-[#ffe083]/10 hover:translate-x-1 transition-transform duration-200 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="group">group</span>
                <span class="font-['Manrope'] font-semibold text-sm">Staff</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-3 text-[#2f0210]/70 dark:text-stone-400 hover:bg-[#ffe083]/10 hover:translate-x-1 transition-transform duration-200 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="tune">tune</span>
                <span class="font-['Manrope'] font-semibold text-sm">Settings</span>
            </div>
        </nav>
        <div class="mt-auto border-t border-surface-container-highest pt-6 space-y-2">
            <button class="w-full bg-primary text-white py-3 px-4 rounded-xl flex items-center justify-center gap-2 mb-4 font-bold shadow-lg shadow-primary/20 active:scale-95 transition-all">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                New Order
            </button>
            <div class="flex items-center gap-3 px-4 py-2 text-[#2f0210]/70 hover:translate-x-1 transition-transform cursor-pointer">
                <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                <span class="font-['Manrope'] font-semibold text-sm">Help</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-2 text-error hover:translate-x-1 transition-transform cursor-pointer">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-['Manrope'] font-semibold text-sm">Logout</span>
            </div>
        </div>
    </aside>
    <!-- Main Content Canvas -->
    <main class="ml-64 flex-1 flex flex-col h-full relative">
        <!-- TopNavBar (Authority: JSON & Design System) -->
        <header class="flex justify-between items-center w-full px-8 py-3 h-16 bg-[#fdf9f4] dark:bg-stone-950 shadow-sm dark:shadow-none docked full-width top-0 z-30">
            <div class="flex items-center gap-6">
                <div class="relative w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-highest border-none rounded-full text-sm font-body focus:ring-2 focus:ring-secondary/20" placeholder="Search products..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 text-[#2f0210] dark:text-rose-200 hover:bg-[#ffe083]/20 transition-colors rounded-full relative">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-secondary rounded-full border-2 border-surface"></span>
                </button>
                <button class="p-2 text-[#2f0210] dark:text-rose-200 hover:bg-[#ffe083]/20 transition-colors rounded-full">
                    <span class="material-symbols-outlined" data-icon="settings">settings</span>
                </button>
                <div class="flex items-center gap-3 pl-4 border-l border-surface-container-highest">
                    <div class="text-right">
                        <p class="text-xs font-bold text-primary leading-tight">Admin Manager</p>
                        <p class="text-[10px] text-on-surface-variant">Morning Shift</p>
                    </div>
                    <img alt="Manager Profile" class="w-10 h-10 rounded-full object-cover border-2 border-secondary/20" data-alt="portrait of a professional cafe manager in a crisp apron, warm lighting, bakery background blurred" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgXNpGQd27iaGOd9Efi6UfBJ7T3qgY-c9bnjTqpbFT1p9HVRBP8vmI1Sqg1l3xOXLiJMz0Ie0pLv5w_GTlaObN_9O28Qt27XfjqSC8RKpWQXVd80EUtI5OaW1Xmo0AenV9-BhF6m6xgVxYFin84WXc4FX_fz9YAZLCWY8ji17WAHIdrZoAAUQ27d4UPQCQ0tb1t1mD2bIxl1Ym7vZ4HIpsrabHry9BrZOajBJQlwrwE_q1d4XDS9JBlfiRRkOgIKtDHh8etEYpnpE" />
                </div>
            </div>
        </header>
        <!-- POS Canvas -->
        <div class="flex-1 flex overflow-hidden">
            <!-- Product Section -->
            <div class="flex-1 flex flex-col p-8 overflow-y-auto bg-surface-container-low">
                <!-- Category Tabs -->
                <div class="flex gap-3 mb-8 overflow-x-auto hide-scrollbar pb-2 items-start"><!-- Todo -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-secondary text-white shadow-lg shadow-secondary/20 transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">restaurant_menu</span>
                        <span class="font-['Newsreader'] font-bold text-base">Todo</span>
                    </button>
                    <!-- Crepas -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">bakery_dining</span>
                        <span class="font-['Newsreader'] font-bold text-base">Crepas</span>
                    </button>
                    <!-- Bebidas Calientes -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">coffee</span>
                        <span class="font-['Newsreader'] font-bold text-base">Bebidas</span>
                    </button>
                    <!-- Frappés -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">icecream</span>
                        <span class="font-['Newsreader'] font-bold text-base">Frappés</span>
                    </button>
                    <!-- Pasteles -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">cake</span>
                        <span class="font-['Newsreader'] font-bold text-base">Pasteles</span>
                    </button>
                    <!-- Pan Artesanal -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">breakfast_dining</span>
                        <span class="font-['Newsreader'] font-bold text-base">Pan</span>
                    </button>
                    <!-- Postres -->
                    <button class="flex flex-col items-center justify-center gap-2 px-8 py-5 rounded-2xl bg-surface-container-highest text-on-surface-variant hover:bg-surface-container-high transition-all active:scale-95 whitespace-nowrap min-w-[120px]">
                        <span class="material-symbols-outlined text-4xl">cookie</span>
                        <span class="font-['Newsreader'] font-bold text-base">Postres</span>
                    </button>
                </div>
                <!-- Product Grid (Editorial Layout) -->
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="close-up of a warm strawberry and chocolate crepe with powdered sugar on a ceramic plate, soft morning light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA91tLVWukQOlhg1jsB4D7GakfOkFMARgjfrmRI7JBM1m7AIrCNuz7jsdak5GiULMqpdQRDvgTIKfZvgohDwddQHlT3103mFFGT4C1Lr51T8A9tmAgIggHoHyB3oYqtiw71io45gDOLyHW-MQh83z23-qF78Gz-zb4NnaA4-1unPZLA1rsDi3RV-URXj7mQkB0TEpvmg6xnbws-zVyOneUd24tLbH5is-ulIln_MOrQ3ERJyMIp_H1SwM-_BVA2ZndjWs5-p8aJvYE" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Crepa de Fresa</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$85.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="artisanal cappuccino with latte art in a textured ceramic mug, wooden table, cozy bakery aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCL0pusHtiS0W15oo8ld05TG5qhYIZfQefYUwWbyPBv1qn8iVRJsctKNKkCmH7XvmaG2gmpAmgu3H8QjhzoboiLfcP5Wg0egwBaWTFfblQyjdYMDENDlb3LSkIIL8BedKi7UAbY_18BnajaBkVbN9mgvAd37EWX5X4irBum7NtCY_5LrDg2dIlhlBnxU9ux9wXPbx1RaKTL0n-YLiAi3tabpb_0i_nVoUN2ZnABvn68PR29TDzWxpEbobuQOGVMIMm9oEDRIR8nOII" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Capuccino Clásico</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$45.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="rich chocolate cake slice with dark ganache frosting on a gold rimmed plate, elegant dessert photography" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCG6znI2mt4TxBOxlUD2KM0dRHpwCTIlZeGBEVHLKAfBqnt8cnsj-Pb_ESylyW3EiBPAPucU-gG1GutcFYjghOucNGv6jhm2l3ffjopU_0T1TOi5_vBFp0rMdK3IzAQI0m1TKglZWi4TlLOhvRKItPmDyKQbH-RCsO7bq9NZrfbmR3QEcnCoj-0RYyZXFX1l9pcAuCm_6nHdBPdUmnuCdfV-_TSuTybPiUH-CXz-6CgcBmIKCl9gumR353F31z2l7lpJt7TbyHRlag" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Pastel de Chocolate</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$72.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="tall frappe topped with whipped cream and caramel drizzle in a clear glass, refreshment cafe style" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4roWRHnWSQY1XozaKGmqKTbfXN6hLbsvfx8-NdaKg89PCLeNRlxmotcSMtcorJsuSAB8rscVFJuC3nrOfyyjP3fwwwdaboGPXef2ECkg-_jCf6GDPib5mCPH2bUINObRe0zHwv5MijDfbzHhqKHnDh78pOdVvIAwSyu1CE1graP3871i9lx0B3GcOHW60BlbADjUmmr0AAAe-12HpWtFY2NGPIh5eyA7DdBx7IYFYIs9IZp8QYPpBP8Qoy9GzDjC6soBq7KIL7-Y" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Frappé de Caramelo</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$68.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="selection of artisanal sourdough breads on a flour-dusted surface, rustic bakery morning light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw0RwmimDHMgW4VLc8xhiZqQ3B0b8vDcGWDKBT5C8giovXFSyY60sFq1hfHFN078SdH18wsmVs5w0xfqQm8E180TlhHBjixIgkpmobzbdF9FhFwAtgM0njVMKtD7Uu9ib_D94xkgSIGs2d6ak8cpu7AGB-7So_U3wh6YlP7JR1O4v0uGKTXSvu0c8gU-cx0g12jq8x9aMJnz04ljlcqtB9W8Dw5x0VDE3H12PstI742ve9JBZUrqh8_AlHilbgtYtZjHveuuCL2OE" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Pan de Masa Madre</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$55.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="group bg-surface-container-lowest p-3 rounded-2xl transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 cursor-pointer flex flex-col">
                        <div class="relative aspect-square mb-3 overflow-hidden rounded-xl">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="hot green matcha latte with delicate foam art in a white ceramic cup, minimalist aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1xCmsrOUUcQJMG-iypASaOrjHQ3XfR3AqkYjFQxQcXN3CXGUrWPDookosb5MreZQiPoUVujwzOp1SCpfjyaUUTNdKjOeAqV_RbLQLalVWV5pcbCvv_0qJlFhT8t0s590O1ERjeKH0KHWHiFqv-b4qh1JNvttMDkJjh-ZyKkIjt2K6xWLlmElQ_mTriocHolVgsXA9KplFxQ_E_V0ha2Z_kLsfG3J3xqYQROAuDQyRUh124z-x6n-w2EbGF0J_TD_f5pXUVu_LX7Q" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-body font-bold text-primary mb-1">Té Matcha Latte</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-secondary font-bold">$62.00</span>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity">add_circle</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Sidebar (Right) -->
            <div class="w-[400px] bg-surface flex flex-col shadow-[-12px_0_32px_rgba(47,2,16,0.03)] z-20">
                <div class="p-6 border-b border-surface-container-highest">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-primary">Pedido #1042</h2>
                        <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed text-xs font-bold rounded-full">Para llevar</span>
                    </div>
                </div>
                <!-- Order List -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <!-- Item -->
                    <div class="flex gap-4 group">
                        <div class="w-16 h-16 rounded-xl bg-surface-container-highest overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover" data-alt="small thumbnail of a strawberry crepe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLkRnEhTfiiZUZd0hWcCmz4dQHMM3J1uWXL89ORM88VBlV250eoLyQQ2a7SX0GtvQE9-sApXLl9-rfEhw8UeUfPhOv0sl72qR9Nyy8w4jRngcKMr37hR6JMW92-0GqM3PZg7RUQhsojw1PPejNXLlRNImV1K3Z_sUAGHJOa4yT0P4ZYQ5rO0dgguqL_SNS6PY51EbRb8-wWd3vDzTxDvUsGfuDK6A27BAdJE4vK2t_CxrbclrovDSIQjeFAYsnBWqCwoNSrXHHIns" />
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <p class="text-sm font-bold text-primary leading-tight">Crepa de Fresa</p>
                                <button class="text-error/40 hover:text-error transition-colors">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                            <p class="text-xs text-on-surface-variant mb-2">+ Chocolate extra</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3 bg-surface-container p-1 rounded-lg">
                                    <button class="w-6 h-6 flex items-center justify-center rounded-md bg-surface-container-lowest text-primary hover:bg-white transition-colors"><span class="material-symbols-outlined text-sm">remove</span></button>
                                    <span class="text-xs font-bold">1</span>
                                    <button class="w-6 h-6 flex items-center justify-center rounded-md bg-secondary text-white hover:bg-primary transition-colors"><span class="material-symbols-outlined text-sm">add</span></button>
                                </div>
                                <span class="text-sm font-bold text-primary">$85.00</span>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="flex gap-4 group">
                        <div class="w-16 h-16 rounded-xl bg-surface-container-highest overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover" data-alt="small thumbnail of a cappuccino coffee" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDt__PsxcqIDFI1peETjSCNAGkJZssF4kGnBmHQtxDN5TlqZoR-R5uwrrq2nWsSpWljgWNjyHyVAjqK0ZoVPifziNlpGlzgBV5wcsHSgTuUzKGExeHVGBE7RYV3Aetg4I70LcpwxCVdT79BJQnzhJTQf_MUZBZoTQ0ygBto11eSoJv-KJgB9kGlaSBsio-FRluIPlSJN6GUsryl6lnrPWlUnuA34_6x-ftZlQci-hfst4sMEZYAE32MYbki7MYUkdoJnGB9dTaNw3I" />
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <p class="text-sm font-bold text-primary leading-tight">Capuccino Clásico</p>
                                <button class="text-error/40 hover:text-error transition-colors">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                            <p class="text-xs text-on-surface-variant mb-2">Descafeinado, Leche de almendras</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3 bg-surface-container p-1 rounded-lg">
                                    <button class="w-6 h-6 flex items-center justify-center rounded-md bg-surface-container-lowest text-primary hover:bg-white transition-colors"><span class="material-symbols-outlined text-sm">remove</span></button>
                                    <span class="text-xs font-bold">2</span>
                                    <button class="w-6 h-6 flex items-center justify-center rounded-md bg-secondary text-white hover:bg-primary transition-colors"><span class="material-symbols-outlined text-sm">add</span></button>
                                </div>
                                <span class="text-sm font-bold text-primary">$90.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Totals & Actions -->
                <div class="p-6 bg-surface-container-low border-t border-surface-container-highest rounded-t-[32px] shadow-[0_-8px_24px_rgba(47,2,16,0.02)]">
                    <button class="w-full flex items-center justify-between px-4 py-3 bg-surface-container-lowest rounded-xl mb-6 group hover:bg-white transition-colors">
                        <div class="flex items-center gap-3 text-secondary">
                            <span class="material-symbols-outlined">sell</span>
                            <span class="text-sm font-bold">Aplicar Descuento</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </button>
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm text-on-surface-variant">
                            <span>Subtotal</span>
                            <span class="font-bold">$175.00</span>
                        </div>
                        <div class="flex justify-between text-sm text-on-surface-variant">
                            <span>IVA (16%)</span>
                            <span class="font-bold">$28.00</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 mt-2 border-t border-outline-variant/30">
                            <span class="font-serif text-xl font-bold text-primary">Total</span>
                            <span class="font-serif text-3xl font-bold text-primary">$203.00</span>
                        </div>
                    </div>
                    <button class="w-full py-4 bg-primary text-white rounded-2xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all mb-4 flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">payments</span>
                        Cobrar
                    </button>
                    <div class="grid grid-cols-3 gap-3">
                        <button class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-highest text-on-surface-variant hover:bg-white transition-colors active:scale-95">
                            <span class="material-symbols-outlined mb-1">receipt</span>
                            <span class="text-[10px] font-bold uppercase tracking-wider">Ticket</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-highest text-on-surface-variant hover:bg-white transition-colors active:scale-95">
                            <span class="material-symbols-outlined mb-1">add_box</span>
                            <span class="text-[10px] font-bold uppercase tracking-wider">Nuevo</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-3 rounded-xl bg-surface-container-highest text-error/80 hover:bg-error-container/30 transition-colors active:scale-95">
                            <span class="material-symbols-outlined mb-1">delete_sweep</span>
                            <span class="text-[10px] font-bold uppercase tracking-wider">Limpiar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>