<div class="container mt-4">
    <div class="row">
        @foreach($steps as $step)
            <div class="col-md-4">
                <div class="card border-secondary mb-3 step-column" 
                     wire:drop.prevent="moveTicket($event.detail.ticketId, {{ $step['id'] }})"
                     ondragover="event.preventDefault()"
                     style="min-height: 300px;">

                    <div class="card-header bg-secondary text-white text-center">
                        {{ $step['name'] }}
                    </div>

                    <div class="card-body" data-step="{{ $step['id'] }}">
                        @foreach($tickets as $ticket)
                            @if($ticket['step_id'] == $step['id'])
                                <div class="card mb-2 shadow-sm draggable-card"
                                     draggable="true"
                                     ondragstart="event.dataTransfer.setData('ticketId', '{{ $ticket['id'] }}')">
                                    <div class="card-body p-2 text-center">
                                        {{ $ticket['title'] }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
    document.addEventListener('livewire:init', () => {
    Livewire.on('drop', event => {
        const ticketId = event.detail.ticketId;
        const stepId = event.detail.stepId;
        Livewire.dispatch('moveTicket', { ticketId, stepId });
    });
});
    </script>
</div>


