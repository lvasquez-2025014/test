<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acerca de Nosotros</title>
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

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">Acerca de Nosotros</h1>
      <p class="text-lg md:text-xl max-w-3xl mx-auto">
        Somos una empresa apasionada por la innovación, comprometida en ofrecer soluciones digitales de alta calidad que impulsan el crecimiento de nuestros clientes.
      </p>
    </div>
  </section>

  <!-- Nuestra Historia -->
  <section class="py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h2 class="text-3xl font-bold mb-4 text-indigo-600">Nuestra Historia</h2>
        <p class="mb-4">
          Desde nuestros inicios, hemos trabajado con dedicación y creatividad para construir soluciones tecnológicas innovadoras. 
          Creemos en el poder de la tecnología para transformar negocios y mejorar vidas.
        </p>
        <p>
          Nuestro equipo combina experiencia, talento y pasión para ofrecer resultados excepcionales en cada proyecto.
        </p>
      </div>
      <div>
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d" 
             alt="Equipo de trabajo" 
             class="rounded-2xl shadow-lg">
      </div>
    </div>
  </section>

  <!-- Misión, Visión y Valores -->
  <section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-12 text-indigo-600">Nuestros Principios</h2>

      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
          <h3 class="text-xl font-semibold mb-4">Misión</h3>
          <p>
            Brindar soluciones digitales innovadoras que ayuden a nuestros clientes a alcanzar sus objetivos.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
          <h3 class="text-xl font-semibold mb-4">Visión</h3>
          <p>
            Ser referentes en el sector tecnológico, reconocidos por nuestra calidad y compromiso.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition">
          <h3 class="text-xl font-semibold mb-4">Valores</h3>
          <p>
            Innovación, responsabilidad, trabajo en equipo y orientación al cliente.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Nuestro Equipo -->
  <section class="py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-12 text-indigo-600">Nuestro Equipo</h2>

      <div class="grid md:grid-cols-3 gap-8">
        
        <div class="bg-white rounded-2xl shadow-lg p-6">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" 
               class="w-24 h-24 mx-auto rounded-full mb-4">
          <h3 class="text-xl font-semibold">Carlos Martínez</h3>
          <p class="text-gray-500">CEO & Fundador</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" 
               class="w-24 h-24 mx-auto rounded-full mb-4">
          <h3 class="text-xl font-semibold">Ana López</h3>
          <p class="text-gray-500">Directora de Tecnología</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
          <img src="https://randomuser.me/api/portraits/men/75.jpg" 
               class="w-24 h-24 mx-auto rounded-full mb-4">
          <h3 class="text-xl font-semibold">Luis Gómez</h3>
          <p class="text-gray-500">Diseñador UX/UI</p>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="bg-indigo-600 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-6">
      <h2 class="text-3xl font-bold mb-6">¿Quieres trabajar con nosotros?</h2>
      <p class="mb-6">
        Contáctanos hoy mismo y descubre cómo podemos ayudarte a impulsar tu proyecto.
      </p>
      <a href="#"
         class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow hover:bg-gray-200 transition">
        Contáctanos
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 py-6">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <p>&copy; 2026 Tu Empresa. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>