<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }} {{ $order->user->name }} # {{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{ __('Product') }}</th>
                              <th>{{ __('Price') }}</th>
                              <th>{{ __('Quantity') }}</th>
                              <th>{{ __('Sum') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td> {{ $product->name }} # {{ $product->id }}</td>
                                    <td> {{ $product->price }}</td>
                                    <td> {{ $product->pivot->quantity }}</td>
                                    <td> {{ $product->pivot->quantity * $product->price }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3">{{ __('Total') }}</th>
                                <td> {{ $order->total_price }} </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Sum') }}</th>
                            </tr>
                          </tfoot>
                        </table>
                    </div>
                    <div x-data="{status : {{ $order->status }}, submit(status){this.status = status;console.log(this.status); $refs.form.submit()}}">
                        {{-- TODO : dosen't work --}}
                        <form action="{{ route('dashboard.order.update', ['order' => $order]) }}" method="POST" x-ref='form'>
                            @csrf
                            @method('PATCH')
                            <input type="text" x-model="status" name="status">
                            <details class="dropdown">
                                <summary class="btn m-1">{{ $order->status }}</summary>
                                <ul class="menu dropdown-content bg-base-100 rounded-box z-20 w-52 p-2 shadow">
                                  <li><a @click="submit({{ $order::ORDER_CREATED_STATUS }})">{{ $order::ORDER_CREATED_STATUS }}</a></li>
                                  <li><a @click="submit(2)">2</a></li>
                                </ul>
                              </details>
                              @error('status')
                                  <span>{{ $message }}</span>
                              @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
