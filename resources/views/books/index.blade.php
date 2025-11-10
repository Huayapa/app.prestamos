<x-app-layout>
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestión de Libros</h1>
            <p class="text-gray-600">Administre el catálogo de la biblioteca</p>
        </div>
        <button x-data x-on:click="$dispatch('open-modal', 'create-new-book')"
            class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
            <i class="fas fa-plus"></i>
            Agregar Libro
        </button>
    </div>

    <!-- Books Card -->
    <div class="bg-white rounded-lg shadow mb-6" x-data="{selected: null}">
        <div class="p-6">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Buscar por título, autor o ISBN..."
                    oninput="filterBooks()"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-y border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">ID</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Título</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Autor</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">ISBN</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Resumen</th>
                        <th class="text-center py-3 px-6 text-sm font-semibold text-gray-700">Disponibles</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Año</th>
                        <th class="text-right py-3 px-6 text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="booksTable">
                    @foreach ($books as $book)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-gray-600">{{ $book->id }}</td>
                            <td class="py-3 px-6">
                                <p class="font-medium text-gray-900">{{ $book->title }}</p>
                            </td>
                            <td class="py-3 px-6 text-gray-700">{{ $book->author }}</td>
                            <td class="py-3 px-6 text-gray-600">{{ $book->isbn }}</td>
                            <td class="py-3 px-6 text-gray-600">{{ $book->summary }}</td>
                            <td class="py-3 px-6 text-center">
                                @php
                                    $stockClasses;
                                    if ($book->stock > 0) {
                                        $stockClasses = 'bg-green-100 text-green-700';
                                    } else {
                                        $stockClasses = 'bg-red-100 text-red-700';
                                    }
                                @endphp
                                <span
                                    class="px-2 py-1 rounded text-sm font-medium {{ $stockClasses }}">
                                    {{ $book->stock }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-gray-600">{{ $book->publication_year }}</td>
                            <td class="py-3 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    <button x-data
                                        x-on:click="$dispatch('open-modal', 'edit-book'); selected = @js($book)"
                                        class="p-2 text-gray-600 hover:bg-gray-100 rounded transition">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button x-data
                                        x-on:click="$dispatch('open-modal', 'edit-book'); selected = @js($book)"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="emptyState" class="text-center py-12 text-gray-500" style="display: none;">
                No se encontraron libros
            </div>
        </div>

        <x-modal name="edit-book">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-1">Editar Libro - <span x-text="selected?.title"></span></h2>
                <p class="text-sm text-gray-600">Complete los detalles del libro. Todos los campos son obligatorios.</p>
            </div>

            <form method="POST" action="{{ route('books.store') }}">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">

                        <input type="hidden" name="id" x-bind:value="selected?.id"/>
                        <!-- Título -->
                        <div>
                            <x-input-label for="title" value="Titulo" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required x-bind:value="selected?.title" autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <!-- Autor -->
                        <div>
                            <x-input-label for="author" value="Autor" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                :value="old('author')" required x-bind:value="selected?.author" autocomplete="author" />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>
                        <!-- ISBN -->
                        <div class="col-span-2">
                            <x-input-label for="isbn" value="ISBN" />
                            <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn"
                                :value="old('isbn')" required x-bind:value="selected?.isbn" autocomplete="isbn" />
                            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                        </div>
                        <!-- Resumen -->
                        <div class="col-span-2">
                            <x-input-label for="summary" value="Resumen" />
                            <textarea id="summary"
                                class="border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm block mt-1 w-full"
                                type="text" name="summary" required x-text="selected?.summary"></textarea>
                            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                        </div>
                        <!-- Stock -->
                        <div>
                            <x-input-label for="stock" value="Stock" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="text" name="stock"
                                :value="old('stock')" required x-bind:value="selected?.stock" autocomplete="stock" />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                        <!-- Año -->
                        <div>
                            <x-input-label for="publication_year" value="Año de Publicación" />
                            <x-text-input id="publication_year" class="block mt-1 w-full" type="number"
                                name="publication_year" :value="old('publication_year')" required x-bind:value="selected?.publication_year" autocomplete="publication_year" />
                            <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Actualizar Libro
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Total de Libros</h3>
            <p class="text-3xl font-bold text-gray-900 mb-1" id="totalBooks"> {{ $books->count() }}</p>
            <p class="text-xs text-gray-500">títulos únicos</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Ejemplares Totales</h3>
            <p class="text-3xl font-bold text-gray-900 mb-1" id="totalCopies">{{ $books->sum('stock') }}</p>
            <p class="text-xs text-gray-500">en el catálogo</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Disponibilidad</h3>
            <p class="text-3xl font-bold text-gray-900 mb-1" id="availability">{{ $porcentajeDisponibilidad }}%</p>
            <p class="text-xs text-gray-500">libros disponibles</p>
        </div>
    </div>

    <x-modal name="create-new-book">
        <div class="p-6 border-b border-gray-200">
            <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-1">Agregar Nuevo Libro</h2>
            <p class="text-sm text-gray-600">Complete los detalles del libro. Todos los campos son obligatorios.</p>
        </div>

        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Título -->
                    <div>
                        <x-input-label for="title" value="Titulo" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <!-- Autor -->
                    <div>
                        <x-input-label for="author" value="Autor" />
                        <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                            :value="old('author')" required autocomplete="author" />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>
                    <!-- ISBN -->
                    <div class="col-span-2">
                        <x-input-label for="isbn" value="ISBN" />
                        <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn"
                            :value="old('isbn')" required autocomplete="isbn" />
                        <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                    </div>
                    <!-- Resumen -->
                    <div class="col-span-2">
                        <x-input-label for="summary" value="Resumen" />
                        <textarea id="summary"
                            class="border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm block mt-1 w-full"
                            type="text" name="summary" required></textarea>
                        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                    </div>
                    <!-- Stock -->
                    <div>
                        <x-input-label for="stock" value="Stock" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="text" name="stock"
                            :value="old('stock')" required autocomplete="stock" />
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>
                    <!-- Año -->
                    <div>
                        <x-input-label for="publication_year" value="Año de Publicación" />
                        <x-text-input id="publication_year" class="block mt-1 w-full" type="number"
                            name="publication_year" :value="old('publication_year')" required autocomplete="publication_year" />
                        <x-input-error :messages="$errors->get('publication_year')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Agregar Libro
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
