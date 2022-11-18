@extends('layouts.main')
@section('main')
@php
    use App\Models\rAdmins;
@endphp

@php

    use App\Models\Alert;
    $alerts = Alert::where("to2", session('ra')->id)->where('trashedbyra', null)->orderby('created_at', 'DESC')->get();
    $seen = true;

    foreach ($alerts as $alert) {
      if($alert->seenbyra == false){
        $seen = false;
      }
}

@endphp

<div class="container-fluid row">
    <div class="col-xl-2 col-lg-4 d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-2 dash-sidebar"
      style="width: 280px; min-height:100vh;">
      <div class="d-flex justify-content-between">
        <a href="{{ route('ra.dash') }}"
          class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <svg class="bi pe-none me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
          </svg>
          <span class="fs-4">Dashboard</span>
        </a>
        <button style="height: 37px;" class="btn btn-primary toggle-sidebar rounded"><i class="bi bi-arrow-left"></i></button>
      </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{ route('ra.dash') }}" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Πίνακας Ελέγχου
                    </a>
                </li>
                <li>
                    <a href="{{ route('ra.user') }}" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Εθελοντές
                    </a>
                </li>
                <li>
                    <a href="{{ route('ra.service') }}" class="nav-link text-white active">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Υπηρεσίες
                    </a>
                </li>
            </ul>
            <hr>
            <div class="row">
                <div class="col-3 d-flex align-items-center">
                  <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset('images/default_user2.png') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                      <strong></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="">
                      <li><a class="dropdown-item" href="{{ route('ra.profile', ['id' => session('ra')->id]) }}">Προφίλ</a></li>
                      <li><a class="dropdown-item" href="{{ route('ra.logout') }}">Αποσύνδεση</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-9">
                  {{-- if not seen --}}
                  @if($seen == false)
          
                    <a href="" data-bs-toggle="modal" onclick="seenByRa(this)" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;"><span style="top: 15px; padding: 5px;" class="position-absolute start-10 translate-middle bg-danger border border-light rounded-circle"  id="seen-alert-badge">
                      <span class="visually-hidden">New alerts</span>
                    </span></i></a>
          
                {{--  --}}
                {{-- if seen --}}
                @else
          
                    <a href="" data-bs-toggle="modal" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;">
                    </span></i></a>
          
                @endif
                  {{--  --}}
                </div>
              </div>
        </div>
        <div class="col-xl-10 col-lg-8 col-md-12 con-ad-dash">
    {{-- mail modal --}}
    <div class="modal fade" id="mailmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-6 d-flex justify-content-end align-items-center">
                  <div class="text-center text-primary mb-2">
                    <i class="bi bi-envelope-paper" style="font-size: 37px;"></i>
                  </div>
                </div>
                @if (count($alerts) > 0)
                <div class="col-6 d-flex justify-content-end align-items-center">
                  <a href="{{ route('ra.delete.alert') }}"><button class="btn btn-danger rounded">Άδειο Γραμματοκιβώτιο</button></a>
                </div>
                @endif
              </div>
              @if (count($alerts) > 0)
                @foreach ($alerts as $alert)
                  @if ($alert->desc2 != "")
                      
                  <div class="alert border rounded-0" role="alert">
  
                      @if ($alert->from == "admin")
                      <span class="text-dark">{{ $alert->desc2 }}</span> <br>
                      @else
                      <span class="text-dark">{{ $alert->desc2 }}</span> <br>
                      @endif
                      <span class="text-secondary" style="font-size: 11px">
                        @if ($alert->from == "admin")
                        Από τον Κεντρικό Διαχειριστή - 
                        @endif
                      {{ $alert->created_at }}</span> <br>
  
                  </div>
  
                  @endif
                @endforeach
              @else
                  <h4 class="text-danger text-center" style="position: relative; right: 31px;">Δεν βρέθηκαν Εγγραφές.</h4>
              @endif
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
            </div>
          </div>
        </div>
      </div>
      {{--  --}}
            <button class="btn btn-primary toggle-sidebar rounded"><i class="bi bi-arrow-right"></i></button>
            <header class="text-center bg-primary card border-0 p-4 shadow">
                <div class="container">
                    <h1 class="fw-light text-light">Λεπτόμέρειες Υπηρεσιών</h1>
                </div>
            </header>
            <div class="container card border-2 shadow py-4 bg-light">

                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">
                        <span class="text-secondary"><span class="h5 text-primary">Id: &nbsp &nbsp</span>{{ $service->id ?? '' }}
                        </span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Ονοματεπώνυμο: &nbsp
                                &nbsp</span>{{ $service->name ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Αριθμός Μητρώου: &nbsp
                                &nbsp</span>{{ $service->regno ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Ημερομηνία: &nbsp
                                &nbsp</span>{{ $service->date ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Τύπος: &nbsp
                                &nbsp</span>{{ $service->type ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Λεπτομέριες: &nbsp
                                &nbsp</span>{{ $service->detail ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Οχημα: &nbsp
                                &nbsp</span>{{ $service->veh ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Τύπος οχήματος: &nbsp
                                &nbsp</span>{{ $service->vehtype ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Οδηγός οχήματος: &nbsp
                                &nbsp</span>{{ $service->driver ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Περιγραφή: &nbsp
                                &nbsp</span>{{ $service->desc ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Τόπος: &nbsp
                                &nbsp</span>{{ $service->locus ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Ώρα Έναρξης: &nbsp
                                &nbsp</span>{{ $service->strthrs ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Ώρα Λήξης: &nbsp
                                &nbsp</span>{{ $service->endhrs ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Συνολικές Ώρες: &nbsp
                                &nbsp</span>{{ $service->ttlhrs ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Συμμετέχοντες: &nbsp
                                &nbsp</span>@foreach ($parts as $part)
                                    <a href="{{ route('ra.user.profile', $part->id) }}"><u>{{ $part->name ?? '' }}</u></a>,
                                @endforeach</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Ώρες Ανα συμμετέχοντα: &nbsp
                                &nbsp</span>{{ $service->parthrs ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Περιοχή: &nbsp
                                &nbsp</span>{{ $service->region ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>
                    <div class="col-md-6 col-sm-12 mb-2 ra-ser-pro-center">

                        <span class="text-secondary"><span class="h5 text-primary">Περιφερειακός Διαχειριστής: &nbsp
                            @php
                                $ra = rAdmins::find($service->ra_id);
                            @endphp
                                &nbsp</span>{{ $ra->fname ?? '' }}</span>
                        <hr class="bg-dark">
                    </div>

                </div>


            </div>

        </div>
    </div>
@endsection
