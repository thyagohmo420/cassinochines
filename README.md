# 🎰 VIPERPRO - Plataforma de Casino Online

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green?logo=vue.js)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)

Plataforma completa de casino online (iGaming) com sistema de carteira, afiliados, VIP, missões e múltiplos gateways de pagamento.

---

## 🚀 INÍCIO RÁPIDO

### Para Deploy no Hostinger

👉 **Siga o guia completo**: [GUIA_DEPLOY_HOSTINGER.md](GUIA_DEPLOY_HOSTINGER.md)

### Requisitos

- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js 16+

### Instalação Local

```bash
# 1. Instalar dependências
composer install
npm install

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate
php artisan jwt:secret

# 3. Configurar banco de dados no .env
# DB_DATABASE=seu_banco
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha

# 4. Executar migrations
php artisan migrate

# 5. Criar link do storage
php artisan storage:link

# 6. Compilar assets
npm run build

# 7. Iniciar servidor
php artisan serve
```

---

## 📚 Documentação Completa

- 📖 **[Guia de Deploy - Hostinger](GUIA_DEPLOY_HOSTINGER.md)** - Deploy passo a passo
- 💳 **[Configuração de Gateways](CONFIGURACAO_GATEWAYS.md)** - Stripe, PIX, MercadoPago, etc.
- 🗄️ **[Exportar Banco de Dados](EXPORT_DATABASE.md)** - Como fazer backup do SQL

---

## ✨ Principais Características

### 🎮 Gaming
- 12+ jogos de casino (slots, cartas)
- Integração com múltiplos provedores
- Sistema de favoritos e categorias

### 💰 Pagamentos
- Múltiplos gateways: Stripe, PIX, MercadoPago
- Depósitos e saques automáticos
- Sistema de carteira digital

### 👥 Usuários
- Registro/Login tradicional e social
- Sistema VIP com níveis
- Programa de afiliados completo

### 🛠️ Admin
- Painel completo (Filament 3.1)
- Gestão de usuários e jogos
- Relatórios financeiros
- Aprovação de saques

---

## 🛠️ Stack Tecnológico

**Backend**: Laravel 10 + PHP 8.1 + MySQL
**Frontend**: Vue 3 + Vite + Tailwind CSS
**Admin**: Filament 3.1
**Auth**: JWT + Sanctum
**Real-time**: Pusher + WebSockets

---

## 📦 O que você precisa configurar

### 1. Arquivo .env

Edite o `.env` com suas configurações:

```env
# Aplicação
APP_URL=https://seudominio.com
APP_DEBUG=false

# Banco de Dados
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# Gateway de Pagamento (escolha um)
STRIPE_KEY=sua_chave
STRIPE_SECRET=seu_secret

# OU

SUITPAY_CLIENT_ID=seu_client_id
SUITPAY_CLIENT_SECRET=seu_secret
```

### 2. Criar Usuário Admin

```bash
php artisan tinker
```

```php
$user = new App\Models\User;
$user->name = 'Admin';
$user->email = 'admin@exemplo.com';
$user->password = bcrypt('senha_segura');
$user->email_verified_at = now();
$user->save();
$user->assignRole('admin');
```

Acesse: `/admin`

---

## ⚠️ IMPORTANTE - Deploy

Ao fazer deploy, lembre-se de:

✅ Subir a pasta **storage/** completa
✅ Configurar o arquivo **.env** com suas credenciais
✅ Configurar o **Document Root** para `/public/`
✅ Executar as **migrations** (`php artisan migrate --force`)
✅ Criar o **storage link** (`php artisan storage:link`)
✅ Configurar **permissões** (775) em storage/ e bootstrap/cache/
✅ Compilar os **assets** (`npm run build`)
✅ Configurar o **gateway de pagamento**

---

## 🔐 Segurança

- Use **HTTPS** em produção (obrigatório)
- Mantenha **APP_DEBUG=false** em produção
- Use **senhas fortes**
- Configure **backups automáticos**
- Nunca exponha o arquivo **.env**

---

## 🐛 Problemas Comuns

### Erro 500
```bash
# Ver o erro
APP_DEBUG=true

# Corrigir e desabilitar debug
APP_DEBUG=false
```

### Permissões
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Limpar Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## ⚖️ Aviso Legal

⚠️ Este software é para fins educacionais. Você é responsável por verificar a legalidade de operar jogos de azar online em sua jurisdição e obter as licenças necessárias. Consulte um advogado especializado.

---

## 📞 Suporte

Para ajuda com deploy ou configuração:

- 📖 Leia a documentação completa em `GUIA_DEPLOY_HOSTINGER.md`
- 💳 Veja como configurar pagamentos em `CONFIGURACAO_GATEWAYS.md`
- 🐛 Reporte bugs via Issues

---

**Desenvolvido com ❤️ | Versão 1.0.0 | Janeiro 2026**

🚀 **Boa sorte com seu casino online!**
