@extends("layouts.tabulka-layout")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vytvor úlohu
                        <a href="{{ url('tabulka') }}" class="btn btn-primary float-end">Naspäť</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tabulka.store') }}" method="POST">
                      @csrf

                       <div class="mb-3">
                        <label>Názov úlohy</label>
                        <input type="text" name="name" class="form-control">
                        @error("name") <span class="text-danger">{{ $message }}</span> @enderror
                       </div>
                       <div class="mb-3">
                        <label>Popis úlohy</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                        @error("description") <span class="text-danger">{{ $message }}</span> @enderror
                       </div>
                       <div class="mb-3">
                        <label>Stav úlohy</label>
                        <br/>
                        <input type="checkbox" name="status" style="width:30px;height:30px;" />&#9989;=Dokončené, &#129001;=Aktuálne
                        @error("status") <span class="text-danger">{{ $message }}</span> @enderror
                       </div>
                       <div class="mb-3">
                         <button type="submit" class="btn btn-primary">Uložiť</button>
                       </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection