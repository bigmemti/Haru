<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ (in_array(app()->getLocale(), ['fa', 'ar'])) ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/flickity/dist/flickity.min.css'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header>
            <x-landing.navigation/>
        </header>

        <main>
            <div class="container mx-auto px-16">
                <section id="hero">
                    <div class="flex gap-6 my-4">
                        <div class="flex-[0_0_75%]">
                            <img class="rounded-lg" src="https://zagros.market/uploads/slidezagros-1.jpg" alt="">
                        </div>
                        <div class=" flex flex-col gap-4">
                            <a href="">
                                <img class="rounded-lg" src="https://zagros.market/uploads/banerchaei.jpg" alt="">
                            </a>
                            <a href="">
                                <img class="rounded-lg" src="https://zagros.market/uploads/banermaye.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </section>

                <x-carousel background="bg-fuchsia-300" />

                {{--  <x-carousel background="bg-green-500"/> --}}

                <section id="categories">
                    <h2 class="text-2xl font-bold text-center">دسته بندی کالاهای هایپر</h2>
                    <div class="my-4 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                        <x-landing.category-card/>
                    </div>
                </section>
                <x-carousel background="bg-orange-600"/>

                <section id="banners">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <a href="#" target="_blank">
                                <img class="rounded-lg" src="https://www.zagros.market/uploads/بنر-محصولات-صبحانه.jpg">
                            </a>
                        </div>
                        <div>
                            <a href="#" target="_blank">
                                <img class="rounded-lg" src="https://www.zagros.market/uploads/بنر-محصولات-پروتئین.jpg">
                            </a>
                        </div>
                        <div>
                            <a href="#" target="_blank">
                                <img class="rounded-lg"  src="https://www.zagros.market/uploads/خنک-بنوش.jpg">
                            </a>
                        </div>
                        <div>
                            <a href="#" target="_blank">
                                <img class="rounded-lg" src="https://www.zagros.market/uploads/وسایل-نظافت-منزل.jpg">
                            </a>
                        </div>
                    </div>
                </section>

                <x-carousel background="bg-gray-100"/>

                <section>
                    <div>
                        <a href="#" target="_blank">
                            <img class="rounded-lg" src="https://www.zagros.market/uploads/خشکبار.jpg">
                        </a>
                    </div>
                </section>

                <x-carousel background="bg-gray-100"/>
            </div>
        </main>
        {{-- <x-landing.footer/> --}}
    </body>
</html>
