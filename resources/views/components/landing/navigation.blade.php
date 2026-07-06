<nav>
    <div class="border-b shadow-md">
        <div class="container mx-auto navbar  items-start mt-1">
            <div class="flex-1 flex-col items-start gap-2">
                <div class="flex gap-4">
                    <a class="btn btn-ghost text-xl light:text-black">{{ config('app.name', 'Laravel') }}</a>
                    <label class="input light:bg-white input-bordered flex rtl:flex-row-reverse items-center gap-2">
                      <input type="text" class="grow border-0 focus:ring-0" placeholder="{{ __('Search') }}" />
                      <i class="fa-sharp fa-light fa-magnifying-glass"></i>
                    </label>
                </div>
                <div class="flex">
                    <ul class="menu menu-horizontal bg-base-200 bg-inherit light:text-black">
                        <li><a>{{ __('Home') }}</a></li>
                        <li><a>{{ __('How to order') }}</a></li>
                        <li><a>{{ __('My orders') }}</a></li>
                        <li><a>{{ __('About us') }}</a></li>
                        <li><a>{{ __('Contact us') }}</a></li>
                        <li><a>{{ __('Shop') }}</a></li>
                      </ul>
                </div>
            </div>
            <div class="flex-none">
                <a href="{{ route('login') }}">
                    <button class="btn light:btn-primary">
                        {{ __('login | register') }}
                    </button>
                </a>
                <div class="divider lg:divider-horizontal py-1"></div>
              <div class="p-2 h-9 w-9 flex items-center justify-center border-2 rounded-full">
                <i class="fa-sharp fa-light cursor-pointer fa-rotate-by transition-all duration-150" :class="{'fa-sun-bright' : darkMode === 'light', 'fa-moon ' : darkMode === 'dark'}" style="--fa-rotate-angle: -45deg;" @click="darkMode = (darkMode === 'dark')? 'light' : 'dark'"></i>
              </div>
              <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                  <div class="indicator">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="badge badge-sm badge-error indicator-item">8</span>
                  </div>
                </div>
                <div
                  tabindex="0"
                  class="card card-compact dropdown-content bg-base-100 z-[1] mt-3 w-52 shadow">
                  <div class="card-body">
                    <span class="text-lg font-bold">8 Items</span>
                    <span class="text-info">Subtotal: $999</span>
                    <div class="card-actions">
                      <button class="btn btn-primary btn-block">View cart</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
    </div>
</nav>
