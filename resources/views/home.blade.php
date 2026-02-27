{{-- boleh pakai ini langsung, atau mau dihapus semua terus kerja dari awal juga boleh --}}

@extends('layouts.form')

@section('form')
  {{-- boleh diisi pakai template form yang ada di folder template: form-template. atau mau bikin form sendiri juga boleh --}}
  @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif
  <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('members.store') }}" method="POST"
    enctype="multipart/form-data" class="">
    @csrf

    <div>
      <label
        class="@error('first_name')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        First Name:
      </label>
      <input type="text" value="{{ old('first_name') }}"
        class="@error('first_name') 
          border-red-500 ring-2 ring-red-500
        @enderror w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        name="first_name" placeholder="Enter first name">
      @error('first_name')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label
        class="@error('last_name')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        Last Name:
      </label>
      <input type="text" value="{{ old('last_name') }}"
        class="@error('last_name')
          border-red-500 ring-2 ring-red-500
        @enderror w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        placeholder="Enter last name" name="last_name">
      @error('last_name')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="@error('hobby')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        Hobby:
      </label>
      <input type="text" value="{{ old('hobby') }}"
        class="@error('hobby')
          border-red-500 ring-2 ring-red-500
        @enderror w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        placeholder="Enter hobby" name="hobby">
      @error('hobby')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="@error('major')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        Major:
      </label>
      <select name="major"
        class="@error('major')
          border-red-500 ring-2 ring-red-500
        @enderror form-select border border-yellow-700 rounded-lg px-3 py-2">
        <option value="default" disabled selected>Select the major</option>
        <option value="Informatics">Informatics</option>
        <option value="Data Science & Analitics">Data Science & Analitics</option>
        <option value="Bussiness Information System">Bussiness Information System</option>

      </select>
      @error('major')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label
        class="@error('profile_picture')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        Profile Picture:
      </label>
      <input type="file" name="profile_picture" value="{{ old('profile_picture') }}"
        class="@error('profile_picture')
          border-red-500 ring-2 ring-red-500
        @enderror border border-gray-300 rounded-lg px-3 py-2 file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-gray-500 file:text-white">
      @error('profile_picture')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div class="md:col-span-2">
      <label class="@error('bio')
        text-red-500
      @enderror block text-sm font-medium text-gray-600 mb-1">
        Bio:
      </label>
      <textarea value="{{ old('bio') }}"
        class="@error('bio')
          border-red-500 ring-2 ring-red-500
        @enderror w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        name="bio" placeholder="Enter bio"></textarea>
      @error('bio')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
      @enderror
    </div>

    <div class="md:col-span-2 flex gap-3 mt-2">
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
        Save
      </button>

      <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
        Clear
      </button>
    </div>

  </form>
@endsection

@section('table')
  {{-- ini tabel buat nampilin data dari db + buat actions nya (edit, delete, details). 
boleh copas dari template nya (folder template: table-template) 
kalau mau buat sendiri juga boleh. --}}
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
          <th class="p-3">No</th>
          <th class="p-3">First Name</th>
          <th class="p-3">Last Name</th>
          <th class="p-3">Major</th>
          <th class="p-3 text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @forelse ($members as $index => $member)
          <tr class="border-t hober:bg-gray-100">
            <td class="p-3">{{ $index + 1 }}</td>
            <td class="p-3">{{ $member->first_name }}</td>
            <td class="p-3">{{ $member->last_name ?? 'N/A' }}</td>
            <td class="p-3">{{ $member->major }}</td>
            <td class="p-3 text-center flex gap-2 justify-center">
              <a href="{{ route('members.edit', $member->id) }}"
                class="bg-blue-400 text-white px-3 py-1 rounded-lg text-sm">
                Edit
              </a>
              <a href="{{ route('members.view', $member->id) }}"
                class="bg-green-400 text-white px-3 py-1 rounded-lg text-sm">
                Details
              </a>
              <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this member?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-red-500 py-4">No Members Available</td>
          </tr>
        @endforelse


      </tbody>
    </table>
  </div>

  @if (isset($viewMember))
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center">
      <div class="bg-white w-[500px] rounded-2xl p-6 relative">

        <a href="{{ route('members.index') }}" class="absolute top-3 right-3 text-gray-500 hover:text-black">
          ✕
        </a>

        <h2 class="text-2xl font-bold mb-4 text-center">Member Details</h2>

        @if ($viewMember->profile_picture)
          <img src="{{ asset('storage/' . $viewMember->profile_picture) }}" class="w-32 mx-auto mb-3 rounded-lg">
        @endif

        <p><strong>First Name:</strong> {{ $viewMember->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $viewMember->last_name ?? 'N/A' }}</p>
        <p><strong>Major:</strong> {{ $viewMember->major }}</p>
        <p><strong>Hobby:</strong> {{ $viewMember->hobby ?? 'N/A' }}</p>
        <p><strong>Bio:</strong> {{ $viewMember->bio ?? 'N/A' }}</p>

      </div>
    </div>
  @endif

  @if (isset($editMember))
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center">
      <div class="bg-white w-[500px] rounded-2xl p-6 relative">

        <a href="{{ route('members.index') }}" class="absolute top-3 right-3 text-gray-500 hover:text-black">
          ✕
        </a>

        <h2 class="text-2xl font-bold mb-4 text-center">Edit Member</h2>

        <form action="{{ route('members.update', $editMember->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="space-y-3">

            <input type="text" name="first_name" value="{{ $editMember->first_name }}"
              class="w-full border rounded-lg px-3 py-2">

            <input type="text" name="last_name" value="{{ $editMember->last_name }}"
              class="w-full border rounded-lg px-3 py-2">

            <input type="text" name="hobby" value="{{ $editMember->hobby }}"
              class="w-full border rounded-lg px-3 py-2">

            <select name="major" class="w-full border rounded-lg px-3 py-2">
              <option value="Informatics" {{ $editMember->major == 'Informatics' ? 'selected' : '' }}>Informatics
              </option>
              <option value="Data Science & Analitics"
                {{ $editMember->major == 'Data Science & Analitics' ? 'selected' : '' }}>Data Science & Analitics
              </option>
              <option value="Bussiness Information System"
                {{ $editMember->major == 'Bussiness Information System' ? 'selected' : '' }}>Bussiness Information System
              </option>
            </select>

            <textarea name="bio" class="w-full border rounded-lg px-3 py-2">{{ $editMember->bio }}</textarea>

            <input type="file" name="profile_picture" class="w-full border rounded-lg px-3 py-2">

            <div class="flex gap-2 mt-3">
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Update
              </button>

              <a href="{{ route('members.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg text-center">
                Cancel
              </a>
            </div>

          </div>
        </form>

      </div>
    </div>
  @endif

@endsection

{{-- kalau copy dari template coba ubah tampilannya dikit", kek warna/tulisan dll nya buat latihan tailwind nya jugaa --}}
