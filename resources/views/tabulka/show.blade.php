@extends("layouts.tabulka-layout")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Podrobnosti úlohy
                        <a href="{{ url('tabulka') }}" class="btn btn-primary float-end">Naspäť</a>
                    </h4>
                </div>
                <div class="card-body">
                       <div class="mb-3">
                        <label>Názov úlohy:</label>
                        <p style='border:1px solid #dee2e6;border-radius:15px;padding:5px'>
                        {{ $tabulka->name }}
                        </p>
                       </div>
                       <div class="mb-3">
                        <label>Popis úlohy:</label>
                        <p style='border:1px solid #dee2e6;border-radius:15px;padding:5px'>
                        {!! $tabulka->description !!}
                        </p>
                       </div>
                       <div class="mb-3">
                        <label>Stav úlohy:</label>
                        <br/>
                        <p>
                        {!! $tabulka->status == 1 ? '&#9989Dokončené':'&#129001Nedokončené'!!}
                        </p>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection