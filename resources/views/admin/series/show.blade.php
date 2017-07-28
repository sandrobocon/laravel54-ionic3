@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Dados serie</h3>
            <?php $iconEdit = Icon::create('pencil') ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.series.edit', ['series' => $series->id])) !!}
            <?php $iconDestroy = Icon::create('remove') ?>
            {!! Button::danger($iconDestroy)
                ->asLinkTo(route('admin.series.destroy', ['series' => $series->id]))
                ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'route' => ['admin.series.destroy', 'series' => $series->id],
                'method' => 'DELETE',
                'style' => 'display:none'
            ])?>
            {!! form($formDelete) !!}
            <br/><br/>
            <div class="row">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$series->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Título</th>
                        <td>{{$series->title}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Descrição</th>
                        <td>{{$series->description}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
