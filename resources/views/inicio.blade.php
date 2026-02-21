<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
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

<!-- Hero -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-24">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold mb-6">Impulsamos tu crecimiento digital</h2>
    <p class="text-lg mb-8 max-w-2xl mx-auto">
      Creamos soluciones modernas y escalables para llevar tu negocio al siguiente nivel.
    </p>
    <a href="servicios.html" class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow hover:bg-gray-200 transition">
      Nuestros Servicios
    </a>
  </div>
</section>

<!-- Servicios destacados -->
<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h3 class="text-3xl font-bold mb-12 text-indigo-600">¿Qué hacemos?</h3>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h4 class="text-xl font-semibold mb-4">Desarrollo Web</h4>
        <p>Sitios modernos, rápidos y optimizados.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h4 class="text-xl font-semibold mb-4">Marketing Digital</h4>
        <p>Estrategias para aumentar tu visibilidad.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
        <h4 class="text-xl font-semibold mb-4">Diseño UX/UI</h4>
        <p>Experiencias atractivas y funcionales.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="bg-indigo-600 text-white py-16 text-center">
  <h3 class="text-3xl font-bold mb-4">¿Listo para comenzar?</h3>
  <a href="#" class="bg-white text-indigo-600 px-6 py-3 rounded-xl font-semibold shadow hover:bg-gray-200 transition">
    Contáctanos
  </a>
</section>

</body>
</html>