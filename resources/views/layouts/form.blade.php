<!DOCTYPE html>
<html lang="en" class="bg-fixed bg-center bg-cover"
  style="background-image: url('{{ asset('images/bg_river.png') }}');">

<head>
  <meta charset="UTF-8">
  <title>Inventory Simulator</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    html,
    body {
      background-image: url('{{ asset('images/bg_river.png') }}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-color: #1e293b;
    }

    body {
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    body.loaded {
      opacity: 1;
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@400&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-transparent">

  <div class="font-geologica min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">

      <div class="text-center mb-12">

        <h1
          class="font-geologica text-6xl md:text-7xl
               font-black tracking-wider
               text-white
               glow-strong mb-6">
          INVENTORY SIMULATOR
        </h1>

        <p class="font-campana text-4xl md:text-5xl
              text-white
              glow-strong tracking-wide">
          Strengthened Through Every Season
        </p>

      </div>

      @yield('content')

    </div>

  </div>

  <script src="//unpkg.com/alpinejs" defer></script>
  <script>
    window.addEventListener("load", () => {
      document.body.classList.add("loaded");
    });
  </script>
</body>

</html>
