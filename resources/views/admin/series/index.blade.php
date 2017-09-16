@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de series</h3>
            {!! Button::primary('Nova Serie')->asLinkTo(route('admin.series.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($series->items())->striped()
                ->callback('Descrição', function($field, $serie) {
                    return MediaObject::withContents(
                        [
                            'image' => $serie->thumb_small_asset,
                            'link' => '#',
                            'heading' => $serie->title,
                            'body' => $serie->description
                        ]
                    );
                })
                ->callback('Ações', function($field, $serie){
                    $linkEdit = route('admin.series.edit', ['serie' => $serie->id]);
                    $linkShow = route('admin.series.show', ['serie' => $serie->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                        Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })
             !!}
        </div>
        {!! $series->links() !!}
    </div>
@endsection

@push('styles')
<style type="text/css">
    .media-body {
        width: 400px;
    }
</style>
@endpush