<x-layout>

    <h1 class="text-center"><span class="text-capitalize"> {{ $user->name }} </span>vuole lavorare con noi</h1>
    <div class="container-fluid d-flex justify-content-center">
        <div class="text-center">
            <h4>Ecco i suoi dati:</h4>

            <p><i>Nome:</i></p>
            <h5 class="text-capitalize">{{ $user->name }}</h5>
            <p><i>E-mail:</i></p>
            <h5>{{ $user->email }}</h5>
            <p>Se vuoi renderlo revisore clicca qui:</p>
            <a class="btn btn-card my-3" href="{{ route("make.revisor",compact("user")) }}">Rendi revisore</a>
        </div>
        <div class="container d-flex justify-content-end align-items-start">
            <div class="d-flex justify-content-end align-items-center mr-2 bg-black rounded-circle mt-3" style="width: 200px; height: 200px;">
                <img src="https://img.freepik.com/premium-vector/office-team-teamwork-businessman-set-man-workplace-interior-worker-suit-by-table-cartoon-people-different-poses-cute-characters-simple-design-flat-style-illustration_207561-18.jpg" alt="Descrizione dell'immagine" class="img-fluid rounded-circle p-2">
            </div>
        </div>
    </div>

</x-layout>