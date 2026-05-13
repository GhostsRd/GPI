<div class="container-fluid row " style="margin-top: 5% ;scrollbar-width: none; -ms-overflow-style: none;"
    style="height:40vh;">
     <div wire:loading.flex
        class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center"
        style="z-index: 10;">
        <div class="spinner-border text-secondary" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
    </div>
    <div class="col-lg-2 d-none d-lg-block d-xl-block py-1 px-0 ">
        @livewire('component.menu-utilisateur')
    </div>

    <div class="col-lg-7 row offset-1 bg-white mt-2 shadow-sm rounded-2"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <div wire:ignore.self class="p-2 col-lg-12 ">
            <h5 class="mt-2 pb-4 border-bottom fw-bold">Disponibilite de ce materiel</h5>
            <div class="row">
                <div class="col-lg-8 col-8">
                    <label class="text-muted mt-1 mt-md-0 mt-lg-0 d-flex justify-content-between">
                        Materiel /

                        @if($type_materiel == 'peripherique' )
                        {{ $firsts?->type ?? 'Aucun equipement trouver' }}
                        {{ $firsts?->nom ?? 'Aucun equipement trouver' }}

                        @else

                        {{ $firsts?->nom ?? 'Aucun matériel trouvé' }} /
                        {{ $firsts?->os_version }} {{ $firsts?->marque }} </label>
                    @endif

                </div>
                <div class="col-lg-4 col-4">

                    <div class="d-flex  justify-content-end">
                        <div class="btn border-0  py-0 fw-bold rounded-3 text-white  btn-two p-0 mx-2 btn-sm"
                            wire:click="openReservationModal('{{ $type_materiel }}',{{ $reserverId }})"
                            data-bs-toggle="modal" data-bs-target="#centeredModalreservation">
                            Reserver
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id='calendar' wire:ignore
                style="width: 100% !important ;max-height:500px;overflow-y:scroll; scrollbar-width: none; -ms-overflow-style: none;">
            </div>

        </div>
        <div class="col-lg-3   mt-4">
            <div class="mt-4 border-top pt-3">
                <h6 class="small fw-bold text-uppercase text-muted mb-3" style="letter-spacing: 0.5px;">
                    Dernière réservation
                </h6>

                @if ($lastEvent)
                <div class="d-flex align-items-start p-2 rounded-3 border bg-white shadow-xs">
                    <div class="me-2 text-primary bg-primary-subtle rounded p-2 d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;">
                        @switch($lastEvent->equipement_type)
                        @case('ordinateur') <i class="fas fa-laptop fa-xs"></i> @break
                        @case('telephone') <i class="fas fa-mobile-alt fa-xs"></i> @break
                        @default <i class="fas fa-plug fa-xs"></i>
                        @endswitch
                    </div>

                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark small text-truncate">
                                {{ $lastEvent->equipement_type == 'peripherique' ? ($lastEvent->peripherique->type ??
                                'Périph.') : ucfirst($lastEvent->equipement_type) }}
                            </span>
                        </div>

                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ \Carbon\Carbon::parse($lastEvent->date_debut)->translatedFormat('d/m') }}
                            <i class="fas fa-long-arrow-alt-right mx-1 opacity-50"></i>
                            {{ \Carbon\Carbon::parse($lastEvent->date_fin)->translatedFormat('d/m/y') }}
                        </div>

                        <div class="d-flex align-items-center mt-1 pt-1 border-top border-light">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($lastEvent->responsable->nom) }}&background=5BC4BF&color=fff"
                                width="16" height="16" class="rounded-circle me-1">
                            <span class="text-muted" style="font-size: 0.7rem;">{{ $lastEvent->responsable->nom
                                }}</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-2 bg-light rounded small text-muted">
                    Aucun historique
                </div>
                @endif
            </div>


            <div class="mt-4 border-top pt-3">
                <label class="text-uppercase text-muted small fw-bold mb-3 d-block" style="letter-spacing: 1px;">
                    <i class="fas fa-calendar-check me-2 text-primary"></i>Prochains rendez-vous
                </label>

                <div class="list-group list-group-flush shadow-sm rounded-3 overflow-hidden">
                    @forelse ($prochaines as $prochaine)
                    <div class="list-group-item list-group-item-action border-start border-primary border-4 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold text-dark mb-1">
                                    {{ \Carbon\Carbon::parse($prochaine->date_debut)->translatedFormat('d F Y') }}
                                </div>

                                <div class="text-muted small d-flex align-items-center">
                                    @switch($prochaine->equipement_type)
                                    @case('ordinateur')
                                    <i class="fas fa-laptop me-2"></i>
                                    <span>Ordinateur : <strong>{{ $prochaine->ordinateur->nom ?? 'Inconnu'
                                            }}</strong></span>
                                    @break
                                    @case('telephone')
                                    <i class="fas fa-mobile-alt me-2"></i>
                                    <span>Téléphone : <strong>{{ $prochaine->TelephoneTablette->nom ?? 'Inconnu'
                                            }}</strong></span>
                                    @break
                                    @case('peripherique')
                                    <i class="fas fa-plug me-2"></i>
                                    <span>{{ $prochaine->peripherique->type ?? 'Périphérique' }} - <strong>{{
                                            $prochaine->peripherique->nom ?? '' }}</strong></span>
                                    @break
                                    @default
                                    <i class="fas fa-box me-2"></i>
                                    <span>{{ $prochaine->equipement_type }}</span>
                                    @endswitch
                                </div>
                            </div>

                            @php
                            $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($prochaine->date_debut),
                            false);
                            @endphp
                            <span
                                class="badge {{ $days <= 2 ? 'bg-warning' : 'bg-light text-dark' }} rounded-pill border">
                                {{ $days == 0 ? "Aujourd'hui" : ($days < 0 ? 'Passé' : "Dans $days j." ) }} </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 bg-light rounded-3 border-dashed">
                        <i class="fas fa-calendar-times text-muted mb-2 fa-2x"></i>
                        <p class="text-muted mb-0">Aucun rendez-vous planifié.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
        <div class="border-top mt-2 col-lg-12">
            <h5 class="py-4">Historique de vos reservation</h5>

            <div class="list-group mt-2  bg-white "
                style="max-height:400px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                @foreach ($historiques as $event)
                <a href="#"
                    class="list-group-item list-group-item-action border-0 border-bottom py-3 px-3 transition-all hover-shadow"
                    wire:click="visualiser({{ $event->id }})" data-bs-toggle="modal" data-bs-target="#lightModalview"
                    style="border-left: 4px solid {{ $event->statut == 1 ? '#ffc107' : ($event->statut == 2 ? '#198754' : '#6c757d') }};">

                    <div class="d-flex w-100 justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark text-capitalize">
                                {{ $event->equipement_type }}
                                <span class="badge bg-light text-secondary border fw-normal ms-1">{{
                                    $event->equipement_nombre }}</span>
                            </h6>

                            <p class="mb-2 text-muted small">
                                <i class="far fa-hdd me-1"></i>
                                @if($event->equipement_type == 'ordinateur')
                                {{ $event->ordinateur->os_version ?? 'OS non spécifié' }}
                                @elseif($event->equipement_type == 'telephone')
                                {{ $event->TelephoneTablette->nom ?? '' }} {{ $event->TelephoneTablette->marque ?? '' }}
                                @elseif($event->equipement_type == 'peripherique')
                                {{ $event->peripherique->type ?? '' }} {{ $event->peripherique->nom ?? '' }}
                                @else
                                Aucun détail
                                @endif
                            </p>
                        </div>

                        <div class="text-end">
                            <small class="text-body-secondary d-block mb-1">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($event->date_debut)->translatedFormat('d M') }} -
                                {{ \Carbon\Carbon::parse($event->date_fin)->translatedFormat('d M Y') }}
                            </small>

                            @php
                            $statusClasses = [
                            1 => 'bg-warning-subtle text-warning-emphasis border-warning',
                            2 => 'bg-success-subtle text-success-emphasis border-success',
                            3 => 'bg-secondary-subtle text-secondary-emphasis border-secondary'
                            ];
                            $statusLabels = [1 => 'En cours', 2 => 'Validé', 3 => 'Fermé'];
                            @endphp
                            <span
                                class="badge border {{ $statusClasses[$event->statut] ?? $statusClasses[3] }} rounded-pill px-2">
                                {{ $statusLabels[$event->statut] ?? 'Inconnu' }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex w-100 justify-content-between align-items-center mt-2">
                        <div class="d-flex align-items-center text-muted small">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($event->responsable->nom) }}&background=5BC4BF&color=fff"
                                alt="Profil" width="24" height="24" class="rounded-circle me-2 shadow-sm">
                            <span>{{ $event->responsable->nom }}</span>
                        </div>

                        <i class="fas fa-chevron-right text-light" style="font-size: 0.8rem;"></i>
                    </div>
                </a>

                <style>
                    .hover-shadow:hover {
                        background-color: #f8f9fa !important;
                        transform: translateX(5px);
                        transition: all 0.2s ease-in-out;
                    }

                    .transition-all {
                        transition: all 0.2s ease-in-out;
                    }
                </style>
                @endforeach
                <div class="mt-4 text-small d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>

    {{-- modal pour le details et modification --}}
    <div class="modal modal fade" wire:ignore.self id="centeredModalreservation" tabindex="-1"
        aria-labelledby="centeredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content  border-0">
                <!-- réduit l’ombre -->

                <h5 class="mx-2 mt-2 text-teal fw-bold">Réservation d'équipement</h5>

                <div class="mt-1 p-2 border-top">
                    @if ($type_materiel == 'ordinateur' && $selectedEquipements)
                    <label class="fw-bold mx-2">
                        @foreach ($selectedEquipements as $materiel)
                        {{ $materiel->nom }} {{ $materiel->os }}
                        @endforeach
                        / État /
                    </label>
                    @endif
                    @if ($type_materiel == 'telephone' && $selectedEquipements)
                    <label class="fw-bold mx-2">
                        @foreach ($selectedEquipements as $materiel)
                        {{ $materiel->nom }} {{ $materiel->os }}
                        @endforeach
                        / État /
                    </label>
                    @endif
                    @if ($type_materiel == 'peripherique' && $selectedEquipements)
                    <label class="fw-bold mx-2">
                        @foreach ($selectedEquipements as $materiel)
                        {{ $materiel->type }} {{ $materiel->nom }}
                        @endforeach
                        / État /
                    </label>
                    @endif


                    <br>
                    <p class="mt-1 p-1 text-muted fw-6">Les champs indiquer <span class="text-danger">*</span> sont
                        obligatoires</p>


                    <label class="form-label mt-2 mx-1">Date de début <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" wire:model="datedeb">

                    <label class="form-label mt-2 mx-1">Date de retour <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" wire:model="datefin">

                    <label class="form-label mt-2 mx-1">Nombre <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" wire:model="nbequipement" placeholder="Ex: 1">

                    <div class="border-top border-2 mt-4">

                    </div>
                    <label class="form-label mt-2 mx-1">Commentaire ( <span class="text-muted">Optionnel</span>
                        )</label> <br>
                    <textarea type="text" placeholder="Commencer à écrire"
                        class="input-recherche px-2 w-100 border rounded py-2" wire:model="commentaire"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-secondary  border "
                        data-bs-dismiss="modal">Quitter</button>
                    <button type="submit" wire:click="SAVEreserverEquipement"
                        class="btn btn-sm btn-two fw-bold text-white">Valider</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="lightModalview" tabindex="-1" aria-labelledby="lightModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            @foreach ($selectedMateriels as $item)
            <div class="modal-content">
                <div class="modal-header border-0  pb-0">
                    <label class="modal-title fw-bold  " id="lightModalLabel">

                        {{ $item->equipement_type == 'ordinateur' ? $item->ordinateur->nom :
                        $item->TelephoneTablette->nom }}
                        <small class="text-muted" style="font-size:0.8rem">cree le
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y H:m') }} </small>

                    </label>

                    <button type="submt" data-bs-toggle="modal" data-bs-target="#lightModal" @if ( ($item->date_debut >
                        now() || $item->created_at->isToday()) &&
                        $item->responsable->id == $userConnected &&
                        $item->statut == 1) wire:click="ModifierView({{ $item->id }})"
                        @else
                        class="d-none" @endif
                        wire:click="ModifierView({{ $item->id }})" class="btn btn-white">
                        <i class="bi bi-pencil"></i>
                    </button>

                </div>
                <div class="modal-body">
                    <label class="form-label mt-2 mx-1">Date de début</label>
                    <input class="form-control border-0 rounded-0 border-bottom" disabled
                        value="{{ \Carbon\Carbon::parse($item->date_debut)->translatedFormat('d M Y') }}">

                    <label class="form-label mt-2 mx-1">Date de retour</label>
                    <input class="form-control border-0 rounded-0 border-bottom" disabled
                        value="{{ \Carbon\Carbon::parse($item->date_fin)->translatedFormat('d M Y') }}">

                    <label class="form-label mt-2 mx-1">Nombre</label>
                    <input type="number" class="form-control border-0 rounded-0 border-bottom " disabled
                        value="{{ $item->equipement_nombre }}" placeholder="Ex: 1">

                    <label class="form-label mt-2 mx-1">Commentaire</label>
                    <textarea placeholder="{{ $item->commentaire != null ? $item->commentaire : 'Aucun commentaire' }}"
                        disabled rows="4" class="form-control" wire:model="commentaire">
                    </textarea>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-two text-white fw-bold" data-bs-dismiss="modal">Fermer</button>


                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" style="z-index: 2600" wire:ignore.self id="lightModal" tabindex="-1"
        aria-labelledby="lightModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                @foreach ($selectedMateriels as $item)
                <div class="modal-header border-0 pb-0 ">
                    <label class="modal-title fw-bold" id="lightModalLabel">

                        {{ $item->equipement_type == 'ordinateur' ? $item->ordinateur->nom :
                        $item->TelephoneTablette->nom }}

                    </label>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label mt-2 mx-1">Date de début</label>
                    <input type="date" style="z-index: 2600" class="form-control border-0 rounded-0 border-bottom"
                        wire:model="datedeb" value="{{ $datedeb }}">

                    <label class="form-label mt-2 mx-1">Date de retour</label>
                    <input type="date" style="z-index: 2600" class="form-control border-0 rounded-0 border-bottom"
                        required wire:model="datefin">

                    <label class="form-label mt-2 mx-1">Nombre</label>
                    <input type="number" style="z-index: 2600" class="form-control border-0 rounded-0 border-bottom"
                        required wire:model="nbequipement" placeholder="Ex: 1">

                    <label class="form-label mt-2 mx-1">Commentaire</label>
                    <textarea placeholder="Votre commentaire" style="z-index: 2600" rows="4" class="form-control"
                        wire:model="commentaire">
                    </textarea>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" wire:click="ModifierReservation"
                        class="btn btn-two text-white fw-bold btn-sm">Enregistrer

                    </button>
                    <button type="submit" wire:click="AnnulerReservation({{ $item->id }})" data-bs-dismiss="modal"
                        class="btn btn-danger text-white fw-bold btn-sm">Annuler
                        reservation
                        <div wire:loading wire:target="AnnulerReservation">...</div>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Erreur de réservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                @error('reservation_error')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary position-relative" wire:click="clearErrorsFn" data-bs-dismiss="modal">

                    <span wire:loading.remove wire:target="clearErrorsFn">
                        Fermer
                    </span>

                    <span wire:loading wire:target="clearErrorsFn">
                        <div class="spinner-border spinner-border-sm"></div>
                    </span>

                </button>

            </div>

        </div>
    </div>
</div>

</div>

<style>
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
            selectable: false,
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
            selectHelper: false,
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




            events: [


                @foreach ($events as $event)
                    @if ($event->equipement_type == 'ordinateur')

                        {

                            id: "{{ $event->id }}",
                            title: "{{ $event->ordinateur->nom }}",
                            start: "{{ \Carbon\Carbon::parse($event->date_debut)->toIso8601String() }}",
                            end: "{{ \Carbon\Carbon::parse($event->date_fin)->toIso8601String() }}",
                            url: "{{ $event->url ?? '#' }}",
                            allDay: true,
                            className: "{{ $event->responsable->id == $userConnected ? 'info' : 'success' }}"


                        }
                        @if (!$loop->last)
                            ,
                        @endif
                    @endif
                    @if ($event->equipement_type == 'telephone')

                        {

                            id: "{{ $event->id }}",
                            title: "{{ $event->TelephoneTablette->nom }}",
                            start: "{{ \Carbon\Carbon::parse($event->date_debut)->toIso8601String() }}",
                            end: "{{ \Carbon\Carbon::parse($event->date_fin)->toIso8601String() }}",
                            url: "{{ $event->url ?? '#' }}",
                            allDay: true,
                            className: "{{ $event->responsable->id == $userConnected ? 'info' : 'success' }}"


                        }
                        @if (!$loop->last)
                            ,
                        @endif
                    @endif
                    @if ($event->equipement_type == 'peripherique')

                        {

                            id: "{{ $event->id }}",
                            title: "{{ $event->peripherique->type }} {{ $event->peripherique->nom }}",
                            start: "{{ \Carbon\Carbon::parse($event->date_debut)->toIso8601String() }}",
                            end: "{{ \Carbon\Carbon::parse($event->date_fin)->toIso8601String() }}",
                            url: "{{ $event->url ?? '#' }}",
                            allDay: true,
                            className: "{{ $event->responsable->id == $userConnected ? 'info' : 'success' }}"


                        }
                        @if (!$loop->last)
                            ,
                        @endif
                    @endif
                @endforeach

            ],
            eventClick: function(event, jsEvent, view) {
                window.livewire.emit('visualiser', event.id);
            },
            eventDrop: function(event, delta, revertFunc) {
                console.log(event);
                window.livewire.emit('updateEventDate', {
                    id: event.id,
                    start: event.start,
                    end: event.end
                });
            }
        });


    });
</script>

<script>
    window.addEventListener('lightview', event => {
        const myModal = new bootstrap.Modal(document.getElementById('lightModalview'));
        myModal.show();
    });


    window.addEventListener('closeModal', event => {
        // Close ALL open modals
        document.querySelectorAll('.modal.show').forEach(modalEl => {
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide();
        });
    });
    window.addEventListener('open-error-modal', () => {
        let myModal = new bootstrap.Modal(document.getElementById('errorModal'));
        myModal.show();
    });
    document.getElementById('errorModal').addEventListener('hidden.bs.modal', () => {
        Livewire.emit('clearErrors');
    });
</script>