<x-app-layout>
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Préstamos</h1>
            <p class="text-gray-600">Administre todos los préstamos</p>
        </div>
        <button x-data x-on:click="$dispatch('open-modal', 'create-new-loan')"
            class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
            <i class="fas fa-plus"></i>
            Agregar Préstamo
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total de Préstamos -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Total de Préstamos</h3>
                <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center">
                    <i class="fas fa-book text-blue-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $totalLoans }}</p>
            <p class="text-xs text-gray-500">préstamos totales</p>
        </div>

        <!-- Préstamos Activos -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Préstamos Activos</h3>
                <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-green-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $activeLoans }}</p>
            <p class="text-xs text-gray-500">En circulación</p>
        </div>

        <!-- Préstamos Retrasados -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Préstamos Retrasados</h3>
                <div class="w-8 h-8 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $lateLoans }}</p>
            <p class="text-xs text-gray-500">Requieren atención</p>
        </div>

        <!-- Usuarios Activos -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Procentaje de Devolución</h3>
                <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                    <i class="fa-solid fa-check text-green-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $returnRate }}%</p>
            <p class="text-xs text-gray-500">De devoluciones completadas</p>
        </div>
    </div>

    <!-- Loans Table -->
    <div class="bg-white rounded-lg shadow mb-6" x-data="{ selected: null }">
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
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Libro</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">ID del Estudiante</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Generado por</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Fecha de Salida</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Fecha de Vencimiento</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Fecha de Devolución</th>
                        <th class="text-left py-3 px-6 text-sm font-semibold text-gray-700">Estado</th>
                        <th class="text-right py-3 px-6 text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="booksTable">
                    @foreach ($loans as $loan)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-gray-600">{{ $loan->id }}</td>
                            <td class="py-3 px-6">
                                <p class="font-medium text-gray-900">{{ $loan->book->title }}</p>
                            </td>
                            <td class="py-3 px-6">
                                <p class="font-medium text-gray-900">{{ $loan->student_id }}</p>
                            </td>
                            <td class="py-3 px-6">
                                <p class="font-medium text-gray-900">{{ $loan->user->name }}</p>
                            </td>
                            <td class="py-3 px-6 text-gray-600">
                                {{ $loan->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-3 px-6 text-gray-600">
                                {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}
                            </td>
                            <td class="py-3 px-6 text-gray-600">
                                {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : '---' }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                @php
                                    $statusClasses;
                                    switch ($loan->loan_status) {
                                        case 'Pendiente':
                                            $statusClasses = 'bg-yellow-100 text-yellow-700';
                                            break;

                                        case 'Devuelto':
                                            $statusClasses = 'bg-green-100 text-green-700';
                                            break;

                                        case 'Atrasado':
                                            $statusClasses = 'bg-orange-100 text-orange-700';
                                            break;

                                        case 'Perdido':
                                            $statusClasses = 'bg-red-100 text-red-700';
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                @endphp
                                <span class="px-2 py-1 rounded text-sm font-medium {{ $statusClasses }}">
                                    {{ $loan->loan_status }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($loan->loan_status !== 'Devuelto')
                                        <form method="POST" action="{{ route('loans.return', $loan) }}"
                                            onsubmit="return confirm('¿Estás seguro de registrar la devolución de este libro?');">
                                            @csrf
                                            @method('PUT')

                                            <x-primary-button class="w-[210px]">
                                                <i class="fa-solid fa-check"></i>
                                                Registrar Devolución
                                            </x-primary-button>
                                        </form>
                                    @else
                                        <span class="w-[210px] inline-flex items-center gap-2 px-4 py-2 bg-white border-2 border-gray-900 text-center justify-center rounded-lg">Devuelto</span>
                                    @endif

                                    <button x-data
                                        x-on:click="$dispatch('open-modal', 'edit-loan'); selected = @js($loan)"
                                        class="p-2 text-gray-600 hover:bg-gray-100 rounded transition">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- <button x-data
                                        x-on:click="$dispatch('open-modal', 'edit-loan'); selected = @js($loan)"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded transition">
                                        <i class="fas fa-trash"></i>
                                    </button> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="emptyState" class="text-center py-12 text-gray-500" style="display: none;">
                No se encontraron préstamos
            </div>
        </div>

        <x-modal name="edit-loan">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-1">Editar Préstamo - <span
                        x-text="selected?.id"></span></h2>
                <p class="text-sm text-gray-600">Complete los detalles del libro. Todos los campos son obligatorios.</p>
            </div>

            <form method="POST" action="{{ route('loans.update') }}">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">

                        <input type="hidden" name="id" x-bind:value="selected?.id" />
                        <!-- Libro -->
                        <div>
                            <x-input-label for="book_id" value="Libro" />
                            <select id="book_id"
                                class="block mt-1 w-full border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm"
                                type="text" name="book_id" :value="old('book_id')" required autocomplete="book_id"
                                x-bind:value="selected?.book_id">
                                <option>Seleccione un libro</option>
                                @foreach ($availableBooks as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>
                        <!-- Estudiante -->
                        <div>
                            <x-input-label for="student_id" value="ID del Estudiante" />
                            <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id"
                                :value="old('student_id')" required autocomplete="student_id"
                                x-bind:value="selected?.student_id" />
                            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                        </div>
                        <!-- Fecha de Vencimiento -->
                        <div class="col-span-2">
                            <x-input-label for="due_date" value="Fecha de Vencimiento" />
                            <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date"
                                min="{{ now()->format('Y-m-d') }}" :value="old('due_date')" required autocomplete="due_date"
                                x-bind:value="selected?.due_date" />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>
                        <!-- Estado -->
                        <div>
                            <x-input-label for="loan_status" value="Estado" />
                            <select id="loan_status"
                                class="block mt-1 w-full border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm"
                                type="text" name="loan_status" :value="old('loan_status')" required
                                autocomplete="loan_status" x-bind:value="selected?.loan_status">
                                <option>Seleccione un estado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Devuelto">Devuelto</option>
                                <option value="Atrasado">Atrasado</option>
                                <option value="Perdido">Perdido</option>
                            </select>
                            <x-input-error :messages="$errors->get('loan_status')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button>
                        Actualizar Préstamo
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-modal name="create-new-loan">
        <div class="p-6 border-b border-gray-200">
            <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-1">Agregar Nuevo Préstamo</h2>
            <p class="text-sm text-gray-600">Complete los detalles del préstamo. Todos los campos son obligatorios.</p>
        </div>

        <form method="POST" action="{{ route('loans.store') }}">
            @csrf
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Libro -->
                    <div>
                        <x-input-label for="book_id" value="Libro" />
                        <select id="book_id"
                            class="block mt-1 w-full border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm"
                            type="text" name="book_id" :value="old('book_id')" required autocomplete="book_id">
                            <option>Seleccione un libro</option>
                            @foreach ($availableBooks as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                    </div>
                    <!-- Estudiante -->
                    <div>
                        <x-input-label for="student_id" value="ID del Estudiante" />
                        <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id"
                            :value="old('student_id')" required autocomplete="student_id" />
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>
                    <!-- Fecha de Vencimiento -->
                    <div class="col-span-2">
                        <x-input-label for="due_date" value="Fecha de Vencimiento" />
                        <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date"
                            min="{{ now()->format('Y-m-d') }}" :value="old('due_date')" required autocomplete="due_date" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>
                    <!-- Estado -->
                    {{-- <div>
                        <x-input-label for="loan_status" value="Estado" />
                        <select id="loan_status" class="block mt-1 w-full border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-transparent rounded-md shadow-sm" type="text" name="loan_status"
                            :value="old('loan_status')" required autocomplete="loan_status">
                            <option>Seleccione un estado</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Devuelto">Devuelto</option>
                            <option value="Atrasado">Atrasado</option>
                            <option value="Perdido">Perdido</option>
                        </select>
                        <x-input-error :messages="$errors->get('loan_status')" class="mt-2" />
                    </div> --}}
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button>
                    Agregar Préstamo
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
