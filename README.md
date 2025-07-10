# bairr.online

Aplicação web dinâmica voltada à divulgação de serviços prestados por moradores da cidade de Campo Grande/MS. O projeto permite que qualquer usuário cadastre um serviço local, exibindo suas informações publicamente e disponibilizando um botão de contato direto via WhatsApp.

Este sistema foi desenvolvido como parte do Projeto Integrador para o curso Superior Tedcnólogo em Tecnologia da Informação.

Funcionalidades:

- Cadastro de serviço com nome, telefone, endereço e área de atuação.
- Armazenamento em banco de dados MySQL com estrutura relacional.
- Exibição dinâmica dos serviços em cards responsivos com JavaScript.
- Botão de contato direto via WhatsApp para cada serviço exibido.
- Modal de confirmação visual após cadastro bem-sucedido.
- Responsividade com Bootstrap 5 para desktop e dispositivos móveis.
- Estrutura modular separada por responsabilidades.

Tecnologias utilizadas:

- HTML5 – estrutura semântica.
- CSS3 + Bootstrap 5 – estilização responsiva com framework moderno.
- JavaScript (Fetch API) – consumo assíncrono do backend.
- PHP (MySQLi) – lógica backend e conexão com banco.
- MySQL – armazenamento dos dados com chave estrangeira e integridade referencial.

Estrutura de arquivos:

- index.html – página principal do projeto.
- css/style.css – estilos personalizados.
- js/script.js – exibição dinâmica dos serviços.
- img/logo.png – logo do projeto.
- cadastrar.php – gravação dos dados no banco.
- listar.php – retorno de dados em formato JSON.
- conexao.php – conexão com MySQL.
- README.md – documentação do projeto.

Estrutura do banco de dados (MySQL):

Tabela `usuarios`:
- id (INT, chave primária, auto incremento)
- nome (VARCHAR 100)
- telefone (VARCHAR 20)
- endereco (VARCHAR 150)

Tabela `servicos`:
- id (INT, chave primária, auto incremento)
- usuario_id (INT, chave estrangeira referenciando usuários)
- nome_servico (VARCHAR 100)

Acesso online: https://bairr.online
