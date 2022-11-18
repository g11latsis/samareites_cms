@extends('admin.layout.main')

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
        <button style="height: 37px;" class="btn btn-primary toggle-sidebar2 rounded"><i class="bi bi-arrow-left"></i></button>
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
                <a href="{{ route('admin.ra') }}" class="nav-link active text-white">
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
        @if(session()->has('alert'))
        <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="add-ra-main">
            <div class="container">
                <h2 class="text-center mb-4">Προσθήκη χρήστη</h2>
                <form action="{{ route('adminRa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- personal info --}}
                        <h6><b class="text-dark">Προσωπικές Πληροφορίες:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ονομα
                                :</label>
                            <input type="text" name="fname" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('fname') }}">
                            <span class="text-danger">
                                @error('fname')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">επίθετο
                                :</label>
                            <input type="text" name="lname" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('lname') }}">
                            <span class="text-danger">
                                @error('lname')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ημερομηνία Γέννησης
                                :</label>
                            <input type="date" name="dob" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('dob') }}">
                            <span class="text-danger">
                                @error('dob')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ομάδα Αίματος
                                :</label>
                            <input type="text" name="bloodgroup" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('bloodgroup') }}">
                            <span class="text-danger">
                                @error('bloodgroup')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-check col-xl-3 col-md-6 mb-4">
                            <label for="exampleInputEmail1" class="form-label">Ομάδα Αίματος
                                :</label> <br>
                            <input class="form-check-input mx-2" type="radio" name="donor" value="Ναί"
                                id="flexRadioDefault1">
                            <label class="form-check-label mx-5" for="flexRadioDefault1">
                                Ναί
                            </label> <br>
                        </div>
                        <div class="form-check col-md-6 col-xl-3">
                            <label for="exampleInputEmail1" style="margin-top: 23px" class="form-label">
                            </label> <br>
                            <input class="form-check-input mx-2" type="radio" name="donor" value="Οχι"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label mx-5" for="flexRadioDefault2">
                                Οχι
                            </label>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βαθμός
                                :</label>
                            <input type="text" name="lvl" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('lvl') }}">
                            <span class="text-danger">
                                @error('lvl')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ειδίκότητα
                                :</label>
                            <input type="text" name="spec" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('spec') }}">
                            <span class="text-danger">
                                @error('spec')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ιδιότητα
                                :</label>
                            <input type="text" name="attr" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('attr') }}">
                            <span class="text-danger">
                                @error('attr')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βαθμός
                                :</label>
                            <input type="text" name="grade" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('grade') }}">
                            <span class="text-danger">
                                @error('grade')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Φύλο
                                :</label>
                            <input type="text" name="gen" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('gen') }}">
                            <span class="text-danger">
                                @error('gen')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">ΑΦΜ
                                :</label>
                            <input type="text" name="vat" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('vat') }}">
                            <span class="text-danger">
                                @error('vat')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Δ.O.Y
                                :</label>
                            <input type="text" name="doy" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('doy') }}">
                            <span class="text-danger">
                                @error('doy')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Αριθμός Ταυτότητας
                                :</label>
                            <input type="text" name="idno" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('idno') }}">
                            <span class="text-danger">
                                @error('idno')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Διαβατηρίου
                                :</label>
                            <input type="file" name="passport" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('passport')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">A.M.K.A
                                :</label>
                            <input type="text" name="amka" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('amka') }}">
                            <span class="text-danger">
                                @error('amka')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ταυτότητα Μέλους
                                :</label>
                            <input type="text" name="memberid" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('memberid') }}">
                            <span class="text-danger">
                                @error('memberid')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Κατάσταση
                                :</label>
                            <input type="text" name="status1" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('status1') }}">
                            <span class="text-danger">
                                @error('status1')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εικόνα
                                :</label>
                            <input type="file" name="img" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('img')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- address --}}
                        <h6><b class="text-dark">Πληροφορίες διεύθυνσης:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Μόνιμη διεύθυνση
                                :</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('address') }}">
                            <span class="text-danger">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ταχυδρομικός Κώδικας
                                :</label>
                            <input type="text" name="postal" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('postal') }}">
                            <span class="text-danger">
                                @error('postal')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Πόλη
                                :</label>
                            <input type="text" name="city" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('city') }}">
                            <span class="text-danger">
                                @error('city')
                                {{ $message }}
                                @enderror
                            </span> 
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εν ενεργεία στην Πόλη
                                :</label>
                            <input type="text" name="active" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('active') }}">
                            <span class="text-danger">
                                @error('active')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- contact --}}
                        <h6><b class="text-dark">Στοιχεία επικοινωνίας:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Τηλ. Σταθερό
                                :</label>
                            <input type="text" name="contact" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('contact') }}">
                            <span class="text-danger">
                                @error('contact')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Τηλ. Κινητό
                                :</label>
                            <input type="text" name="tele" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('tele') }}">
                            <span class="text-danger">
                                @error('tele')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">E-mail
                                :</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('value') }}">
                            <span class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- education --}}
                        <h6><b class="text-dark">Επίπεδο Εκπαίδευσης:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εκπαίδευση
                                :</label>
                            <input type="text" name="edu" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('edu') }}">
                            <span class="text-danger">
                                @error('edu')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Πτυχία
                                :</label>
                            <input type="text" name="degrees" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('degrees') }}">
                            <span class="text-danger">
                                @error('degrees')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Σχολή
                                :</label>
                            <input type="text" name="school" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('school') }}">
                            <span class="text-danger">
                                @error('school')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- eac training --}}
                        <h6><b class="text-dark">Εκπαίδευση ΕΕΣ:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ειδικότητα
                                :</label>
                            <input type="text" name="eacspec" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('eacspec') }}">
                            <span class="text-danger">
                                @error('eacspec')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βαθμός
                                :</label>
                            <input type="file" name="eacdegree" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('eacdegree')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">διάκριση ΕΕΣ
                                :</label>
                            <input type="text" name="eacdesctin" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('eacdesctin') }}">
                            <span class="text-danger">
                                @error('eacdesctin')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">ΕΕΣ διάκριση αποδεικτικό
                                :</label>
                            <input type="file" name="eacdesctinproof" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('eacdesctinproof')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εκπαιδεύσεις online
                                :</label>
                            <input type="text" name="onlinetrai" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('onlinetrai') }}">
                            <span class="text-danger">
                                @error('onlinetrai')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εκπαιδεύσεις online Βεβαιώσεις σε pdf
                                :</label>
                            <input type="file" name="onlinetraicert" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('onlinetraicert')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Άλλες εκπαιδεύσεις στην Online πλατφόρμα της IFRC (International Federation of Red Cross, Red Crescent)
                                :</label>
                            <input type="text" name="othertrai" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('othertrai') }}">
                            <span class="text-danger">
                                @error('othertrai')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">βεβαιώσεις σε pdf
                                :</label>
                            <input type="file" name="othertraicert" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('othertraicert')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- total hrs of volunteering --}}
                        <h6><b class="text-dark">Εθελοντισμός:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Συνολικές ώρες εθελοντισμού
                                :</label>
                            <input type="text" name="vhrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('vhrs') }}">
                            <span class="text-danger">
                                @error('vhrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Συνολικές ώρες υγειονομικής περίθαλψης
                                :</label>
                            <input type="text" name="healthcarehrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('healthcarehrs') }}">
                            <span class="text-danger">
                                @error('healthcarehrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Συνολικές ώρες διάσωσης
                                :</label>
                            <input type="text" name="rescuehrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('rescuehrs') }}">
                            <span class="text-danger">
                                @error('rescuehrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Συνολικές ώρες νοσηλείας
                                :</label>
                            <input type="text" name="nursinghrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('nursinghrs') }}">
                            <span class="text-danger">
                                @error('nursinghrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες κοινωνικής υπηρεσίας
                                :</label>
                            <input type="text" name="sshrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('sshrs') }}">
                            <span class="text-danger">
                                @error('sshrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες προπόνησης
                                :</label>
                            <input type="text" name="traihrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('traihrs') }}">
                            <span class="text-danger">
                                @error('traihrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- current year hrs --}}
                        <h6><b class="text-dark">Ώρες τρέχοντος έτους:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες εθελοντισμού τρέχοντος έτους
                                :</label>
                            <input type="text" name="cyvolunteeringhrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cyvolunteeringhrs') }}">
                            <span class="text-danger">
                                @error('cyvolunteeringhrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες υγειονομικής περίθαλψης φέτος
                                :</label>
                            <input type="text" name="cyhealthhrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cyhealthhrs') }}">
                            <span class="text-danger">
                                @error('cyhealthhrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες διάσωσης φέτος
                                :</label>
                            <input type="text" name="cyrescuehrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cyrescuehrs') }}">
                            <span class="text-danger">
                                @error('cyrescuehrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες νοσηλευτικής φέτος
                                :</label>
                            <input type="text" name="cynursinghrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cynursinghrs') }}">
                            <span class="text-danger">
                                @error('cynursinghrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες κοινωνικής υπηρεσίας φέτος
                                :</label>
                            <input type="text" name="cysshrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cysshrs') }}">
                            <span class="text-danger">
                                @error('cysshrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ώρες προπόνησης φέτος
                                :</label>
                            <input type="text" name="cytraininghrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cytraininghrs') }}">
                            <span class="text-danger">
                                @error('cytraininghrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εκπαιδευτικές ώρες φέτος
                                :</label>
                            <input type="text" name="cyeduhrs" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('cyeduhrs') }}">
                            <span class="text-danger">
                                @error('cyeduhrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- penalties --}}
                        <h6><b class="text-dark">Ποινές:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ημερομηνία
                                :</label>
                            <input type="date" name="date" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('date') }}">
                            <span class="text-danger">
                                @error('date')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Τύπος
                                :</label>
                            <input type="text" name="type" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('type') }}">
                            <span class="text-danger">
                                @error('type')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Διάρκεια
                                :</label>
                            <input type="text" name="duration" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('duration') }}">
                            <span class="text-danger">
                                @error('duration')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Περιγραφή
                                :</label>
                            <input type="text" name="desc" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('desc') }}">
                            <span class="text-danger">
                                @error('desc')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εγγραφα
                                :</label>
                            <input type="file" name="doc" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('doc')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- others --}}
                        <h6><b class="text-dark">Ειδικές γνώσεις:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Διάρκεια
                                :</label>
                            <input type="text" name="spknow" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('spknow') }}">
                            <span class="text-danger">
                                @error('spknow')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Κωδικός Πρόσβασης
                                :</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('password') }}">
                            <span class="text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Επιβεβαίωση Κωδικού
                                :</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('password_confirmation') }}">
                            <span class="text-danger">
                                @error('password_confirmation')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Άδεια οδήγησης (π.χ. άδεια οδήγησης, σκάφους, βαρέων μηχανημάτων)
                                :</label>
                            <input type="file" name="licenses" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('licenses')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βιογραφικό
                                :</label>
                            <input type="file" name="cv" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('cv')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Περιοχή
                                :</label>
                            <input type="text" name="region" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('region') }}">
                            <span class="text-danger">
                                @error('region')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12 mb-3">
                            <a href="">
                                <button class="btn btn-primary rounded">Υποβολή</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection