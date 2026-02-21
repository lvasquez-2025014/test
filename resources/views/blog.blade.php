<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white shadow">
  <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-indigo-600">TuEmpresa</h1>
    <div class="space-x-6 hidden md:block">
      <a href="/inicio" class="hover:text-indigo-600">Inicio</a>
      <a href="/servicios" class="hover:text-indigo-600">Servicios</a>
      <a href="/blog" class="hover:text-indigo-600">Blog</a>
      <a href="/nosotros" class="hover:text-indigo-600">Nosotros</a>
    </div>
  </div>
</nav>

<section class="bg-purple-600 text-white py-20 text-center">
  <h1 class="text-4xl font-bold">Nuestro Blog</h1>
  <p class="mt-4">Noticias, consejos y tendencias digitales</p>
</section>

<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-bold mb-2">Tendencias Web 2026</h3>
        <p class="text-gray-600 mb-4">Descubre las tecnologías que dominarán este año.</p>
        <a href="#" class="text-indigo-600 font-semibold">Leer más →</a>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      <img src="https://images.unsplash.com/photo-1552664730-d307ca884978" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-bold mb-2">Importancia del SEO</h3>
        <p class="text-gray-600 mb-4">Cómo mejorar tu posicionamiento en Google.</p>
        <a href="#" class="text-indigo-600 font-semibold">Leer más →</a>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-bold mb-2">Diseño centrado en el usuario</h3>
        <p class="text-gray-600 mb-4">Mejora la experiencia digital de tus clientes.</p>
        <a href="#" class="text-indigo-600 font-semibold">Leer más →</a>
      </div>
    </div>

  </div>
</section>

</body>
</html>