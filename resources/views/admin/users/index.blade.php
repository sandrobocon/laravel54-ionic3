@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary('Novo Usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($users->items())->striped()
                ->callback('Ações', function($field, $user){
                    $linkEdit = route('admin.users.edit', ['user' => $user->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit);
                })
             !!}
        </div>
        {!! $users->links() !!}
    </div>
@endsection
