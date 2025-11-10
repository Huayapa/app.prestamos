<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-900">BiblioSystem</h2>
                        <p class="text-xs text-gray-500">v1.0</p>
                    </div>
                </div>
            </div>
            
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 bg-gray-900 text-white rounded-lg">
                            <i class="fas fa-book w-5"></i>
                            <span class="font-medium">Gestión de Libros</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <i class="fas fa-hand-holding-heart w-5"></i>
                            <span class="font-medium">Préstamos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium">Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <i class="fas fa-chart-bar w-5"></i>
                            <span class="font-medium">Reportes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <i class="fas fa-cog w-5"></i>
                            <span class="font-medium">Configuración</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Administrador</p>
                        <p class="text-xs text-gray-500">admin@biblioteca.com</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestión de Libros</h1>
                        <p class="text-gray-600">Administre el catálogo de la biblioteca</p>
                    </div>
                    <button onclick="openModal()" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                        <i class="fas fa-plus"></i>
                        Agregar Libro
                    </button>
                </div>

                <!-- Search Card -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-6">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input 
                                type="text" 
                                id="searchInput" 
                                placeholder="Buscar por título, autor o ISBN..." 
                                oninput="filterBooks()"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                            >
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-y border-gray-200">
                                <tr>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">ID</th>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Título</th>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Autor</th>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">ISBN</th>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Categoría</th>
                                    <th class="text-center py-3 px-6 text-sm font-semibold text-gray-700">Total</th>
                                    <th class="text-center py-3 px-6 text-sm font-semibold text-gray-700">Disponibles</th>
                                    <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Año</th>
                                    <th class="text-right py-3 px-6 text-sm font-semibold text-gray-700">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="booksTable"></tbody>
                        </table>
                        <div id="emptyState" class="text-center py-12 text-gray-500" style="display: none;">
                            No se encontraron libros
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-sm font-semibold text-gray-600 mb-3">Total de Libros</h3>
                        <p class="text-3xl font-bold text-gray-900 mb-1" id="totalBooks">0</p>
                        <p class="text-xs text-gray-500">títulos únicos</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-sm font-semibold text-gray-600 mb-3">Ejemplares Totales</h3>
                        <p class="text-3xl font-bold text-gray-900 mb-1" id="totalCopies">0</p>
                        <p class="text-xs text-gray-500">en el catálogo</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-sm font-semibold text-gray-600 mb-3">Disponibilidad</h3>
                        <p class="text-3xl font-bold text-gray-900 mb-1" id="availability">0%</p>
                        <p class="text-xs text-gray-500">libros disponibles</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div id="bookModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-1">Agregar Nuevo Libro</h2>
                <p class="text-sm text-gray-600">Complete los detalles del libro. Todos los campos son obligatorios.</p>
            </div>
            
            <form id="bookForm" onsubmit="handleSubmit(event)">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                            <input type="text" id="titulo" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                        <div>
                            <label for="autor" class="block text-sm font-medium text-gray-700 mb-2">Autor</label>
                            <input type="text" id="autor" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                        <div>
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                            <input type="text" id="isbn" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                        <div>
                            <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                            <input type="text" id="categoria" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                        <div>
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-2">Cantidad de Ejemplares</label>
                            <input type="number" id="cantidad" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                        <div>
                            <label for="anio" class="block text-sm font-medium text-gray-700 mb-2">Año de Publicación</label>
                            <input type="number" id="anio" min="1800" max="2025" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        </div>
                    </div>
                </div>
                
                <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                        Agregar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let books = [
            { id: '1', titulo: 'Introducción a la Programación', autor: 'Juan Pérez', isbn: '978-1234567890', categoria: 'Informática', cantidad: 10, disponibles: 7, anioPublicacion: 2020 },
            { id: '2', titulo: 'Cálculo Diferencial', autor: 'María García', isbn: '978-0987654321', categoria: 'Matemáticas', cantidad: 15, disponibles: 12, anioPublicacion: 2019 },
            { id: '3', titulo: 'Estructuras de Datos', autor: 'Carlos López', isbn: '978-1122334455', categoria: 'Informática', cantidad: 8, disponibles: 5, anioPublicacion: 2021 },
            { id: '4', titulo: 'Física I', autor: 'Ana Martínez', isbn: '978-5544332211', categoria: 'Física', cantidad: 12, disponibles: 9, anioPublicacion: 2018 },
            { id: '5', titulo: 'Base de Datos Avanzadas', autor: 'Roberto Silva', isbn: '978-6677889900', categoria: 'Informática', cantidad: 6, disponibles: 3, anioPublicacion: 2022 }
        ];

        let editingBookId = null;

        function renderBooks(booksToRender = books) {
            const tbody = document.getElementById('booksTable');
            const emptyState = document.getElementById('emptyState');
            
            if (booksToRender.length === 0) {
                tbody.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            tbody.innerHTML = booksToRender.map(book => `
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-gray-600">${book.id}</td>
                    <td class="py-3 px-6">
                        <p class="font-medium text-gray-900">${book.titulo}</p>
                    </td>
                    <td class="py-3 px-6 text-gray-700">${book.autor}</td>
                    <td class="py-3 px-6 text-gray-600">${book.isbn}</td>
                    <td class="py-3 px-6">
                        <span class="inline-block px-2 py-1 text-xs border border-gray-300 rounded text-gray-700">${book.categoria}</span>
                    </td>
                    <td class="py-3 px-6 text-center text-gray-700">${book.cantidad}</td>
                    <td class="py-3 px-6 text-center">
                        <span class="px-2 py-1 rounded text-sm font-medium ${book.disponibles > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">
                            ${book.disponibles}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-gray-600">${book.anioPublicacion}</td>
                    <td class="py-3 px-6">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="editBook('${book.id}')" class="p-2 text-gray-600 hover:bg-gray-100 rounded transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteBook('${book.id}')" class="p-2 text-red-600 hover:bg-red-50 rounded transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');

            updateStats();
        }

        function updateStats() {
            document.getElementById('totalBooks').textContent = books.length;
            
            const totalCopies = books.reduce((acc, book) => acc + book.cantidad, 0);
            document.getElementById('totalCopies').textContent = totalCopies;
            
            const totalAvailable = books.reduce((acc, book) => acc + book.disponibles, 0);
            const availability = totalCopies > 0 ? Math.round((totalAvailable / totalCopies) * 100) : 0;
            document.getElementById('availability').textContent = availability + '%';
        }

        function filterBooks() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filtered = books.filter(book => 
                book.titulo.toLowerCase().includes(searchTerm) ||
                book.autor.toLowerCase().includes(searchTerm) ||
                book.isbn.includes(searchTerm)
            );
            renderBooks(filtered);
        }

        function openModal(bookId = null) {
            const modal = document.getElementById('bookModal');
            const modalTitle = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('submitBtn');
            
            if (bookId) {
                const book = books.find(b => b.id === bookId);
                editingBookId = bookId;
                modalTitle.textContent = 'Editar Libro';
                submitBtn.textContent = 'Guardar Cambios';
                
                document.getElementById('titulo').value = book.titulo;
                document.getElementById('autor').value = book.autor;
                document.getElementById('isbn').value = book.isbn;
                document.getElementById('categoria').value = book.categoria;
                document.getElementById('cantidad').value = book.cantidad;
                document.getElementById('anio').value = book.anioPublicacion;
            } else {
                editingBookId = null;
                modalTitle.textContent = 'Agregar Nuevo Libro';
                submitBtn.textContent = 'Agregar Libro';
                document.getElementById('bookForm').reset();
                document.getElementById('anio').value = new Date().getFullYear();
            }
            
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('bookModal').classList.add('hidden');
            editingBookId = null;
        }

        function editBook(bookId) {
            openModal(bookId);
        }

        function deleteBook(bookId) {
            if (confirm('¿Está seguro de eliminar este libro?')) {
                books = books.filter(book => book.id !== bookId);
                renderBooks();
            }
        }

        function handleSubmit(e) {
            e.preventDefault();
            
            const formData = {
                titulo: document.getElementById('titulo').value,
                autor: document.getElementById('autor').value,
                isbn: document.getElementById('isbn').value,
                categoria: document.getElementById('categoria').value,
                cantidad: parseInt(document.getElementById('cantidad').value),
                anioPublicacion: parseInt(document.getElementById('anio').value)
            };

            if (editingBookId) {
                const bookIndex = books.findIndex(b => b.id === editingBookId);
                const oldBook = books[bookIndex];
                books[bookIndex] = {
                    ...oldBook,
                    ...formData,
                    disponibles: oldBook.disponibles + (formData.cantidad - oldBook.cantidad)
                };
            } else {
                const newBook = {
                    id: Date.now().toString(),
                    ...formData,
                    disponibles: formData.cantidad
                };
                books.push(newBook);
            }

            renderBooks();
            closeModal();
        }

        // Click outside modal to close
        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initial render
        renderBooks();
    </script>
</body>
</html>