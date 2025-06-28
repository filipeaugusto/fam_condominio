# 🏢 Sistema de Gestão Condominial – Laravel + Filament

Este projeto visa gerenciar despesas, fechamento mensal e rateio por unidade em condomínios, com controle de acesso baseado em perfis.

---

## ⚙️ Tecnologias

- Laravel 11
- Filament v3
- Spatie Laravel Permission
- MySQL 8
- Livewire
- TailwindCSS

---

## 📁 Estrutura de Módulos

| Módulo               | Descrição                                                  |
|----------------------|------------------------------------------------------------|
| Condominium          | Cadastro dos condomínios                                   |
| Apartment            | Cadastro de apartamentos com fração individual             |
| User                 | Relacionado a Condomínio e controlado por Roles            |
| Expense              | Despesas fixas, variáveis e fundo de reserva               |
| MonthlyClosing       | Fechamento de contas com rateio por fração                 |
| ConsumptionCharge    | Controle individual por leitura (Ex: Gás)                  |

---

## 🔐 Perfis e Permissões

| Role              | Ações Permitidas                          |
|------------------|-------------------------------------------|
| admin            | Total, todos os condomínios               |
| syndic           | Consulta e acompanhamento do seu bloco   |
| financial_manager| Geração de fechamento                     |
| resident         | Apenas visualização (em breve)           |

---

## 🚀 Instalação

```bash
git clone <repo>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# Setup Shield
php artisan shield:setup [--fresh] [--minimal] [--tenant=]
# Install Shield for a panel
php artisan shield:install admin [--tenant]
# Generate permissions/policies
php artisan shield:generate [options]
# Create super admin
php artisan shield:super-admin [--user=] [--panel=] [--tenant=]
# Create seeder
php artisan shield:seeder [options]
# Publish Role Resource
php artisan shield:publish admin
