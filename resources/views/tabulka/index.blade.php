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
                        <a href="{{ url("tabulka/create") }}" class="btn btn-primary float-end">Pridaj úlohu</a>

                        <form action="{{ url('tabulka') }}" method="GET" class="d-flex justify-content-center mb-3">
                         <input type="text" name="search" class="form-control w-50 me-2" placeholder="Hľadaj tag..." value="{{ request('search') }}">
                         <button type="submit" class="btn btn-primary">Hľadať</button>

                     
                         @if(request('search'))
                          <a href="{{ url('tabulka') }}" class="btn btn-secondary ms-2">Zmazať tagy</a>
                         @endif
                        </form>
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
                        @php
                            $found = false;
                        @endphp
                        @foreach ($tabulkas as $tabulka)
                          @if (request('search'))
                            @if (Str::contains($tabulka->tags, request('search')))
                            @php
                                $found = true;
                            @endphp
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
                            @endif
                              @else
                              @php
                                  $found = true;
                              @endphp
                                <tr>
                                    <td>{{ $tabulka->id }}</td>
                                    <td>{!! $tabulka->name !!}</td>
                                    <td>{!! $tabulka->description !!}</td>
                                    <td>{!! $tabulka->status == 1 ? "&#9989; Dokončené" : "&#129001; Nedokončené" !!}</td>
                                    <td>
                                        <a href="{{ route('tabulka.edit', $tabulka->id) }}" class="btn btn-success">Uprav</a>
                                        <a href="{{ route('tabulka.show', $tabulka->id) }}" class="btn btn-info">Podrobnosti</a>
                                        <form action="{{ route('tabulka.destroy', $tabulka->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Odstráň</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @if (!$found)
                            <tr>
                                <td colspan="5" class="text-center">Žiadne úlohy neboli nájdené.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection