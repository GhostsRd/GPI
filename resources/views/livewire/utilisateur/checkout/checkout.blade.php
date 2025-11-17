<div>
    <!-- Section des statistiques avec icônes -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-primary">{{ $totalCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">
                                <i class="fas fa-shopping-cart me-2"></i>Total Checkouts
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-boxes fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-warning">{{ $enCoursCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">
                                <i class="fas fa-clock me-2"></i>En Cours
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                <i class="fas fa-spinner fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-success">{{ $validerCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">
                                <i class="fas fa-check-circle me-2"></i>Validés
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                <i class="fas fa-thumbs-up fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-danger">{{ $fermerCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">
                                <i class="fas fa-times-circle me-2"></i>Fermés
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                <i class="fas fa-archive fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre de recherche et filtres avec icônes -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">
                        <i class="fas fa-search me-1"></i>Recherche
                    </label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" wire:model.live="search"
                               class="form-control" placeholder="ID, Utilisateur, Type matériel...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">
                        <i class="fas fa-tag me-1"></i>Statut
                    </label>
                    <select wire:model.live="statut" class="form-select form-select-sm">
                        <option value="">Tous les statuts</option>
                        <option value="1">
                            <i class="fas fa-clock me-1"></i>En Cours
                        </option>
                        <option value="2">
                            <i class="fas fa-check me-1"></i>Validé
                        </option>
                        <option value="3">
                            <i class="fas fa-times me-1"></i>Fermé
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">
                        <i class="fas fa-laptop me-1"></i>Type de matériel
                    </label>
                    <select wire:model.live="type_materiel" class="form-select form-select-sm">
                        <option value="">Tous les types</option>
                        <option value="ordinateur">
                            <i class="fas fa-desktop me-1"></i>Ordinateur
                        </option>
                        <option value="Telephone">
                            <i class="fas fa-mobile-alt me-1"></i>Téléphone
                        </option>
                        <option value="Peripherique">
                            <i class="fas fa-keyboard me-1"></i>Périphérique
                        </option>
                        <option value="Touche">
                            <i class="fas fa-mobile me-1"></i>Téléphone Touche
                        </option>
                        <option value="Android">
                            <i class="fab fa-android me-1"></i>Téléphone Android
                        </option>
                        <option value="Tablette">
                            <i class="fas fa-tablet-alt me-1"></i>Tablette
                        </option>
                        <option value="Regulateur">
                            <i class="fas fa-bolt me-1"></i>Régulateur
                        </option>
                        <option value="Clavier">
                            <i class="fas fa-keyboard me-1"></i>Clavier
                        </option>
                        <option value="Souris">
                            <i class="fas fa-mouse me-1"></i>Souris
                        </option>
                        <option value="Webcam">
                            <i class="fas fa-camera me-1"></i>Webcam
                        </option>
                        <option value="Casque">
                            <i class="fas fa-headphones me-1"></i>Casque
                        </option>
                        <option value="Scanner">
                            <i class="fas fa-scanner me-1"></i>Scanner
                        </option>
                        <option value="Cable">
                            <i class="fas fa-cable-car me-1"></i>Câble
                        </option>
                        <option value="USB">
                            <i class="fas fa-usb me-1"></i>USB
                        </option>
                        <option value="Jabra">
                            <i class="fas fa-headset me-1"></i>Jabra
                        </option>
                        <option value="Powerbank">
                            <i class="fas fa-battery-full me-1"></i>Powerbank
                        </option>
                        <option value="Chargeur">
                            <i class="fas fa-charging-station me-1"></i>Chargeur
                        </option>
                        <option value="APN">
                            <i class="fas fa-camera-retro me-1"></i>APN
                        </option>
                        <option value="Appareil Photo">
                            <i class="fas fa-camera me-1"></i>Appareil Photo
                        </option>
                        <option value="Dominos">
                            <i class="fas fa-gamepad me-1"></i>Dominos
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">
                        <i class="fas fa-calendar me-1"></i>Période
                    </label>
                    <select wire:model.live="periode" class="form-select form-select-sm">
                        <option value="">Toute période</option>
                        <option value="today">
                            <i class="fas fa-sun me-1"></i>Aujourd'hui
                        </option>
                        <option value="week">
                            <i class="fas fa-calendar-week me-1"></i>Cette semaine
                        </option>
                        <option value="month">
                            <i class="fas fa-calendar-alt me-1"></i>Ce mois
                        </option>
                        <option value="year">
                            <i class="fas fa-calendar me-1"></i>Cette année
                        </option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" wire:click="resetFilters"
                            class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                        <i class="fas fa-undo me-1"></i>Reset
                    </button>
                </div>
                <div class="col-md-1">
                    <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les checkouts sélectionnés"
                        {{ empty($selectedCheckouts) ? 'disabled' : '' }}>
                        <i class="fas fa-trash me-1"></i>
                        ({{ count($selectedCheckouts) }})
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des checkouts avec icônes -->
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-list-alt me-2"></i>Liste des Checkouts
            </div>
        </div>

        <div class="table-wrapper p-0 border-0 w-100 compact-mode">
            @if($checkouts && $checkouts->count() > 0)
                <table class="table border-0 shadow-sm text-center">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th wire:click="sortBy('id')" class="sortable">
                            <i class="fas fa-hashtag me-1"></i>Référence
                            @if($sortField === 'id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('utilisateur_id')" class="sortable">
                            <i class="fas fa-user me-1"></i>Utilisateur
                            @if($sortField === 'utilisateur_id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('materiel_type')" class="sortable">
                            <i class="fas fa-laptop me-1"></i>Type de matériel
                            @if($sortField === 'materiel_type')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('materiel_details')" class="sortable">
                            <i class="fas fa-info-circle me-1"></i>Détails du matériel
                            @if($sortField === 'materiel_details')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('statut')" class="sortable">
                            <i class="fas fa-tag me-1"></i>Statut
                            @if($sortField === 'statut')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th>
                            <i class="fas fa-microchip me-1"></i>Matériel attribué
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            <i class="fas fa-sign-out-alt me-1"></i>Date de Sortie
                            @if($sortField === 'created_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('updated_at')" class="sortable">
                            <i class="fas fa-sign-in-alt me-1"></i>Date de Remise
                            @if($sortField === 'updated_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="fas fa-sort text-muted ms-1"></i>
                            @endif
                        </th>
                        <th>
                            <i class="fas fa-cogs me-1"></i>Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($checkouts as $checkout)
                        <tr style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedCheckouts"
                                       value="{{ $checkout->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <i class="fas fa-hashtag text-muted me-1"></i>#{{ $checkout->id }}
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})" class="text-muted">
                                <i class="fas fa-user-circle me-1"></i>{{ $checkout->utilisateur->nom ?? 'N/A' }}
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <span class="badge bg-light text-dark text-capitalize">
                                    @switch($checkout->materiel_type)
                                        @case('ordinateur')
                                            <i class="fas fa-desktop me-1"></i>
                                            @break
                                        @case('Telephone')
                                            <i class="fas fa-mobile-alt me-1"></i>
                                            @break
                                        @case('Peripherique')
                                            <i class="fas fa-keyboard me-1"></i>
                                            @break
                                        @case('Touche')
                                            <i class="fas fa-mobile me-1"></i>
                                            @break
                                        @case('Android')
                                            <i class="fab fa-android me-1"></i>
                                            @break
                                        @case('Tablette')
                                            <i class="fas fa-tablet-alt me-1"></i>
                                            @break
                                        @case('Clavier')
                                            <i class="fas fa-keyboard me-1"></i>
                                            @break
                                        @case('Souris')
                                            <i class="fas fa-mouse me-1"></i>
                                            @break
                                        @case('Webcam')
                                            <i class="fas fa-camera me-1"></i>
                                            @break
                                        @case('Casque')
                                            <i class="fas fa-headphones me-1"></i>
                                            @break
                                        @case('Scanner')
                                            <i class="fas fa-scanner me-1"></i>
                                            @break
                                        @case('Cable')
                                            <i class="fas fa-cable-car me-1"></i>
                                            @break
                                        @case('USB')
                                            <i class="fas fa-usb me-1"></i>
                                            @break
                                        @case('Chargeur')
                                            <i class="fas fa-charging-station me-1"></i>
                                            @break
                                        @case('APN')
                                            <i class="fas fa-camera-retro me-1"></i>
                                            @break
                                        @case('Appareil Photo')
                                            <i class="fas fa-camera me-1"></i>
                                            @break
                                        @default
                                            <i class="fas fa-cube me-1"></i>
                                    @endswitch
                                    {{ $checkout->materiel_type }}
                                </span>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>{{ Str::limit($checkout->materiel_details, 30) }}
                                </small>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                @if($checkout->statut == 1)
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>En Cours
                                    </span>
                                @elseif($checkout->statut == 2)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Validé
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Fermé
                                    </span>
                                @endif
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                @if($checkout->equipement_id)
                                    <span class="badge bg-info">
                                        <i class="fas fa-microchip me-1"></i>ID: {{ $checkout->equipement_id }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-times me-1"></i>Non attribué
                                    </span>
                                @endif
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small>
                                    <i class="far fa-calendar me-1"></i>{{ $checkout->created_at->format('d M Y H:i') }}
                                </small>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small>
                                    <i class="far fa-calendar-check me-1"></i>{{ $checkout->updated_at->format('d M Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-view" 
                                            onclick="window.location.href='{{ url('/admin/checkout-view-'.$checkout->id) }}'"
                                            title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="editCheckout({{ $checkout->id }})"
                                            class="btn-action btn-edit"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $checkout->id }})"
                                            class="btn-action btn-delete"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucun checkout trouvé</h5>
                    <p class="text-muted">Aucun checkout ne correspond à vos critères de recherche.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($checkouts && $checkouts->hasPages())
            <div class="mt-4 container d-flex justify-content-center">
                {{ $checkouts->links() }}
            </div>
        @endif
    </div>
</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</div>

<style>
    .stats-widget {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.stats-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.stats-number {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.2rem;
}

.stats-label {
    font-size: 0.85rem;
    opacity: 0.9;
}

.avatar-sm {
    width: 50px;
    height: 50px;
}

.dark-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 1px solid rgba(0,0,0,0.05);
}

.sortable {
    cursor: pointer;
    user-select: none;
}

.sortable:hover {
    background-color: rgba(0,0,0,0.02);
}

.checkbox-modern {
    transform: scale(1.1);
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.btn-action {
    border: none;
    background: transparent;
    padding: 6px 10px;
    border-radius: 4px;
    transition: all 0.2s ease;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-view {
    color: #6c757d;
    background-color: rgba(108, 117, 125, 0.1);
}

.btn-edit {
    color: #ffc107;
    background-color: rgba(255, 193, 7, 0.1);
}

.btn-delete {
    color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
}

.btn-action:hover {
    transform: scale(1.1);
    background-color: rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.table-title {
    font-size: 1.1rem;
    font-weight: 600;
}

/* Icônes dans les selects */
.form-select option {
    padding: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-number {
        font-size: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-action {
        width: 28px;
        height: 28px;
        padding: 4px 8px;
    }
}
    .modal-content {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .modal-backdrop.show {
        background-color: rgba(0, 0, 0, 0.2) !important;
        /* 0.2 = plus clair */
    }


    
    #wrap {
        width: 1100px;
        margin: 0 auto;
    }

    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    .external-event {
        /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    #calendar {
        /* 		float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #FFFFFF;
        border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
    }
</style>
<script>
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /*  className colors

        className: default(transparent), important(red), chill(pink), success(green), info(blue)

        */


        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',

            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd', // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d', // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },

            events: [


                @foreach ($events as $event)
                    {


                        title: "{{ $event->ordinateur->nom }}",
                        start: "{{ $event->date_debut }}",
                        end: "{{ $event->date_fin }}",
                        url: "{{ $event->url ?? '#' }}",
                        className: "success"


                    }
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach

            ],
        });


    });
</script>

<script>
    document.addEventListener('livewire:load', () => {
        Livewire.on('openModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('centeredModalreservation'));
            modal.show();
        });
    });

    document.addEventListener('livewire:load', () => {
        Livewire.on('openCalendrier', () => {
            const modal = new bootstrap.Modal(document.getElementById('calendarModal'));
            modal.show();
        });
    });
</script>
