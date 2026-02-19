
<div>
    <div class="p-6 bg-gray-50 min-h-screen">
        
        <!-- Section Statistiques (Top Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Tickets -->
            <div class="bg-white rounded-2xl shadow-lg p-5 hover:scale-[1.02] transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Tickets</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalTickets }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-green-500 font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +2.5%
                    </span>
                    <span class="text-gray-400 ml-2">depuis le mois dernier</span>
                </div>
            </div>

            <!-- Total Incidents -->
            <div class="bg-white rounded-2xl shadow-lg p-5 hover:scale-[1.02] transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Incidents</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalIncidents }}</h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-red-500 font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                        +5%
                    </span>
                    <span class="text-gray-400 ml-2">cette semaine</span>
                </div>
            </div>

            <!-- Total Équipements -->
            <div class="bg-white rounded-2xl shadow-lg p-5 hover:scale-[1.02] transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Équipements</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalEquipments }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                 <div class="flex items-center text-sm">
                    <span class="text-gray-500 font-medium">Actifs</span>
                </div>
            </div>

            <!-- Total Utilisateurs -->
            <div class="bg-white rounded-2xl shadow-lg p-5 hover:scale-[1.02] transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Utilisateurs</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-gray-500 font-medium">Enregistrés</span>
                </div>
            </div>
        </div>

        <!-- Section Graphiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            
            <!-- Colonne 1: Tickets -->
            <div class="space-y-6">
                <!-- Doughnut Tickets Status -->
                <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Tickets par Statut</h4>
                    <div class="relative h-64">
                         <canvas id="ticketsChart-{{ $this->id }}"></canvas>
                    </div>
                </div>
                
                <!-- Line Monthly Tickets -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Tickets Mensuels</h4>
                    <div class="relative h-64">
                         <canvas id="monthlyTicketsChart-{{ $this->id }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Colonne 2: Équipements -->
            <div class="space-y-6">
                <!-- Bar Equipment Type -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Équipements par Type</h4>
                    <div class="relative h-64">
                         <canvas id="equipmentsChart-{{ $this->id }}"></canvas>
                    </div>
                </div>

                <!-- PolarArea Equipment Status -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Statut Équipements</h4>
                    <div class="relative h-64">
                         <canvas id="equipmentStatusChart-{{ $this->id }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Colonne 3: Incidents Stats -->
            <div class="space-y-6">
                <!-- Doughnut Incidents Status -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Statut Incidents</h4>
                    <div class="relative h-64">
                         <canvas id="incidentsStatusChart-{{ $this->id }}"></canvas>
                    </div>
                </div>

                <!-- Line Incident Trend -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Tendance Incidents</h4>
                    <div class="relative h-64">
                         <canvas id="incidentTrendChart-{{ $this->id }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Colonne 4: Incidents Details -->
             <div class="space-y-6">
                <!-- Bar Incidents Priority -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Incidents par Priorité</h4>
                    <div class="relative h-64">
                         <canvas id="incidentPriorityChart-{{ $this->id }}"></canvas>
                    </div>
                </div>

                <!-- PolarArea Incidents Type -->
                 <div class="bg-white rounded-2xl shadow-lg p-5" wire:ignore>
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Incidents par Type</h4>
                    <div class="relative h-64">
                         <canvas id="incidentTypeChart-{{ $this->id }}"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Équipements Récents -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Équipements Récents
            </h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-gray-500 font-semibold text-sm border-b">Équipement</th>
                            <th class="px-4 py-3 text-gray-500 font-semibold text-sm border-b">Type</th>
                            <th class="px-4 py-3 text-gray-500 font-semibold text-sm border-b">Statut</th>
                            <th class="px-4 py-3 text-gray-500 font-semibold text-sm border-b">Date d'ajout</th>
                            <th class="px-4 py-3 text-gray-500 font-semibold text-sm border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentEquipments as $equipment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 mr-3 overflow-hidden flex-shrink-0">
                                    @if($equipment->image)
                                        <img src="{{ Storage::url($equipment->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $equipment->identification ?? $equipment->model ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $equipment->marque ?? '' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $equipment->type }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $equipment->statut == 'en_service' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $equipment->statut == 'en_panne' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $equipment->statut == 'en_stock' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $equipment->statut)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-sm">{{ $equipment->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <button class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Voir détails</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">Aucun équipement récent.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            

            let chartInstances = {};

            const initCharts = () => {
                const chartConfigs = [
                    // 1. Tickets Status
                    { id: 'ticketsChart-{{ $this->id }}', type: 'doughnut', data: @json($ticketStatusData), label: 'Tickets' },
                    // 2. Monthly Tickets
                    { id: 'monthlyTicketsChart-{{ $this->id }}', type: 'line', data: @json($monthlyTicketsData), label: 'Tickets', fill: true },
                    // 3. Equipment Type
                    { id: 'equipmentsChart-{{ $this->id }}', type: 'bar', data: @json($equipmentChartData), label: 'Équipements' },
                    // 4. Equipment Status
                    { id: 'equipmentStatusChart-{{ $this->id }}', type: 'polarArea', data: @json($equipmentStatusData), label: 'Statut' },
                    // 5. Incidents Status
                    { id: 'incidentsStatusChart-{{ $this->id }}', type: 'doughnut', data: @json($incidentsChartData), label: 'Incidents' },
                    // 6. Incident Trend
                    { 
                        id: 'incidentTrendChart-{{ $this->id }}', 
                        type: 'line', 
                        labels: @json($incidentTrendData['labels'] ?? []),
                        data: @json($incidentTrendData['data'] ?? []), 
                        label: 'Tendance', 
                        fill: true 
                    },
                    // 7. Incident Priority
                    { id: 'incidentPriorityChart-{{ $this->id }}', type: 'bar', data: @json($incidentsByPriority), label: 'Priorité' },
                    // 8. Incident Type
                    { id: 'incidentTypeChart-{{ $this->id }}', type: 'polarArea', data: @json($incidentsByType), label: 'Type' },
                ];

                chartConfigs.forEach(config => {
                    const ctx = document.getElementById(config.id);
                    if (!ctx) return;

                    // Destroy old instance if exists
                    if (chartInstances[config.id]) {
                        chartInstances[config.id].destroy();
                    }

                    // Prepare Data
                    let labels = config.labels || Object.keys(config.data || {});
                    let values = Array.isArray(config.data) ? config.data : Object.values(config.data || {});

                    // Colors
                    const colors = labels.map((_, i) => `hsl(${(i * 360) / labels.length}, 70%, 60%)`);

                    chartInstances[config.id] = new Chart(ctx, {
                        type: config.type,
                        data: {
                            labels: labels,
                            datasets: [{
                                label: config.label,
                                data: values,
                                backgroundColor: config.type === 'line' ? 'rgba(99, 102, 241, 0.2)' : colors,
                                borderColor: config.type === 'line' ? 'rgb(99, 102, 241)' : colors.map(c => c.replace('60%', '50%')),
                                borderWidth: 1,
                                fill: config.fill || false,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { usePointStyle: true, padding: 20 }
                                }
                            },
                            scales: config.type === 'bar' || config.type === 'line' ? {
                                y: { beginAtZero: true, grid: { borderDash: [2, 2] } },
                                x: { grid: { display: false } }
                            } : {}
                        }
                    });
                });
            };

            initCharts();

            Livewire.on('refreshCharts', () => {
                // To truly refresh with NEW data, one would typically emit the data event.
                // Or simply re-run initCharts() if the component DOM updated (but wire:ignore prevents that).
                // If wire:ignore is ON, the script @json directives are NOT updated.
                // Strict solution: Pass data via event. 
                // Flexible solution: Since we are just initializing, we re-run.
                // NOTE: Without passed data, this re-uses initial @json data unless the script tag was re-evaluated.
                // Assuming full Livewire re-render might happen or just re-init for resize/layout shifts.
                initCharts(); 
            });
        });
    </script>
    @endpush
</div>
