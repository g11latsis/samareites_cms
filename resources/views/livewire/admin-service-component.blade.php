<div>
    <form action="{{ route('adminService.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τίτλος
                    :</label>
                <input type="text" name="name" class="form-control rounded-0" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('name') }}">
                <span class="text-danger">
                    @error('name')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Αριθμός Μητρώου
                    :</label>
                <input type="text" name="regno" class="form-control rounded-0" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('regno') }}">
                <span class="text-danger">
                    @error('regno')
                    {{ $message }}
                    @enderror
                </span>
            </div>
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
            <div class="col-xl-12 col-md-12 mb-3">
                <div class="form-floating">
                    <textarea class="form-control" style="border-radius: 0px;" name="exp" placeholder="Λεπτομέριες" id="floatingTextarea2" style="height: 150px"></textarea>
                    <label for="floatingTextarea2">Λεπτομέρειες</label>
                  </div>
                <span class="text-danger">
                    @error('exp')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Οχημα (Εάν υπάρχει)
                    :</label>
                <input type="text" name="veh" class="form-control rounded-0" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('veh') }}">
                <span class="text-danger">
                    @error('veh')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τύπος οχήματος (επίσημο, ιδιωτικό)
                    :</label>
                <input type="text" name="vehtype" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('vehtype') }}">
                <span class="text-danger">
                    @error('vehtype')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Οδηγός οχήματος (αν υπάρχει)
                    :</label>
                <input type="text" name="driver" class="form-control" style="border-radius: 0px;" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('driver') }}">
                <span class="text-danger">
                    @error('driver')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <div class="form-floating">
                    <textarea class="form-control" name="desc" style="border-radius: 0px;" placeholder="Λεπτομέριες" id="floatingTextarea2" style="height: 150px"></textarea>
                    <label for="floatingTextarea2">Περιγραφή</label>
                  </div>
                <span class="text-danger">
                    @error('desc')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τόπος
                    :</label>
                <input type="text" name="locus" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('locus') }}">
                <span class="text-danger">
                    @error('locus')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρα Έναρξης
                    :</label>
                <input type="text" name="strthrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('strthrs') }}">
                <span class="text-danger">
                    @error('strthrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρα Λήξης
                    :</label>
                <input type="text" name="endhrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('school') }}">
                <span class="text-danger">
                    @error('endhrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Συνολικές Ώρες
                    :</label>
                <input type="text" name="ttlhrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <span class="text-danger" value="{{ old('ttlhrs') }}">
                    @error('ttlhrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Συμμετέχοντες
                    :</label>
                <select name="parts[]" id="example" class="form-control"  multiple="multiple">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('parts')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρες Ανα συμμετέχοντα
                    :</label>
                <input type="text" name="parthrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <span class="text-danger" value="{{ old('parthrs') }}">
                    @error('parthrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Περιοχή
                    :</label>
                <input type="text" name="region" class="form-control"
                    aria-describedby="emailHelp">
                <span class="text-danger" value="{{ old('region') }}">
                    @error('region')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            </div>
            <div class="col-12 mb-3">
                <a href="">
                    <button class="btn btn-primary rounded">Υποβολή</button>
                </a>
            </div>
        </div>
    </form>
    @push('script')
    <script>
       
        $(function(){

        $("select").bsMultiSelect();

        });
        
    </script>
    @endpush
    @push('script')
    <script>
   
    </script>
@endpush
</div>