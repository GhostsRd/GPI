<div class="container-fluid row " style="margin-top: 5% ;scrollbar-width: none; -ms-overflow-style: none;"
    style="height:40vh;">
    <div class="col-lg-2  bg-white d-none d-lg-block d-xl-block py-1 px-0 ">


        @livewire('component.menu-utilisateur')

       
    </div>

    <div class="col-lg-9 row offset-1  mt-4 border-start"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <div wire:ignore.self class="p-2 col-lg-12 ">
            <h5 class="mt-2 pb-4 border-bottom fw-bold">Disponibilite de ce materiel</h5>
            <div class="row">
                <div class="col-lg-8 col-8">
                    <label class="text-muted mt-1 mt-md-0 mt-lg-0 d-flex justify-content-between">Materiel /
                        
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
        <div class="col-lg-10">
            <div id='calendar' wire:ignore
                style="width: 100% !important ;max-height:500px;overflow-y:scroll; scrollbar-width: none; -ms-overflow-style: none;">
            </div>

        </div>
        <div class="col-lg-2   mt-4">
            <h5 class="py-2">Dernier reservation</h5>

            <div>

                @if ($lastEvent)
                    Type de materiel :<label
                        class="text-muted text-center py-1 text-capitalize"><small>
                            
                            {{ $lastEvent->equipement_type }}   

                            @if($lastEvent->equipement_type == 'peripherique')
                            {{ $lastEvent->peripherique->type  }}</small></label>

                            @endif

                            {{-- {{ $lastEvent->equipement_type == 'ordinateur' ? $lastEvent->ordinateur->nom : $lastEvent->TelephoneTablette->nom }}</small></label> --}}
                    <br>
                    Utilisateur :
                    <label class="text-muted">
                        <img class="dropdown-toggle p-1 m-0 rounded-pill" data-toggle="dropdown"
                            src="https://ui-avatars.com/api/?name={{ $lastEvent->responsable->nom }}" alt="Profil"
                            width="40" height="30">
                        <small>{{ $lastEvent->responsable->nom }}</small>
                    </label>
                    <br>
                    Date debut : <label class="text-muted text-center py-1 text-capitalize"><small>
                            {{ \Carbon\Carbon::parse($lastEvent->date_debut)->translatedFormat('d M Y') }}
                        </small></label>
                    <br>
                    Date fin : <label
                        class="text-muted text-center py-1 text-capitalize"><small>{{ \Carbon\Carbon::parse($lastEvent->date_fin)->translatedFormat('d M Y') }}
                        </small></label>
                    <br>
                @else
                    <p class="">
                        Aucun événement trouvé.</p>
                @endif
            </div>

            <div class=" py-2 border-2 mt-2">
                <label>Prochaine rendez-vous</label>
                @forelse ($prochaines as $prochaine)
                    <div class="py-2 ">
                        • Le <small>
                            {{ \Carbon\Carbon::parse($prochaine->date_debut)->translatedFormat('d M Y') }}
                        </small> -
                        <small>{{ $prochaine->equipement_type }}
                            @if($prochaine->equipement_type == 'peripherique')
                                {{ $prochaine->peripherique->type }} {{ $prochaine->peripherique->nom  }}
                            @endif
                        </small>
                            {{-- {{ $prochaine->equipement_type == 'ordinateur' ? $prochaine->ordinateur->nom : $prochaine->TelephoneTablette->nom }}</small> --}}

                    </div>

                @empty
                    <p class="">
                        Aucun événement pour le moment.</p>
                @endforelse

            </div>
        </div>
        <div class="border-top mt-2 col-lg-12">
            <h5 class="py-4">Historique de vos reservation</h5>

            <div class="list-group mt-2  bg-white "
                style="max-height:400px;overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                @foreach ($historiques as $event)
                    <a href="#" style="--bs-bg-opacity: .5;"
                        class="list-group-item list-group-item-action border-0 border-top  {{ $event->created_at->isToday() ? '' : '' }} "
                        wire:click="visualiser({{ $event->id }})" data-bs-toggle="modal"
                        data-bs-target="#lightModalview">

                        <div class="d-flex w-100 justify-content-between">
                            <b class="mb-1 text-black-50"># {{ $event->id }} -
                                {{ $event->equipement_type }} ({{ $event->equipement_nombre }})
                            </b>
                            <small class="text-body-secondary">
                                {{ \Carbon\Carbon::parse($event->date_debut)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($event->date_fin)->translatedFormat('d M Y') }}
                            </small>
                            </small>
                        </div>

                        <div class="d-flex w-100 mt-2 justify-content-between">
                            <p class="mb-1 text-capitalize">
                                <small class="text-muted">
                                    {{ $event->equipement_type == 'ordinateur'
                                        ? $event->ordinateur->os_version
                                        : ($event->equipement_type == 'telephone'
                                            ? $event->TelephoneTablette->nom . ' ' . $event->TelephoneTablette->marque
                                            : ($event->equipement_type == 'peripherique'
                                            ? $event->peripherique->type . ' ' . $event->peripherique->nom
                                            : 'aucun') ) }}
                                </small>
                            </p>
                            {{-- <small class=" px-2 m-0 fw-bold rounded-pill border {{ $checkout->statut == 'En cours' ? 'text-warning' : 'text-danger' }}">
                                                        {{ $checkout->statut == 1 ? 'En cours' : ( $checkout->statut == 2 ? 'Valider' : 'Fermer' )}}
                                                    </small> --}}
                            <div class="d-flex justify-content-end">
                                <small
                                    class="text-muted mx-2">{{ $event->statut == 1 ? 'En cours' : ($event->statut == 2 ? 'Valider' : 'Fermer') }}</small>
                                <img class="dropdown-toggle  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                    src="https://ui-avatars.com/api/?name={{ $event->responsable->nom }}"
                                    alt="Profil" width="30" height="30" class="rounded-circle me-2">
                            </div>
                        </div>

                    </a>
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
            <div class="modal-content  border-0"> <!-- réduit l’ombre -->

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
                              {{ $materiel->type }}  {{ $materiel->nom }} 
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
                    <textarea type="text" placeholder="Commencer à écrire" class="input-recherche px-2 w-100 border rounded py-2"
                        wire:model="commentaire"></textarea>
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

                            {{ $item->equipement_type == 'ordinateur' ? $item->ordinateur->nom : $item->TelephoneTablette->nom }}
                            <small class="text-muted" style="font-size:0.8rem">cree le
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y H:m') }} </small>

                        </label>

                        <button type="submt" data-bs-toggle="modal" data-bs-target="#lightModal"
                            @if (
                                ($item->date_debut > now() || $item->created_at->isToday()) &&
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
                        <textarea placeholder="{{ $item->commentaire != null ? $item->commentaire : 'Aucun commentaire' }}" disabled
                            rows="4" class="form-control" wire:model="commentaire">
                    </textarea>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-two text-white fw-bold"
                            data-bs-dismiss="modal">Fermer</button>


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

                            {{ $item->equipement_type == 'ordinateur' ? $item->ordinateur->nom : $item->TelephoneTablette->nom }}

                        </label>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label mt-2 mx-1">Date de début</label>
                        <input type="date" style="z-index: 2600"
                            class="form-control border-0 rounded-0 border-bottom" wire:model="datedeb"
                            value="{{ $datedeb }}">

                        <label class="form-label mt-2 mx-1">Date de retour</label>
                        <input type="date" style="z-index: 2600"
                            class="form-control border-0 rounded-0 border-bottom" required wire:model="datefin">

                        <label class="form-label mt-2 mx-1">Nombre</label>
                        <input type="number" style="z-index: 2600"
                            class="form-control border-0 rounded-0 border-bottom" required wire:model="nbequipement"
                            placeholder="Ex: 1">

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
                        <button type="submit" wire:click="AnnulerReservation({{ $item->id }})"
                            data-bs-dismiss="modal" class="btn btn-danger text-white fw-bold btn-sm">Annuler
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
                <button class="btn btn-secondary position-relative" wire:click="clearErrorsFn"
                    data-bs-dismiss="modal">

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
