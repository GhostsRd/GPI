dd(gettype($id_receveur));
    


    @foreach ($results as $item)
    <div class="qr container   text-center offset-lg-4 mt-lg-4">
        {!! DNS2D::getBarcodeHTML("http://192.168.43.125:8000/find/$item->id", 'QRCODE',12,12,'grey', true)!!}
    </div>
    <div class="container titre offset-lg-5 mt-4">

        <button class="btn btn-sm rounded-3 btn-outline-secondary shadow-sm">
            <a href="javascript:window.print()" class="nav-link">Telecherger</a>
        </button>
    </div>
    @endforeach
</body>
</html>