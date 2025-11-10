<x-app-layout>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">Panel de Control</h1>
        <p class="text-gray-600">Vista general del sistema</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total de Libros -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Total de Libros</h3>
                <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center">
                    <i class="fas fa-book text-blue-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $totalBooks }}</p>
            <p class="text-xs text-gray-500">{{ $availableBooks }} disponibles</p>
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
                <h3 class="text-sm font-medium text-gray-600">Usuarios Activos</h3>
                <div class="w-8 h-8 bg-purple-100 rounded flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-500">Registrados en el sistema</p>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Préstamos Recientes -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Préstamos Recientes</h3>
                <p class="text-sm text-gray-500 mt-1">Últimas transacciones registradas</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Préstamo 1 -->
                    @foreach ($loans->take(5) as $loan)
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $loan->book->title }}</p>
                                <p class="text-sm text-gray-600">{{ $loan->book->author }}</p>
                                <p class="text-xs text-gray-500 mt-1">Préstamo: {{ $loan->created_at }}</p>
                            </div>
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Libros Más Populares -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="font-semibold text-gray-900">Libros Más Populares</h3>
                <p class="text-sm text-gray-500 mt-1">Mayor cantidad de préstamos</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">

                    @foreach ($popularBooks as $book)
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                                {{ $loop->iteration }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate"> {{ $book->title }} </p>
                                <p class="text-sm text-gray-600 truncate">{{ $book->author }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-semibold text-gray-900">{{ $book->loans_count }}</p>
                                <p class="text-xs text-gray-600">préstamos</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Alert -->
    {{-- <div class="bg-red-50 border border-red-200 rounded-lg p-6">
        <div class="flex items-start gap-3">
            <div class="w-6 h-6 bg-red-100 rounded flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
            </div>
            <div>
                <h3 class="font-semibold text-red-900 mb-1">Atención Requerida</h3>
                <p class="text-sm text-red-800">
                    Hay 1 préstamo(s) con retraso en la devolución. Por favor, contacte a los usuarios para
                    gestionar las devoluciones.
                </p>
            </div>
        </div>
    </div> --}}
</x-app-layout>
