
## 🔗ShortURL

## 💬 Sobre o projeto
Encurtador de URL feito em PHP com armazenando em SQL e JSON com contabilização de acessos.

![Author - Julimar Junior](https://img.shields.io/badge/Author-Julimar%20Junior-blue?logo=github&url=https://github.com/JulimarJunior)

## 🚀 Atualizações
Acompanhe as atualizações que ocorreram anteriormente no **shortURL**.
| Data | Versão | Descrição |
|--|--|--|
| 24/03/2021 | 2.0 | Desenvolvimento do sistema com uso de classe e fácil configuração
| 22/02/2021 | 1.2 | Dados de URL e Ambiente de Testes
| 22/02/2021 | 1.1 | Ajustes de retornos
| 20/02/2021 | 1.0 | Base do projeto


## 👨‍💻 Instalação
Veja a pasta ```example``` no repositório para obter uma aplicação feita utilizando o shortURL já configurada.

1. Adicione o arquivo ```shortURL.php``` em seu projeto, junto ao arquivo ```.htaccess``` em uma pasta exclusiva para o encurtador de URL
> É necessário o uso do .htaccess para um funcionamento correto no redirecionamento ao abrir uma URL encurtada.
2. Inclua o arquivo em um ```index.php``` na pasta exclusiva e inicie a classe ```shortURL```.
> É recomendável utilizar o arquivo index.php para realizar o redirecionamento da URL encurtada. Para cria-la é necessário utilizar outro arquivo ou função separada.
```php
require_once('shortURL.php');
$short = new shortURL;
```
4. Configure os itens necessários utilizando as funções da classe para o funcionamento do sistema conforme descrito em **🧰 Configurações**.

## 🧰 Configurações
### Base
```php
// Define o tipo de conexão | padrão: json;
$short->type('mysql');
```
> Se o sistema for para alto uso, é recomendável que se utilize o type == 'mysql' para melhor performance.
```php
// Define os bytes de criação da URL personalizada - Padrão: 3;
$short->bytes(5);
```
```php
// Define os dados de conexão MYSQL | Obrigatório se type == 'mysql';
$db = array(
	'drive' 	=> 'mysql',
	'host' 		=> 'localhost',
	'name' 		=> 'db_shorturl',
	'user' 		=> 'root',
	'password' 	=> 'root',
);
$short->database($db);
```
> O SQL de criação do banco de dados pode ser encontrado em ```db_shorturl.sql``` no repositório.

### Criação
```php
// Define URL a ser encurtada;
$short->url('https://julimarjunior.com.br');
```
```php
// Define a URL encurtada personalizada | Opcional;
$short->custom('shortURL');
// Se não informado, será um valor aleatório baseado nos bytes;
```
```php
// Cria a URL encurtada;
$short->execute();
```

### Uso
```php
// Limpa a URL completa;
$short->clear('https://julimarjunior.com.br/shorturl');
// Retorna apenas o valor 'shorturl' para uso em outras funções
// Exemplo com URL atual: $short->clear($_SERVER["REQUEST_URI"]);
```
```php
// Obtém as informações da URL encurtada;
$short->infos('shorturl');
// Retorna a URL encurtada, URL origem, data de criação e quantidade de acessos;
// Exemplo de uso com clear(): $short->infos($short->clear($_SERVER["REQUEST_URI"]));
```
```php
// Define se ocorrerá o redirect automático | Padrão: false;
$short->redirect(true);
// Se for False, irá retornar a URL origem quando open() for executado;
```
```php
// Abre a URL origem a partir da URL encurtada;
$short->open('shorturl');
// Se for redirect == false, irá retornar a URL origem;
// Exemplo de uso com clear(): $short->open($short->clear($_SERVER["REQUEST_URI"]));
```

## 👋 Por fim (mas não menos importante)
O projeto **shortURL** é um repositório de código livre, qualquer um pode (caso deseje) fazer atualizações para seus respectivos sistemas e utiliza-lo.
