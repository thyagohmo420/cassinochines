# 📦 Como Exportar o Banco de Dados

## Método 1: Usando Laravel (Recomendado)

Este método exporta a estrutura do banco de dados através das migrations do Laravel.

### Passo 1: Exportar apenas a estrutura (schema)
```bash
php artisan schema:dump

# Ou para MySQL específico:
php artisan schema:dump --database=mysql
```

### Passo 2: Gerar o SQL das migrations
```bash
# Execute este comando para criar as tabelas
php artisan migrate --pretend > database_schema.sql
```

## Método 2: Usando mysqldump (Terminal)

Se você tiver acesso ao terminal do servidor:

```bash
# Exportar estrutura + dados
mysqldump -u seu_usuario -p seu_banco_de_dados > backup_completo.sql

# Exportar apenas estrutura (sem dados)
mysqldump -u seu_usuario -p --no-data seu_banco_de_dados > estrutura.sql

# Exportar apenas dados (sem estrutura)
mysqldump -u seu_usuario -p --no-create-info seu_banco_de_dados > dados.sql
```

## Método 3: Usando phpMyAdmin (Mais Fácil)

1. Acesse o phpMyAdmin no seu servidor atual
2. Selecione o banco de dados do projeto
3. Clique na aba **"Exportar"**
4. Escolha o método:
   - **Rápido**: Export básico
   - **Personalizado**: Mais opções
5. Formato: **SQL**
6. Clique em **"Executar"**
7. O arquivo `.sql` será baixado

### Configurações Recomendadas (Exportação Personalizada):
- ✅ Estrutura: Marque todas as opções
- ✅ Dados: Marque "INSERT"
- ✅ Adicionar DROP TABLE
- ✅ Adicionar IF NOT EXISTS
- ✅ Exportar conteúdo de tabelas
- ❌ Desmarque "Adicionar AUTO_INCREMENT"

## Método 4: Criar SQL a partir das Migrations

Como o projeto já tem 71 migrations, você pode simplesmente:

1. **No servidor Hostinger**, após upload dos arquivos:
2. Configure o `.env` com os dados do MySQL
3. Execute:
```bash
php artisan migrate --force
```

Isso criará todas as tabelas automaticamente!

## 📋 Checklist Antes de Exportar

- [ ] Backup do banco de dados atual
- [ ] Verificar se todas as tabelas foram criadas
- [ ] Verificar se há dados importantes a serem exportados
- [ ] Testar o arquivo SQL em um ambiente local antes de importar

## 🚀 Para o Hostinger

**RECOMENDAÇÃO**: Use o **Método 4** (migrations) pois é mais seguro e automático.

Se preferir usar um SQL:
1. Exporte usando phpMyAdmin (Método 3)
2. No Hostinger, acesse phpMyAdmin
3. Selecione o banco de dados
4. Clique em "Importar"
5. Escolha o arquivo `.sql`
6. Clique em "Executar"

## ⚠️ IMPORTANTE

- O arquivo `.sql` pode ser grande (vários MB)
- O Hostinger tem limite de upload no phpMyAdmin (geralmente 50-128MB)
- Se o arquivo for muito grande, divida em partes ou use o método de migrations
- **SEMPRE faça backup antes de importar**

## 🔧 Solução de Problemas

### Erro: "Packet too large"
```sql
SET GLOBAL max_allowed_packet=1073741824;
```

### Erro: "Import timeout"
- Divida o SQL em arquivos menores
- Ou use o terminal SSH se disponível

### Erro de charset/collation
No início do seu arquivo SQL, adicione:
```sql
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
```
