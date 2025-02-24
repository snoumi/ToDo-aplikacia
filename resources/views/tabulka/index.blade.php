@extends("layouts.tabulka-layout")

@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-12">

           @if (session('status'))
            <div class="alert alert-success">
               {{ session('status') }}
            </div>
           @endif
                

            <div class="card">
                <div class="card-header">
                    <h4>Tabuľka úloh
                        <a href="{{ url("tabulka/create") }}" class="btn btn-primary float-end">Pridaj úlohu</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Názov</th>
                                <th>Popis</th>
                                <th>Stav</th>
                                <th>Akcie</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tabulkas as $tabulka)
                            <tr>
                                <td>{{ $tabulka->id }}</td>
                                <td>{!! $tabulka->name !!}</td>
                                <td>{!! $tabulka->description !!}</td>
                                <td>{!! $tabulka->status == 1 ? "&#9989Dokončené":"&#129001Nedokončené" !!}</td>
                                <td>
                                    <a href="{{ route("tabulka.edit", $tabulka->id) }}" class="btn btn-success">Uprav</a>
                                    <a href="{{ route("tabulka.show", $tabulka->id) }}" class="btn btn-info">Podrobnosti</a>
                                    <form action="{{ route("tabulka.destroy", $tabulka->id) }}" method="POST" class='d-inline'>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Odstráň</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection