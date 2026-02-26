<div>
    @if (url()->current() == url('/utilisateur-service'))
        <a class="navbar-brand text-white d-block d-md-none d-lg-none" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">

            Ticket

        </a>

        <a class="navbar-brand text-white d-none d-md-block d-lg-block" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">
            GPI - Pivot
        </a>
    @elseif(url()->current() == url('/utilisateur-checkout'))
        <a class="navbar-brand text-white d-block d-md-none d-lg-none" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">

            Checkout / Reservation

        </a>

        <a class="navbar-brand text-white d-none d-md-block d-lg-block" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">
            GPI - Pivot
        </a>
    @elseif(url()->current() == url('/utilisateur-incident'))
        <a class="navbar-brand text-white d-block d-md-none d-lg-none" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">

            Incident

        </a>

        <a class="navbar-brand text-white d-none d-md-block d-lg-block" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">
            GPI - Pivot
        </a>
    @elseif(url()->current() == url('/utilisateur-calendrier'))
        <a class="navbar-brand text-white d-block d-md-none d-lg-none" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">

            Réservation

        </a>

        <a class="navbar-brand text-white d-none d-md-block d-lg-block" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">
            GPI - Pivot
        </a>
    @else
        <a class="navbar-brand text-white" href="{{ route('utilisateur') }}">
            <img src="{{ url('images/bureau.png') }}" alt="Logo ONG Pivot" width="40" class="rounded-pill me-2">


            GPI - Pivot
        </a>
    @endif
</div>
