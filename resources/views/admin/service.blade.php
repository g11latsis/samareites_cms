@extends('layouts.main')

@push('title')
    RA
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
        <button style="height: 37px;" class="btn btn-primary toggle-sidebar rounded"><i class="bi bi-arrow-left"></i></button>
      </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                  <a href="{{ route('admin.dash') }}" class="nav-link text-white">
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
                  <a href="{{ route('admin.service') }}" class="nav-link active text-white">
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
            @if (session()->has('alert'))
                <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('alert') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

           {{-- START grid system  --}}
           <header class="text-center bg-primary card border-0 p-4 shadow" >
            <div class="container">
                <h1 class="fw-light text-light">Λίστα Υπηρεσιών </h1>
            </div>
        </header>

        <div class="container mt-3 card border-1 shadow p-2 bg-light">

            <div class="table-responsive-md">
            <div class="bg-light p-2 mt-4 d-flex justify-content-between align-items-center search-bar" style="min-width: 596px;">
                <div class="d-flex justify-content-between">
                    <form action="" method="get">
                        <div class="input-group mx-2">
                            <div class="form-outline">
                                <input style="height: 37px;
                  border-radius: 0px;" type="search"
                                    name="search" id="form1" value="{{ $search }}" class="form-control" />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ url('/admin/service') }}">
                        <button class="btn btn-outline-primary rounded">Επαναφορά</button>
                    </a>
                </div>
                <a href="{{ route('adminService.index', ['url' => route('raService.store')]) }}"><button class="btn btn-primary rounded "
                    style="min-width: 182px;">Προσθήκη Υπηρεσίας</button></a>
              </div>

            <hr class="bg-dark">

            <div class="row my-1 text-center">
                <div class="col-lg-3 col-md-6">
                    <h4>Τίτλος</h4>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>Ημερομηνία</h4>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>Τύπος</h4>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>Επιλογές</h4>
                </div>
            </div>
            <hr class="bg-dark">


            @foreach ($services as $service)
                <div class="row m-1 text-center">
                    <div class="col-lg-3 col-md-6 card">
                            <div class="card-body">
                                <span class="card-title text-primary">{{ $service->name }}</span>

                            </div>
                    </div>
                    <div class="col-lg-3 col-md-6 card">
                            <div class="card-body">
                                <span class="card-title text-primary">{{ $service->date }}</span>

                            </div>
                    </div>
                    <div class="col-lg-3 col-md-6 card">
                            <div class="card-body">
                                <span class="card-title text-primary">{{ $service->type }}</span>

                            </div>
                    </div>
                    <div class="col-lg-3 col-md-6 card d-flex justify-content-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle rounded" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Επιλογές
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.service.profile', ['id' => $service->id]) }}">Λεπτομέριες</a></li>
                                <li><a class="dropdown-item" href="{{ route('adminService.edit', $service->id) }}">Επεξεργασία</a></li>
                                <form action="{{ route('adminService.destroy', $service->id) }}" method="POST">
                                    <input name="_method" type="hidden" value="DELETE">
                                    {{ csrf_field() }}
                                    <li><a class="dropdown-item" type="submit" href="#"><button type="submit"
                                          style="border: none; background:none;  position: relative; right:6px;">Διαγραφή</button></a></li> {{-- delete --}}
                                  </form>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            
          
                {{ $services->links() }}
            

            </div>
           


        </div>
      </div>
      <div>
        
      </div>
    </div>
  </div>
</div>
</div>



            {{-- END grid system  --}}
    </div>
    </div>
@endsection
