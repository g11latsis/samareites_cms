@extends('admin.layout.main')

@push('title')
Dashboard
@endpush

@section('main')
@php

    use App\Models\Alert;
    $alerts = Alert::where("to1", "admin")->where('trashedbyadmin', null)->orderby('created_at', 'DESC')->get();
    $seen = true;

    foreach ($alerts as $alert) {
      if($alert->seenbyadmin == false){
        $seen = false;
      }
    }

@endphp

<div class="container-fluid row">
  <div class="col-xl-2 col-lg-4 d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-2 dash-sidebar"
    style="width: 280px; min-height:100vh;">
    <div class="d-flex justify-content-between">
      <a href="{{ route('admin.dash') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Dashboard</span>
      </a>
      <button style="height: 37px;" class="btn btn-primary toggle-sidebar2 rounded"><i class="bi bi-arrow-left"></i></button>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="{{ route('admin.dash') }}" class="nav-link active text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          Πίνακας Ελέγχου
        </a>
      </li>
      <li>
        <a href="{{ route('admin.ra') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#table"></use>
          </svg>
          Περιφερειακός Διαχειριστής
        </a>
      </li>
      <li>
        <a href="{{ route('admin.user') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Εθελοντές
        </a>
      </li>
      <li>
        <a href="{{ route('admin.service') }}" class="nav-link text-white">
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
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Προφίλ</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Αποσύνδεση</a></li>
          </ul>
        </div>
      </div>
      <div class="col-9">
        {{-- if not seen --}}
        @if($seen == false)

          <a href="" data-bs-toggle="modal" onclick="seenByAdmin(this)" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;"><span style="top: 15px; padding: 5px;" class="position-absolute start-10 translate-middle bg-danger border border-light rounded-circle"  id="seen-alert-badge">
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
                <a href="{{ route('admin.delete.alert') }}"><button class="btn btn-danger rounded">Άδειο Γραμματοκιβώτιο</button></a>
              </div>
              @endif
            </div>
            @if (count($alerts) > 0)
            @foreach ($alerts as $alert)
              @if ($alert->desc1 != "")
                <div class="alert border rounded-0" role="alert">
                  <span class="text-dark">{{ $alert->desc1 }}</span> <br>
                  <span class="text-secondary" style="font-size: 11px">{{ $alert->created_at }}</span> <br>
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
    <div class="container mt-5">
      <div class="row">

        <div class="col-lg-5 col-md-5 col-sm-5 col-12 mx-2 mb-4 dash-cards" style="border-radius: 10px; box-shadow: rgb(116 116 116 / 35%) 0px 5px 15px;">

          <div class="box-part text-center">

            <i class="bi bi-people-fill" style="font-size: 42px" aria-hidden="true"></i>

            <div class="title">
              <h3 style="font-weight: bold">Σύνολο Περιφερειακών Διαχειριστών</h3>
            </div>

            <div class="text">
              <h3 style="font-weight: bold" class="text-primary">{{ $ras }}</h3>
            </div>

            <a href="{{ route('admin.ra') }}">Δείτε Λεπτομέρειες</a>

          </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-5 col-12 mx-2 mb-4 dash-cards" style="border-radius: 10px; box-shadow: rgb(116 116 116 / 35%) 0px 5px 15px;">

          <div class="box-part text-center">

            <i class="bi bi-people-fill" style="font-size: 42px" aria-hidden="true"></i>

            <div class="title">
              <h3 style="font-weight: bold">Συνολικός αριθμός εθελοντών</h3>
            </div>

            <div class="text">
              <h3 style="font-weight: bold" class="text-primary">{{ $users }}</h3>
            </div>

            <a href="{{ route('admin.user') }}">Δείτε Λεπτομέρειες</a>

          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-12 mx-2 mb-4 dash-cards" style="border-radius: 10px; box-shadow: rgb(116 116 116 / 35%) 0px 5px 15px;">

          <div class="box-part text-center">

            <i class="bi bi-book-half" style="font-size: 42px" aria-hidden="true"></i>

            <div class="title">
              <h3 style="font-weight: bold">Συνολικός αριθμός υπηρεσιών</h3>
            </div>

            <div class="text">
              <h3 style="font-weight: bold" class="text-primary">{{ $services }}</h3>
            </div>

            <a href="{{ route('admin.service') }}">Δείτε Λεπτομέρειες</a>

          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-12 mx-2 mb-4 dash-cards" style="border-radius: 10px; box-shadow: rgb(116 116 116 / 35%) 0px 5px 15px;">

          <div class="box-part text-center">

            <i class="bi bi-people-fill" style="font-size: 42px" aria-hidden="true"></i>

            <div class="title">
              <h3 style="font-weight: bold">Συνολικός αριθμός εθελοντών που συμμετέχουν αυτήν τη στιγμή</h3>
            </div>

            <div class="text">
              <h3 style="font-weight: bold" class="text-primary">{{ $parts }}</h3>
            </div>

            <a href="{{ route('admin.service') }}">Δείτε Λεπτομέρειες</a>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

@endsection