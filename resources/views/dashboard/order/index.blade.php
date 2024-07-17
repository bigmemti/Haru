<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{ __('Id') }}</th>
                              <th>{{ __('User') }}</th>
                              <th>{{ __('status') }}</th>
                              <th>{{ __('Expired At') }}</th>
                              <th>{{ __('Created At') }}</th>
                              <th>{{ __('Updated At') }}</th>
                              <th>{{ __('Actions') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td> {{ $order->user->name }}</td>
                                <td> {{ $order->status }}</td>
                                <td> {{ $order->expired_at }}</td>
                                <td> {{ $order->created_at }}</td>
                                <td> {{ $order->updated_at }}</td>
                                <th>
                                  <a href="{{ route('dashboard.order.show', ['order' => $order]) }}" class="btn text-white btn-info btn-xs">{{ __('show') }}</a>
                                  <form x-data='{show : false}' x-ref="form" @submit.prevent="show = true" action="{{ route('dashboard.order.destroy', ['order' => $order]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-error text-white btn-xs">{{ __('delete') }}</button>
                                    <dialog :class="{'modal-open' : show}" class="modal">
                                        <div @click.outside="open = false" class="modal-box">
                                          <h3 class="text-lg font-bold text-warning">{{ __('Warning') }}!</h3>
                                          <p class="py-4">{{ __('are you sure?') }}</p>
                                          <div class="modal-action space-x-3 rtl:space-x-reverse">
                                            <label class="btn" @click="show = false">{{ __('Cancel') }}</label>
                                            <button class="btn btn-error text-white" @click="$refs.form.submit()">{{ __('delete') }}</button>
                                          </div>
                                        </div>
                                    </dialog>
                                  </form>
                                </th>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('status') }}</th>
                                <th>{{ __('Expired At') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                          </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast toast-top toast-end" >
        @if (session('success'))
            <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
            <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
          <span>{{ session('warning') }}</span>
        </div>
        @endif
        @if (session('info'))
        <div class="alert alert-info" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
          <span>{{ session('info') }}</span>
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-neutral" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
          <span>{{ session('status') }}</span>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition>
          <span>{{ session('error') }}</span>
        </div>
        @endif
    </div>
</x-app-layout>
