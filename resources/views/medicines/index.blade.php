@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <a href="{{ route('medicines.create') }}" class="btn form-control btn-success">Создать</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Препараты</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Фото</th>
                                <th>Производитель</th>
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicines as $medicine)
                                <tr>
                                    <td>{{ $medicine->name }}</td>
                                    <td>{{ $medicine->description }}</td>
                                    <td><img class="img img-thumbnail" style="max-width: 30%" src="{{ $medicine->image ? Storage::url($medicine->image) : '' }}" alt=""></td>
                                    <td>{{ $medicine->manufacturer->name }}</td>
                                    <td>{{ $medicine->category->name }}</td>
                                    <td>
                                        <v-buttons
                                            edit="{{ route('medicines.edit', ['id' => $medicine->id]) }}"
                                            delete="{{ route('medicines.destroy', ['id' => $medicine->id]) }}"
                                        ></v-buttons>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>записей нет</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
