@extends('layouts.app')
@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('medicines.index') }}">Список медикаментов</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ isset($data) ? 'Редактировать' : 'Создать' }}</li>
                    </ol>
                </nav>
                <v-form name_="{{ $data->name ?? '' }}"
                        description_="{{ $data->description ?? '' }}"
                        image_="{{ $data->image ?? '' }}"
                        category_id_="{{ $data->category_id ?? '' }}"
                        manufacturer_id_="{{ $data->manufacturer_id ?? '' }}"
                        id_="{{ $data->id ?? '' }}"
                        :categories_="{{ $categories->toJson() }}"
                        :manufacturers_="{{ $manufacturers->toJson() }}"
                >

                </v-form>

            </div>
        </div>
    </div>

@endsection
