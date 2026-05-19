<div class="container-fluid row " style=" scrollbar-width: none; -ms-overflow-style: none;"
    style="height:40vh;">
     <div wire:loading.flex
        class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center"
        style="z-index: 10;">
        <div class="spinner-border text-secondary" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
    </div>
    <div class="col-lg-2  d-none d-lg-block d-xl-block py-1 px-0 ">

        @livewire('component.menu-utilisateur')

       
    </div>

    <div class="offset-sm-1 col-lg-7 bg-white">
        <div class=" m-2  m-lg-0 m-xl-0  row  mt-4 border-0 border-md-start"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <div wire:ignore.self class="p-2 col-lg-12 ">
            <h5 class="mt-2 pb-4 border-bottom fw-bold">Calendrier de mes reservation</h5>
            <label class="text-muted  d-flex justify-content-between">Disponibilite /
                Tous vos reservation </label>
            <div class="d-flex  justify-content-end">
                <div class="btn border-0  py-0 fw-bold rounded-3 text-white  btn-two p-0 mx-2 btn-sm"
                    data-bs-toggle="modal" data-bs-target="#centeredModalreservation">
                    <i class="bi bi-plus"></i> Nouveau
                </div>




            </div>
        </div>
        <div class="col-lg-9">
            <div id='calendar' wire:ignore
                style="width: 100% !important ;max-height:500px;overflow-y:scroll; scrollbar-width: none; -ms-overflow-style: none;">
            </div>

        </div>
        <div class="col-lg-3   mt-4">
            <h5 class="py-2 border-bottom">Prochaine rendez-vous</h5>

            <div>
                @forelse ($lastEvent as $last)
                    <div class="">
                        • Le <small>
                            {{ \Carbon\Carbon::parse($last->date_debut)->translatedFormat('d M Y') }}
                        </small> -
                        <small>
                            {{ $last->equipement_type }}

                            @if($last->equipement_type == 'peripherique')
                                {{ $last->peripherique->type }} {{ $last->peripherique->nom }}
                            @endif
                            {{-- {{ $last->equipement_type == 'ordinateur' ? $last->ordinateur->nom : $last->TelephoneTablette->nom }} --}}
                        </small>
                    </div>
                    <br>
                @empty
                    <p class="">Aucun événement trouvé.</p>
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
                                {{ $event->equipement_type }} - nb : {{ $event->equipement_nombre }}
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
                                            : 'aucun')) }}
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
                    <label class="fw-bold mx-2">
                        Listes des materiels
                    </label>

                    <br>
                    <div class="m-2">
                        <div class="search-wrapper position-relative">
                            <i class="bi bi-search search-icon text-muted "></i>

                            <input type="text" wire:model.debounce.500ms="recherche"
                                placeholder="  Tapez le matériel" class="px-4 w-100 py-2 input-model rounded-0">

                            @if ($recherche)
                                <i class="bi bi-x-circle reset-icon" wire:click="$set('recherche','')"
                                    style="cursor:pointer"></i>

                                    
                            @endif
                        </div>

                        <div>
                            <div class="" style="max-height: 300px;overflow-y:scroll">
                                <div wire:loading wire:target="recherche" class="text-center my-2">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    <small class="text-muted ms-2">Recherche en cours...</small>
                                </div>
                                @if ($ordinateurs)
                                    <div class="py-2">
                                        <label for="p-4">Ordinateurs</label>
                                    </div>
                                    @foreach ($ordinateurs as $ordinateur)
                                        <div class="materiel-item  bg-light py-2 mb-1 rounded-2"
                                            wire:click="reserverMat('ordinateur',{{ $ordinateur->id }})">

                                            <small class="m-2 mx-3" wire:loading.remove
                                                wire:target="reserverMat('ordinateur',{{ $ordinateur->id }})">
                                                {{ $ordinateur->nom }} {{ $ordinateur->os_version }}
                                            </small>
                                            <div wire:loading
                                                wire:target="reserverMat('ordinateur',{{ $ordinateur->id }})">
                                                <div class="spinner-border spinner-border-sm"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($telephones)

                                    <div class="py-2">
                                        <label for="p-4">Telephones</label>
                                    </div>
                                    @foreach ($telephones as $telephone)
                                        <div class="bg-light py-2 mb-1 rounded-2"
                                            wire:click="reserverMat('telephone',{{ $telephone->id }})">

                                            <small class="m-2 mx-3" wire:loading.remove
                                                wire:target="reserverMat('telephone',{{ $telephone->id }})">
                                                {{ $telephone->nom }} {{ $telephone->marque }}
                                            </small>
                                            <div wire:loading
                                                wire:target="reserverMat('telephone',{{ $telephone->id }})">
                                                <div class="spinner-border spinner-border-sm"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                @if($peripheriques)
                                        <div class="py-2">
                                        <label for="p-4">Peripheriques</label>
                                    </div>
                                    @foreach ($peripheriques as $peripherique)
                                        <div class="bg-light py-2 mb-1 rounded-2" style="cursor: pointer"
                                            wire:click="reserverMat('peripherique',{{ $peripherique->id }})">

                                            <small class="m-2 mx-3" wire:loading.remove
                                                wire:target="reserverMat('peripherique',{{ $peripherique->id }})">
                                                {{ $peripherique->type }} {{ $peripherique->nom }} 
                                            </small>
                                            <div wire:loading
                                                wire:target="reserverMat('peripherique',{{ $peripherique->id }})">
                                                <div class="spinner-border spinner-border-sm"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm  btn-secondary  border "
                            data-bs-dismiss="modal">Quitter</button>
                        <button type="submit" wire:click="SAVEreserverEquipement"
                            class="btn btn-sm btn-two fw-bold text-white">Envoyer</button>
                    </div>

                </div>
            </div>
        </div>




    </div>
    </div>
</div>

<style>
    .search-wrapper {
        width: 100%;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 6px;
        transform: translateY(-50%);
        font-size: 17px;
        color: #b5b3b3c1;
        padding-right: 6px !important;
        pointer-events: none;
    }

    .reset-icon {
        position: absolute;
        top: 50%;
        right: 6px;
        transform: translateY(-50%);
        font-size: 17px;
        color: #888;
    }

    .input-model {
        border: none !important;
        border-bottom: 1px solid #ccc !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .input-model:focus,
    .input-model:hover {
        border: none !important;
        border-bottom: 2px solid #5BC4BF !important;
        box-shadow: none !important;
        /* Enlève le bleu du Bootstrap */
        outline: none !important;
    }

    .input-model:active {
        border: none !important;
        border-bottom: 2px solid #5BC4BF !important;
        box-shadow: none !important;
    }

    .materiel-item {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .materiel-item:hover {
        background-color: #e9ecef;
        /* gris plus foncé */
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
                            className: "success"


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
                            className: "info"


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
</script>
