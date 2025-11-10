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
            <p class="text-3xl font-bold text-gray-900 mb-1">51</p>
            <p class="text-xs text-gray-500">34 disponibles</p>
        </div>

        <!-- Préstamos Activos -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-600">Préstamos Activos</h3>
                <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-green-600 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1">3</p>
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
            <p class="text-3xl font-bold text-gray-900 mb-1">1</p>
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
            <p class="text-3xl font-bold text-gray-900 mb-1">4</p>
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
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Introducción a la Programación</p>
                            <p class="text-sm text-gray-600">Pedro Ramírez</p>
                            <p class="text-xs text-gray-500 mt-1">Préstamo: 31/10/2025</p>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                            activo
                        </span>
                    </div>

                    <!-- Préstamo 2 -->
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Estructuras de Datos</p>
                            <p class="text-sm text-gray-600">Lucía Torres</p>
                            <p class="text-xs text-gray-500 mt-1">Préstamo: 2/11/2025</p>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                            activo
                        </span>
                    </div>

                    <!-- Préstamo 3 -->
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Cálculo Diferencial</p>
                            <p class="text-sm text-gray-600">Miguel Ángel</p>
                            <p class="text-xs text-gray-500 mt-1">Préstamo: 19/10/2025</p>
                        </div>
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium">
                            retrasado
                        </span>
                    </div>

                    <!-- Préstamo 4 -->
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Base de Datos Avanzadas</p>
                            <p class="text-sm text-gray-600">Carmen Díaz</p>
                            <p class="text-xs text-gray-500 mt-1">Préstamo: 4/11/2025</p>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                            activo
                        </span>
                    </div>
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
                    <!-- Libro 1 -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                            1
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">Introducción a la Programación</p>
                            <p class="text-sm text-gray-600 truncate">Juan Pérez</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-gray-900">1</p>
                            <p class="text-xs text-gray-600">préstamos</p>
                        </div>
                    </div>

                    <!-- Libro 2 -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                            2
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">Cálculo Diferencial</p>
                            <p class="text-sm text-gray-600 truncate">María García</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-gray-900">1</p>
                            <p class="text-xs text-gray-600">préstamos</p>
                        </div>
                    </div>

                    <!-- Libro 3 -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                            3
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">Estructuras de Datos</p>
                            <p class="text-sm text-gray-600 truncate">Carlos López</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-gray-900">1</p>
                            <p class="text-xs text-gray-600">préstamos</p>
                        </div>
                    </div>

                    <!-- Libro 4 -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                            4
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">Física I</p>
                            <p class="text-sm text-gray-600 truncate">Ana Martínez</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-gray-900">0</p>
                            <p class="text-xs text-gray-600">préstamos</p>
                        </div>
                    </div>

                    <!-- Libro 5 -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold flex-shrink-0">
                            5
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">Base de Datos Avanzadas</p>
                            <p class="text-sm text-gray-600 truncate">Roberto Silva</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-semibold text-gray-900">1</p>
                            <p class="text-xs text-gray-600">préstamos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert -->
    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
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
    </div>
</x-app-layout>
