# Projeto

Projeto desenvolvindo com o framework Laravel.

## Características

- Arquitetura MVC
- Blade template engine
- Comando Artisan
- Cache
- Eloquent ORM
- Autenticação
- Fila assíncrona
- Paginação automática
- Database migration e seeding

## Conhecimentos Requeridos

- PHP básico
- PHP OO (classes, heranças, constructor, métodos)
- Composer (gerenciador de pacotes)
- PHP, MySQL, Apache/Nginx

## MVC

A arquitetura MVC (Model-View-Controller) é um padrão de projeto amplamente utilizado no desenvolvimento de aplicativos web e software. Ele divide a aplicação em três camadas: a camada Model (modelo), responsável por gerenciar os dados e a lógica de negócios, incluindo a comunicação com o banco de dados; a camada View (visão), responsável por exibir os dados e interagir com o usuário, incluindo a comunicação com a interface gráfica do usuário (GUI); e a camada Controller (controlador), responsável por intermediar a comunicação entre o modelo e a visão, manipulando as solicitações do usuário e gerenciando a lógica de controle da aplicação.

Em resumo, o Model representa o estado e o comportamento dos dados da aplicação, a View representa a apresentação visual dos dados para o usuário, e o Controller gerencia a interação entre as duas camadas, além de fornecer a lógica de controle para a aplicação. Essa separação clara de responsabilidades torna a arquitetura MVC flexível, escalável e fácil de manter.

## Ambiente de desenvolvimento
- Linux Ubuntu 22.04.2 LTS
- Apache 2.4.52
- MySQL 8.0.32
- PHP 8.1.2
- Laravel 10

## Instação do Laravel
```
composer create-project laravel/laravel example-app

cd example-app
```
## Executar a aplicação
```
php artisan server
```
## Comando artisan
criando um template controller :
```
php artisan make:controller UserController
```
criando um template model :
```
php artisan make:model User
```

## Criando rotas
Na pasta raiz do projeto acessar o diretório routes e abrir o arquivo web.php e adicionar a rota :
- Rota simples
```
Route::get('/hello-world', function () {
    return [
       'name' => 'jon snow'
    ];
});
```
para acesse a rota no seu browser "http://localhost:8000/hello-world"

- Grupos de rotas
```
Route::prefix('usuarios')->group(function(){
    Route::get("", function(){
        return 'Usuários';
    })->name('usuarios');

    Route::get("/{id}", function($id){
        return 'Mostrar detalhes: '. $id;
    })->name('usuarios.show');

    Route::get("/{id}/tags", function($id){
        return 'Tags usuário: '. $id;
    })->name('usuarios-tags');
});
```
- Retornar usuário pelo id passado na rota
```
Route::get('/user/{user}', function (App\Models\User $user) {
    return $user;
});
```
- Retornar usuário pelo email passado na rota
```
Route::get('/user/{user:email}', function (App\Models\User $user) {
    return $user;
});
```

## Migration
- Migrando o banco de dados
```
php artisan migrate --seed
```
- Executando a migration
```
php artisan migrate
```
- Voltar a migration
```
php artisan migrate:rollback
```
- Criando uma nova tabela
```
php artisan make:migration create_posts_table
```
- Adicionar uma nova coluna a tabela
```
php artisan make:migration add_cover_to_posts_table
```

## Blade Template 
- Definindo uma variável no UserController
```
    public function show() {
        return view('user', [
            'var' => 'definindo a variavel',
        ]);
    }
```
- Usando a variável no blade template na view user
```
{{ $var }}
```
- Usando funções nativas do php no blade template
```
{{ date('d/m/y') }}
```
- Declarando variáveis no blade template
```
@php
    $total = 80;
    $array = [];
    $boolean = true;
@endphp
```
- Usando confições no blade template
```
@unless ($boolean)
    Falso    
@endunless

@if ($boolean)
    True  
@endif

@empty($array)
    O array está vazio jovem !
@endempty

@if($total > 100)
    Muito caro
@elseif ($total > 80)
    tá ok
@elseif ($total > 50)
    tá barato
@endif
```
- Definindo uma coleção no UserControllers
```
    public function index() {
        $users = User::all();
        return view('users', [
            'users' => $users,
        ]);
    }
```
- Usando loop no blade template
```
@foreach ($users as $user )
    {{ $user->name }} <br />
@endforeach
```
## Models
- criando uma model
```
php artisan make:model Post
```
- criando uma model com migration
```
php artisan make:model Files --migration
```
- criando uma model com migration, controller e factory
```
php artisan make:model Business --migration --controller --factory
```

## Factory
- criando uma factory
```
php artisan make:factory TesteFactory
```

## Eloquent
- criando elemento 
```
$businesses = Business::create([
    'name' => 'Jon',
    'email' => 'Snow',
    'address' => 'snow@jon.com'
]);
```
- pegando toda a coleção de dados
```
$businesses = Business::all();
```
- pegando apenas um elemento da coleção
```
$business = Business::find(1);
```
- usando o where para pegar um elemento da coleção 
```
$businessWhere = Business::where('name', 'Ernser-Murphy')->get();

$businessWhereFirst = Business::where('name', 'Ernser-Murphy')->first();
```
- Atualizando o elementos de uma coleção
```
$businesses = Business::find(3)->update([
        'name' => 'Jon',
        'email' => 'adasd@asda',
    ]);
```
```
$businesses = Business::find(3);
$businesses->name = 'Tiago';
$businesses->email = 'tiago@laravel9.com';
$businesses->address = 'Quadra C rua B';
$businesses->save();
```
```
$input = [
    'name' => 'Jon 2',
    'email' => 'asda@1adsd2.com'
];

$businesses = Business::find(3);
$businesses->fill($input);
$businesses->save();
```
- remover um item da coleção
```
$businesses =  Business::find(4);
$businesses->delete();
```
## Relacionamento 
- Na migration posts adicionar a chave estrangeira de user_id
```
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')
        ->constrained()
        ->onDelete('CASCADE')
        ->onUpdate('CASCADE');
});
```
- De 1 para N na model Users
```
public function posts() {
    return $this->hasMany(Post::class);
}
```
- De N para 1 na model Posts
```
public function user() {
    return $this->belongsTo(User::class);
}
```
- De N para N na model User
```
public function teams() {
    return $this->belongsToMany(Team::class);
}
- De N para N na model Team
```
public function users() {
    return $this->belongsToMany(User::class);
}
- linka um usuario a um team
```
$user->teams()->attach([1,2]);
$user->teams()->sync([2,3]);
$user->teams()->sync([1,3]);
$user->teams()->sync([1,3]);
$user->teams()->syncWithoutDetaching([2]);
$user->teams()->detach([2]);
$user->teams()->detach([1,3]);
```
- Caregar a relação no controllers
```
$post->load('user');
```
- Caregar a relação pela model
```
protected $with = ['user'];
```