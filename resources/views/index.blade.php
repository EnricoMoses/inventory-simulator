@extends('layouts.form')

@section('content')
  @if (session('success'))
    <div class="bg-green-500/80 backdrop-blur-md text-white px-4 py-2 rounded-lg mb-6 text-center">
      {{ session('success') }}
    </div>
  @endif


  {{-- FORM SECTION --}}
  <div class="relative z-30 overflow-visible backdrop-blur-xl bg-white/10 border border-white/30 rounded-2xl p-8 shadow-2xl mb-12">

    <h2 class="text-2xl font-semibold text-white mb-8 text-center">
      {{ isset($editItem) ? 'Edit Item' : 'Add New Item' }}
    </h2>

    <form method="POST"
      action="{{ isset($editItem) ? route('inventory.update', $editItem->id) : route('inventory.store') }}">
      @csrf
      @if (isset($editItem))
        @method('PUT')
      @endif

      <div class="grid md:grid-cols-3 gap-6">

        {{-- ITEM NAME --}}
        <div>
          <label class="block mb-2 
        @error('name') text-red-400 @else text-white @enderror">
            Item Name
          </label>

          <input type="text" name="name" value="{{ old('name', $editItem->name ?? '') }}"
            class="w-full bg-transparent border rounded-xl px-4 py-3 text-white
               transition-all duration-300
               focus:outline-none
               focus:ring-2 focus:ring-white/40
               focus:shadow-[0_0_15px_rgba(255,255,255,0.3)]
               @error('name')
                    border-red-400 focus:ring-red-400 focus:shadow-[0_0_15px_rgba(248,113,113,0.5)]
               @else
                    border-white/40
               @enderror">

          @error('name')
            <p class="text-red-400 text-sm mt-2 animate-fadeIn">
              {{ $message }}
            </p>
          @enderror
        </div>

        {{-- STOCK --}}
        <div>
          <label class="block mb-2 
        @error('stock') text-red-400 @else text-white @enderror">
            Stock Quantity
          </label>

          <div class="relative">

            <input type="number" name="stock" value="{{ old('stock', $editItem->stock ?? '') }}"
              class="w-full bg-transparent border rounded-xl px-4 py-3 pr-10 text-white
                   appearance-none transition-all duration-300
                   focus:outline-none
                   focus:ring-2 focus:ring-white/40 focus:shadow-[0_0_15px_rgba(255,255,255,0.3)]
                   @error('stock')
                        border-red-400 focus:ring-red-400/50 focus:ring-red-400 focus:shadow-[0_0_15px_rgba(248,113,113,0.5)]
                   @else
                        border-white/40
                   @enderror">

            {{-- Custom Arrows --}}
            <div class="absolute right-3 top-1/2 -translate-y-1/2 flex flex-col gap-1 text-white/80">

              <button type="button" onclick="this.closest('.relative').querySelector('input').stepUp()"
                class="hover:text-white transition leading-none text-sm">
                ▲
              </button>

              <button type="button" onclick="this.closest('.relative').querySelector('input').stepDown()"
                class="hover:text-white transition leading-none text-sm">
                ▼
              </button>

            </div>
          </div>

          @error('stock')
            <p class="text-red-400 text-sm mt-2 animate-fadeIn">
              {{ $message }}
            </p>
          @enderror
        </div>


        {{-- CATEGORY CUSTOM DROPDOWN --}}
        <div x-data="{ open: false, selected: '{{ $editItem->category ?? old('category', 'Spring') }}' }" class="relative">

          <label class="block mb-2 
        @error('category') text-red-400 @else text-white @enderror">
            Category
          </label>

          <input type="hidden" name="category" :value="selected">

          <div @click="open = !open" :class="open ? 'ring-2 ring-white/40' : ''"
            class="w-full bg-transparent border border-white/40
                rounded-xl px-4 py-3 flex justify-between items-center
                cursor-pointer transition-all duration-300">

            <span x-text="selected" class="text-white"></span>

            <svg class="w-4 h-4 text-white transition-transform duration-300" :class="open ? 'rotate-180' : ''"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>

          <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click.away="open = false"
            class="absolute w-full mt-2 backdrop-blur-xl bg-white/10
                border border-white/30 rounded-xl overflow-hidden z-50">

            @foreach (['Spring', 'Summer', 'Autumn', 'Winter'] as $cat)
              <div @click="selected='{{ $cat }}'; open=false"
                class="px-4 py-3 text-white hover:bg-white/20 cursor-pointer transition">
                {{ $cat }}
              </div>
            @endforeach

          </div>

          @error('category')
            <p class="text-red-400 text-sm mt-2 animate-fadeIn">
              {{ $message }}
            </p>
          @enderror
        </div>

      </div>

      <div class="mt-10 text-center">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white
                       px-8 py-2 rounded-lg transition duration-300">
          {{ isset($editItem) ? 'Update' : 'Save' }}
        </button>
      </div>

    </form>
  </div>



  {{-- TABLE SECTION --}}
  <div class="relative z-10 backdrop-blur-xl bg-white/10 border border-white/30 rounded-2xl p-8 shadow-2xl">

    <h2 class="text-xl font-semibold text-white mb-6 text-center">
      Inventory List
    </h2>

    <div class="overflow-x-auto">

      <table class="w-full text-white text-center">

        <thead>
          <tr class="border-b border-white/40">
            <th class="py-3">No</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse($items as $index => $item)
            <tr class="border-b border-white/20 hover:bg-white/10 transition">

              <td class="py-3">{{ $index + 1 }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->stock }}</td>
              <td>{{ $item->category }}</td>

              <td>
                @if ($item->stock == 0)
                  <span class="text-red-400 font-semibold">Out of Stock</span>
                @elseif($item->stock < 5)
                  <span class="text-yellow-300 font-semibold">Low Stock</span>
                @else
                  <span class="text-green-400 font-semibold">Available</span>
                @endif
              </td>

              <td class="flex justify-center gap-3 py-2">

                <a href="{{ route('inventory.edit', $item->id) }}"
                  class="bg-blue-500 hover:bg-blue-600
                                       text-white px-3 py-1 rounded-lg text-sm">
                  Edit
                </a>

                <form method="POST" action="{{ route('inventory.destroy', $item->id) }}"
                  onsubmit="return confirm('Delete this item?')">
                  @csrf
                  @method('DELETE')

                  <button
                    class="bg-red-500 hover:bg-red-600
                                           text-white px-3 py-1 rounded-lg text-sm">
                    Delete
                  </button>
                </form>

              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-6 text-white/70">
                No items available.
              </td>
            </tr>
          @endforelse
        </tbody>

      </table>

    </div>

  </div>
@endsection
