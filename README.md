# Pork Orders - Sistema di Gestione Ordini

Un'applicazione web moderna per la gestione degli ordini di carne ("pork orders"), costruita con **Laravel 11** e **Vue.js** tramite **Vite**. Il sistema permette di gestire clienti, prodotti e ordini con un'interfaccia intuitiva e API RESTful.

## 📋 Sommario

- [Descrizione del Progetto](#descrizione-del-progetto)
- [Architettura](#architettura)
- [Flusso dell'Applicazione](#flusso-dellapplicazione)
- [Modelli e Relazioni](#modelli-e-relazioni)
- [Setup del Progetto](#setup-del-progetto)
- [Utilizzo](#utilizzo)

---

## 📝 Descrizione del Progetto

**Pork Orders** è un sistema di gestione degli ordini che permette di:

- **Gestire Clienti**: Creare, modificare, visualizzare ed eliminare clienti con i loro dati (nome, cognome, email, telefono, indirizzo)
- **Gestire Prodotti**: Amministrare il catalogo dei prodotti disponibili
- **Gestire Ordini**: Creare ordini per i clienti, associare prodotti con quantità e prezzo, aggiungere note
- **Autenticazione**: Sistema di autenticazione sicuro per utenti amministratori
- **API RESTful**: Endpoint API per l'accesso ai dati da applicazioni terze

---

## 🏗️ Architettura

L'applicazione segue l'architettura **MVC (Model-View-Controller)** di Laravel, con separazione tra web interface e API.

```
┌─────────────────────────────────────────────┐
│         Frontend (Blade + Vue.js)           │
│    - Dashboard                              │
│    - Pagine Clienti, Prodotti, Ordini      │
│    - Pannello di Gestione                   │
└────────────────┬────────────────────────────┘
                 │ (HTTP Requests)
┌────────────────▼────────────────────────────┐
│         Laravel Application Core            │
├─────────────────────────────────────────────┤
│  Routes (web.php, api.php)                  │
│  ↓                                          │
│  Controllers                                │
│  ├─ Admin Controllers (ClientController,   │
│  │  OrderController, ProductController)    │
│  └─ API Controllers (per endpoint REST)    │
│  ↓                                          │
│  Models + Business Logic                    │
│  ├─ Client                                  │
│  ├─ Order                                   │
│  ├─ Product                                 │
│  └─ User                                    │
└────────────────┬────────────────────────────┘
                 │
┌────────────────▼────────────────────────────┐
│         Database Layer                      │
│  ├─ users_table                             │
│  ├─ clients_table                           │
│  ├─ products_table                          │
│  ├─ orders_table                            │
│  └─ order_product_table (Pivot)             │
└─────────────────────────────────────────────┘
```

### Struttura delle Cartelle

- **`app/Models/`** - Modelli Eloquent (Client, Order, Product, User)
- **`app/Http/Controllers/`** - Controller logici
  - `Admin/` - Controller per l'interfaccia web
  - `Api/` - Controller per gli endpoint API
- **`routes/`** - Definizione delle rotte
  - `web.php` - Rotte web (interfaccia utente)
  - `api.php` - Rotte API (endpoint REST)
- **`database/migrations/`** - Schema del database
- **`resources/views/`** - Template Blade per il rendering HTML
- **`resources/js/`** - Componenti Vue.js e JavaScript

---

## 🔄 Flusso dell'Applicazione

### 1. **Autenticazione**

```
Utente non autenticato
    ↓
Accede a login page (route /)
    ↓
Inserisce credenziali
    ↓
Sistema verifica le credenziali nella tabella users
    ↓
Se valide → Crea sessione autenticata
    ↓
Reindirizza a /dashboard
```

### 2. **Gestione Clienti**

```
Utente autenticato → Clicca "Clienti" (GET /clients)
    ↓
ClientController::index() → Recupera lista clienti dal DB
    ↓
Mostra lista in formato tabella (views/clients/index.blade.php)
    ↓
Azioni disponibili:
├─ Visualizza: GET /clients/{id}
├─ Crea: GET /clients/create → POST /clients
├─ Modifica: GET /clients/{id}/edit → PUT /clients/{id}
├─ Elimina: DELETE /clients/{id}
└─ Ricerca: GET /clients/search
```

### 3. **Gestione Prodotti**

```
Utente autenticato → Clicca "Prodotti" (GET /products)
    ↓
ProductController::index() → Recupera lista prodotti dal DB
    ↓
Mostra lista disponibile
    ↓
Azioni disponibili:
├─ Visualizza: GET /products/{id}
├─ Crea: GET /products/create → POST /products
├─ Modifica: GET /products/{id}/edit → PUT /products/{id}
└─ Elimina: DELETE /products/{id}
```

### 4. **Gestione Ordini**

```
Utente autenticato → Clicca "Ordini" (GET /orders)
    ↓
OrderController::index() → Recupera lista ordini dal DB
    ↓
Crea nuovo ordine:
    ├─ GET /orders/create → Mostra form
    ├─ POST /orders → Memorizza ordine
    ├─ Associa i prodotti alla tabella pivot (order_product)
    ├─ Salva quantità, prezzo e note
    └─ Reindirizza alla visualizzazione dell'ordine
    ↓
Azioni disponibili:
├─ Visualizza: GET /orders/{id} → Mostra dettagli + prodotti
├─ Modifica: GET /orders/{id}/edit → PUT /orders/{id}
└─ Elimina: DELETE /orders/{id}
```

### 5. **API REST**

```
Client esterno (es. app mobile) → Effettua richiesta API
    ↓
Endpoint disponibili:
├─ GET /api/products → Lista prodotti (JSON)
├─ GET /api/products/{id} → Dettagli prodotto
├─ GET /api/orders → Lista ordini
├─ GET /api/orders/{id} → Dettagli ordine
├─ POST /api/orders → Crea ordine (JSON)
├─ POST /api/login → Autenticazione API
└─ Tutte le risposte in formato JSON
    ↓
ApiOrderController, ApiProductController gestiscono le richieste
    ↓
Ritorna JSON response
```

---

## 🔗 Modelli e Relazioni

### **Client**
```php
- id (PK)
- name: string
- surname: string
- email: unique
- password: hashed
- phone: string
- address: string
- timestamps

Relazioni:
→ hasMany('Order')
```

### **Product**
```php
- id (PK)
- name: string
- description: text
- price: decimal
- timestamps

Relazioni:
→ belongsToMany('Order') tramite order_product
```

### **Order**
```php
- id (PK)
- client_id (FK)
- note: text (nullable)
- timestamps

Relazioni:
→ belongsTo('Client')
→ belongsToMany('Product') con pivot(quantity, price)
```

### **order_product (Tabella Pivot)**
```php
- order_id (FK)
- product_id (FK)
- quantity: integer
- price: decimal
```

### **User** (Amministratori)
```php
- id (PK)
- name: string
- email: unique
- password: hashed
- email_verified_at: timestamp
- timestamps
```

---

## 🚀 Setup del Progetto

### Prerequisiti
- PHP 8.2+
- Composer
- Node.js & npm/yarn
- Server web (Apache/Nginx)
- Database MySQL/PostgreSQL/SQLite

### Installazione

1. **Clonare il repository**
   ```bash
   git clone <repository-url>
   cd pork-orders
   ```

2. **Installare dipendenze PHP**
   ```bash
   composer install
   ```

3. **Installare dipendenze JavaScript**
   ```bash
   npm install
   ```

4. **Configurare l'ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurare il database** nel file `.env`
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pork_orders
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Eseguire le migrazioni**
   ```bash
   php artisan migrate
   ```

7. **Caricare i dati di seed (opzionale)**
   ```bash
   php artisan db:seed
   ```

8. **Avviare il server di sviluppo**
   ```bash
   php artisan serve
   npm run dev
   ```

9. **Accedere all'applicazione**
   - URL: `http://localhost:8000`
   - Usa un account di test dal seeder o registrati

---

## 📱 Utilizzo

### Interfaccia Web

1. **Autenticazione**: Effettua il login con le tue credenziali
2. **Dashboard**: Visualizza una panoramica del sistema
3. **Clienti**: Gestisci la lista dei clienti
4. **Prodotti**: Visualizza e gestisci il catalogo
5. **Ordini**: Crea e gestisci gli ordini dei clienti

### API RESTful

#### Endpoints Disponibili

**Prodotti**
```
GET /api/products                    # Lista tutti i prodotti
GET /api/products/{id}               # Dettagli di un prodotto
```

**Ordini**
```
GET /api/orders                      # Lista tutti gli ordini
GET /api/orders/{id}                 # Dettagli di un ordine
POST /api/orders                     # Crea un nuovo ordine
```

**Autenticazione**
```
POST /api/login                      # Effettua il login
```

#### Esempio di Richiesta API

```bash
# Recuperare lista prodotti
curl -X GET http://localhost:8000/api/products

# Creare un ordine
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{
    "client_id": 1,
    "products": [
      {"product_id": 1, "quantity": 5, "price": 50.00},
      {"product_id": 2, "quantity": 3, "price": 30.00}
    ],
    "note": "Consegna martedì"
  }'
```

---

## 🛠️ Tecnologie Utilizzate

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Vue.js
- **Build Tool**: Vite
- **Database**: MySQL (configurabile)
- **Authentication**: Laravel Sanctum
- **Testing**: PHPUnit

---

## 📄 Licenza

Progetto sviluppato per la gestione di ordini di carne. Tutti i diritti riservati.

---

## 👤 Autore

Sviluppato come sistema di gestione ordini personalizzato.

---

**Ultima modifica**: Maggio 2026
