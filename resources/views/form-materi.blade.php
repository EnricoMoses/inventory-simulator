<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Materi CRUD</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
  <div class="max-w-5xl mx-auto">

    <h1 class="text-3xl text-center font-bold mb-6 text-gray-800">
      Materi CRUD
    </h1>

    <div class="bg-white shadow-lg rounded-2xl p-6 mx-4 mb-8">

      <h2 class="text-xl text-center font-bold mb-4 text-gray-700">
        Add New Book
      </h2>

      <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('addBook') }}" method="POST"
        enctype="multipart/form-data" class="">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Title:
          </label>
          <input type="text"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            name="book_title" placeholder="title">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Author:
          </label>
          <input type="text"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Author" name="book_author">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Publisher:
          </label>
          <input type="text"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Publisher" name="book_publisher">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Cover:
          </label>
          <input type="file" name="book_cover"
            class="border border-gray-300 rounded-lg px-3 py-2
              file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0
              file:bg-gray-500 file:text-white">
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Description:
          </label>
          <textarea class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            name="book_description" placeholder="Description"></textarea>
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
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 mx-3">

      <h2 class="text-xl font-bold mb-4 text-gray-700 text-center">
        Books
      </h2>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
              <th class="p-3">No</th>
              <th class="p-3">Title</th>
              <th class="p-3">Author</th>
              <th class="p-3">Publisher</th>
              <th class="p-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">

            {{-- <td class="p-3">{{$book->cover}}></td>
                                <td class="p-3">{{$book->description}}></td>  --}}

            @forelse ($books as $index => $book)
              <tr class="border-t hober:bg-gray-100">
                <td class="p-3">{{ $index + 1 }}</td>
                <td class="p-3">{{ $book->title }}</td>
                <td class="p-3">{{ $book->author }}</td>
                <td class="p-3">{{ $book->publisher }}</td>
                <td class="p-3 text-center flex gap-2 justify-center">
                  <button class="bg-blue-400 text-white px-3 py-1 rounded-lg text-sm"
                    onclick="openEditModal({{ $book->id }})">
                    Edit
                  </button>
                  <button class="bg-green-400 text-white px-3 py-1 rounded-lg text-sm hover:cursor-pointer"
                    onclick="getBookDetails({{ $book->id }})">
                    Details
                  </button>
                  <button class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm"
                    onclick="deleteBook({{ $book->id }})">
                    Delete
                  </button>
                </td>
              </tr>
            @empty
              {{-- <h1>No Books Available</h1>    --}}
            @endforelse

          </tbody>
        </table>
      </div>

    </div>

  </div>

  <div id="bookModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">

    <div class="bg-white w-[500px] rounded-2xl p-6 relative">

      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black">
        ✕
      </button>

      <h2 class="text-2xl font-bold mb-4 text-center">Book Details</h2>

      <div class="space-y-2">
        <img id="modalCover" class="w-32 mx-auto mb-3 hidden" />

        <p><strong>Title:</strong> <span id="modalTitle"></span></p>
        <p><strong>Author:</strong> <span id="modalAuthor"></span></p>
        <p><strong>Publisher:</strong> <span id="modalPublisher"></span></p>
        <p><strong>Description:</strong></p>
        <p id="modalDescription" class="text-gray-600"></p>
      </div>

    </div>

  </div>

  <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">

    <div class="bg-white w-[500px] rounded-2xl p-6 relative">

      <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-500 hover:text-black">
        ✕
      </button>

      <h2 class="text-2xl font-bold mb-4 text-center">Edit Book</h2>

      <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-3">

          <input type="hidden" name="id" id="editBookId">

          <div>
            <label class="text-sm">Title</label>
            <input type="text" name="book_title" id="editTitle" class="w-full border rounded-lg px-3 py-2">
          </div>

          <div>
            <label class="text-sm">Author</label>
            <input type="text" name="book_author" id="editAuthor" class="w-full border rounded-lg px-3 py-2">
          </div>

          <div>
            <label class="text-sm">Publisher</label>
            <input type="text" name="book_publisher" id="editPublisher"
              class="w-full border rounded-lg px-3 py-2">
          </div>

          <div>
            <label class="text-sm">Cover</label>
            <input type="file" name="book_cover" class="w-full border rounded-lg px-3 py-2">
          </div>

          <div>
            <label class="text-sm">Description</label>
            <textarea name="book_description" id="editDescription" class="w-full border rounded-lg px-3 py-2"></textarea>
          </div>

          <div class="flex gap-2 mt-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
              Update
            </button>

            <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded-lg">
              Cancel
            </button>
          </div>

        </div>
      </form>

    </div>
  </div>


  <script>
    function getBookDetails(id) {

      fetch(`/books/${id}`)
        .then(response => response.json())
        .then(data => {

          document.getElementById('modalTitle').innerText = data.title;
          document.getElementById('modalAuthor').innerText = data.author;
          document.getElementById('modalPublisher').innerText = data.publisher;
          document.getElementById('modalDescription').innerText = data.description;

          const coverImg = document.getElementById('modalCover');

          if (data.cover) {
            coverImg.src = "/storage/" + data.cover;
            coverImg.classList.remove('hidden');
          } else {
            coverImg.classList.add('hidden');
          }

          document.getElementById('bookModal').classList.remove('hidden');
          document.getElementById('bookModal').classList.add('flex');
        });
    }

    function closeModal() {
      // document.getElementById('bookModal').classList.remove('flex');
      document.getElementById('bookModal').classList.add('hidden');
    }

    function deleteBook(id) {

      if (!confirm("Are you sure?")) return;

      fetch(`delete/books/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
        .then(response => response.json())
        .then(data => {
          location.reload();
        });
    }

    function openEditModal(id) {

      fetch(`/books/${id}`)
        .then(response => response.json())
        .then(data => {

          document.getElementById('editBookId').value = data.id;
          document.getElementById('editTitle').value = data.title;
          document.getElementById('editAuthor').value = data.author;
          document.getElementById('editPublisher').value = data.publisher;
          document.getElementById('editDescription').value = data.description;

          // set action buat form, di web.php itu yg ini route ny: Route::put('/books/{id}', [BookController::class, 'updateBook'])->name('updateBook');
          document.getElementById('editForm').action = `/books/${data.id}`;

          document.getElementById('editModal').classList.remove('hidden');
          document.getElementById('editModal').classList.add('flex');
        });
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }
  </script>
</body>

</html>
