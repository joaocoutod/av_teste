### Passo a passo
Clone Repositório
```sh
git clone https://github.com/joaocoutod/av_teste.git

```
```sh
cd my-project/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env (opcional)
```dosini
APP_NAME=Dev_teste

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=av_teste
DB_USERNAME=root
DB_PASSWORD=root

```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Suba as migrates
```sh
php artisan migrate
```

Acesse o projeto
[http://127.0.0.1:8000]


<hr>

### Lista de Clientes (ler, criar, editar e exclui)
<img width="100%" src="" alte="lista">


### Adicionar novo cliente
<img width="100%" src="" alte="add">

<hr>

### Botão de ver menssagem
<img width="100%" src="" alte="edit">


### Botão de editar cliente
<img width="100%" src="" alte="clinetes">

<hr>

### Botão de excluir cliente
<img width="100%" src="" alte="del">

