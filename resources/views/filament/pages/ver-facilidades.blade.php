<x-filament::page>
    <div class="p-6 space-y-4">
        <h2 class="text-xl font-bold">Facilidades para el objeto: {{ request()->query('obj_id') }}</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Año</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Cuota</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Tributo</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Nominal</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Accesorios</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Multa</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Total</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Quita</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Fecha Vencimiento</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($facilidades as $facilidad)
                        <tr class="text-gray-600 font-semibold">
                            <td class="px-6 py-4">{{ $facilidad->anio }}</td>
                            <td class="px-6 py-4">{{ $facilidad->cuota }}</td>
                            <td class="px-6 py-4">{{ $facilidad->trib_nom }}</td>
                            <td class="px-6 py-4">{{ $facilidad->nominal }}</td>
                            <td class="px-6 py-4">{{ $facilidad->accesor }}</td>
                            <td class="px-6 py-4">{{ $facilidad->multa }}</td>
                            <td class="px-6 py-4">${{ $facilidad->total }}</td>
                            <td class="px-6 py-4">{{ $facilidad->quita }}</td>
                            <td class="px-6 py-4">{{ $facilidad->fchvenc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
