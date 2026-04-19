# 💍 Lista de Presentes - Guia GitHub Pages

## 🚀 Visão Geral

Este projeto usa **IndexedDB** (nativo do navegador) para persistência robusta dos dados. Funciona perfeitamente em GitHub Pages sem qualquer dependência externa.

### ✨ Características

✅ **Persistência local robusta** - IndexedDB (muito mais seguro que localStorage)
✅ **Sem servidor necessário** - Funciona em GitHub Pages puro
✅ **Exportar/Importar** - Compartilhe dados via arquivo JSON
✅ **Sincronização automática** - Se usar servidor local, sincroniza entre usuários
✅ **Responsivo** - Perfeito para mobile
✅ **Modo offline** - Funciona sem internet

---

## 📋 Como Usar

### Opção 1: GitHub Pages (Recomendado)

1. **Fazer upload para GitHub Pages:**
   - Copie o arquivo `index.html` para seu repositório GitHub
   - Ative GitHub Pages nas configurações do repositório
   - Acesse via: `https://seu-usuario.github.io/seu-repositorio`

2. **Compartilhar dados entre pessoas:**
   - Uma pessoa cria a lista e adiciona itens
   - Clica em **📥 Exportar** para baixar o arquivo JSON
   - Compartilha o arquivo com outras pessoas
   - Cada pessoa clica em **📤 Importar** para carregar a lista

⚠️ **Limitação:** Cada pessoa verá dados locais dela. Para sincronização automática em tempo real, veja Opção 2.

---

### Opção 2: Servidor Local (Sincronização em tempo real)

Se você quer que **múltiplos usuários na mesma rede vejam as mudanças em tempo real**:

#### Com Python 3:
```bash
python -m http.server 8000
```

#### Com Python 2:
```bash
python -m SimpleHTTPServer 8000
```

#### Com Node.js:
```bash
npx http-server -p 8000
```

Depois acesse: `http://localhost:8000`

**Compartilhe com outros na rede local:**
- Descubra seu IP: `ipconfig` (Windows) ou `ifconfig` (Mac/Linux)
- Outros acessem: `http://[SEU_IP]:8000`

Exemplo: `http://192.168.1.100:8000`

---

## 💾 Como Funciona a Persistência

### IndexedDB (Nativo do Navegador)

- ✅ Persiste entre recarregar página
- ✅ Persiste entre fechar/abrir navegador
- ✅ Mais seguro e rápido que localStorage
- ✅ Suporta muito mais dados (~50MB)

---

## 🔄 Sincronização de Dados

### Cenário 1: GitHub Pages (Sem sincronização automática)

Pessoa A exporta → Compartilha arquivo → Pessoa B importa

### Cenário 2: Servidor Local (Com sincronização a cada 3s)

Todos na mesma rede veem mudanças em tempo real

---

## 📦 Arquivos Incluídos

- **index.html** - Página completa em um arquivo único
- **SETUP_GITHUB_PAGES.md** - Este guia

---

## 🚀 Para Usar em GitHub Pages

1. **Crie um repositório no GitHub**
2. **Faça upload do index.html**
3. **Ative GitHub Pages** em Settings → Pages
4. **Pronto!** Acesse via `https://seu-usuario.github.io/repo-name`

---

## 🔐 Senha para Deletar

**Padrão:** `1997`

---

## 📱 Comportamento

- ✅ Totalmente responsivo (mobile, tablet, desktop)
- ✅ Funciona offline
- ✅ Sincronização automática em servidor local
- ✅ Import/Export para compartilhamento manual

---

**Criado com ❤️ para facilitar sua lista de casamento**
