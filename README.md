# 💍 Lista de Presentes - Backend PostgreSQL

## 🚀 Visão Geral

Sistema de lista de presentes que usa **PHP + PostgreSQL** para compartilhar dados entre múltiplos navegadores/usuários. O banco é criado automaticamente na primeira execução!

### ✨ Características

✅ **Múltiplos usuários** - Todos veem o mesmo banco de dados em tempo real
✅ **Sem Node.js** - Usa apenas PHP (suportado em praticamente todo hosting)
✅ **PostgreSQL automático** - Banco criado automaticamente na primeira requisição
✅ **API RESTful** - Frontend + Backend separados
✅ **Exportar/Importar com Senha** - Segurança e flexibilidade
✅ **Responsivo** - Funciona em desktop e mobile
✅ **Modo offline** - Fetch dos dados a cada carregamento

---

## 📋 Pré-requisitos

- **PHP 7.0+** (com suporte a PostgreSQL)
- **PostgreSQL 10+**
- Um servidor web (Apache, Nginx, etc.)

---

## 🔧 Instalação

### 1. Preparar o Servidor

#### Local (Windows/Mac/Linux)

Se você já tem Apache + PHP + PostgreSQL instalados:

1. Copie todos os arquivos para a pasta do seu servidor web
   - Windows XAMPP: `C:\xampp\htdocs\lista-presentes`
   - Mac/Linux: `/var/www/html/lista-presentes`

2. Inicie Apache e PostgreSQL

3. Acesse: `http://localhost/lista-presentes`

#### Hosting Online

Se você tem hosting PHP compartilhado:

1. Upload dos arquivos via FTP/SFTP para a pasta `public_html`
2. Solicitar ao provedor que crie um banco PostgreSQL
3. Atualizar `.env` com credenciais do banco
4. Pronto! Acesse seu domínio

---

## ⚙️ Configuração

### Arquivo `.env`

```ini
DATABASE_URL=postgresql://user:password@host:5432/database_name
DELETE_PASSWORD=1997
PORT=3000
```

**DATABASE_URL** - Formato: `postgresql://usuário:senha@host:porta/banco`

Exemplo para Supabase:
```
DATABASE_URL=postgresql://postgres:sua_senha@db.seu_proyecto.supabase.co:5432/postgres
```

---

## 🚀 Como Usar

### Localmente

```bash
# Abrir o arquivo no navegador
# http://localhost/lista-presentes

# Ou se usando Python como server
python -m http.server 8000

# Ou se usando PHP built-in
php -S localhost:8000
```

### Online (GitHub Pages + Backend)

1. Backend hospedado em servidor com PHP + PostgreSQL
2. Frontend em GitHub Pages ou como arquivo único
3. Frontend faz requisições `fetch` para o backend

**Exemplo de requisição:**
```javascript
fetch('https://seu-backend.com/api/items.php')
    .then(res => res.json())
    .then(data => console.log(data.data))
```

---

## 📁 Estrutura de Arquivos

```
/
├── index.html              # Frontend (tudo em um arquivo)
├── .env                    # Configurações (não colocar no Git)
├── .env.example            # Exemplo de .env
├── api/
│   ├── config.php          # Configurações e conexão BD
│   ├── init.php            # Inicialização automática do banco
│   ├── items.php           # CRUD de itens
│   ├── people.php          # CRUD de pessoas
│   └── export.php          # Exportar/Importar dados
└── README.md               # Este arquivo
```

---

## 🔐 Segurança

### Senha de Deleção/Exportação

A senha padrão é `1997`. Mude no `.env`:

```ini
DELETE_PASSWORD=senha_super_segura_aqui
```

### Proteção CORS

O servidor está configurado para aceitar requisições de qualquer origem. Para restringir:

**Em `api/config.php`:**
```php
header('Access-Control-Allow-Origin: https://seu-dominio.com');
```

### HTTPS

Sempre use HTTPS em produção! Solicite um certificado SSL ao seu provedor.

---

## 🗄️ Banco de Dados

### Automatização

Na primeira requisição, o script `init.php` cria automaticamente:
- Banco de dados (se não existir)
- Tabelas `items` e `people`
- Índices para performance
- Dados padrão

### Estrutura do Banco

```sql
-- Tabela de itens
CREATE TABLE items (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    emoji VARCHAR(10),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Tabela de pessoas
CREATE TABLE people (
    id SERIAL PRIMARY KEY,
    item_id INTEGER REFERENCES items(id) ON DELETE CASCADE,
    name VARCHAR(255),
    created_at TIMESTAMP,
    UNIQUE(item_id, name)
);
```

---

## 🔄 Sincronização

### Como Funciona

1. Frontend faz `fetch()` para `/api/items.php` quando carrega
2. Backend retorna todos os itens com suas pessoas
3. Qualquer mudança é enviada via POST/DELETE
4. Frontend atualiza a interface
5. Todos os navegadores veem os mesmos dados em tempo real

### Polling Automático

Você pode adicionar sincronização periódica no `index.html`:

```javascript
// Sincronizar a cada 5 segundos (opcional)
setInterval(() => fetchItems(), 5000);
```

---

## 📡 API Endpoints

### Items

```
GET    /api/items.php          - Listar todos os itens
POST   /api/items.php          - Criar novo item
DELETE /api/items.php/{id}     - Deletar item (requer senha)
GET    /api/items.php/{id}     - Obter item específico
```

### People

```
POST   /api/people.php         - Adicionar pessoa a um item
DELETE /api/people.php         - Remover pessoa
```

### Export/Import

```
POST   /api/export.php?action=export  - Exportar dados (JSON)
POST   /api/export.php?action=import  - Importar dados (JSON)
```

---

## 🐛 Troubleshooting

### Erro: "Connection refused"

- PostgreSQL não está rodando
- Credenciais incorretas no `.env`
- Host/porta incorretos

**Solução:**
```bash
# Verificar se PostgreSQL está rodando
psql --version

# Testar conexão
psql -h localhost -U postgres -d postgres
```

### Erro: "Operation not permitted"

- Permissões de arquivo incorretas
- Pasta `api/` precisa de permissões de escrita (para `.init_done`)

**Solução:**
```bash
chmod 755 api/
```

### Dados não sincronizam

- Verificar se o PHP pode conectar ao PostgreSQL
- Verificar CORS no navegador (console)
- Verificar se a API responde: `curl http://localhost/api/items.php`

---

## 📦 Deploy (Supabase)

### Usando PostgreSQL do Supabase

1. Crie conta em [supabase.com](https://supabase.com)
2. Crie um novo projeto
3. Vá em Settings → Database → Connection string
4. Copie a string "URI" (PostgreSQL)
5. Atualize `.env`:

```ini
DATABASE_URL=postgresql://postgres:SUA_SENHA@db.seu_projeto.supabase.co:5432/postgres
```

6. Upload dos arquivos para seu hosting PHP
7. Pronto! Tudo funciona automaticamente

---

## 📝 Licença

Projeto open-source. Use livremente!

---

## 💬 Suporte

Se encontrar problemas:

1. Verifique o `.env` está configurado corretamente
2. Confira os logs do PHP: `tail -f /var/log/php-errors.log`
3. Teste a conexão com o banco diretamente
4. Verifique CORS no console do navegador
