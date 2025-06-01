# React + PHP LoginPage 🚀

A simple authentication app using **React (Vite)** for the frontend and **PHP (XAMPP/MySQL)** for the backend.

---

## Deskripsi 📚

Projek ini dibuat untuk memahami **CORS** dan sebagai pembelajaran **React + PHP XAMPP Development**.

---

## Fitur ✨

- Register user baru (dengan validasi username & email unik)
- Login user
- Halaman Home setelah login
- Validasi dan pesan error responsif
- Navigasi antar halaman menggunakan **React Router**

---

## Struktur Folder 📁

```
loginpage/
├── api/                # Backend PHP API (login.php, register.php, controller, model, db.php)
├── src/                # Frontend React (pages, components, css, App.jsx, main.jsx)
├── dist/               # Hasil build React (untuk production)
├── index.html
├── vite.config.js
└── README.md
```

---

## Cara Development 🛠️

1. **Jalankan XAMPP/Apache**  
    Pastikan folder ini ada di `htdocs` dan Apache berjalan.

2. **Jalankan React Dev Server**  
    ```
    npm install
    npm run dev
    ```
    Frontend berjalan di `http://localhost:5173/`

3. **Proxy API**  
    Sudah diatur di `vite.config.js`:
    ```js
    server: {
      proxy: {
         '/api': 'http://localhost/loginpage'
      }
    }
    ```
    Sehingga request `/api/*` dari React akan diteruskan ke backend PHP.

---

## Cara Build & Deploy 🚢

1. **Build React**
    ```
    npm run build
    ```
    Hasil build ada di folder `dist`.

2. **Pindahkan hasil build ke XAMPP**
    - Copy isi folder `dist` ke `htdocs/loginpage/dist` atau langsung ke `htdocs/loginpage` jika ingin root.

3. **Akses di browser**
    ```
    http://localhost/loginpage/dist/
    ```
    atau
    ```
    http://localhost/loginpage/
    ```

4. **Tidak perlu proxy atau CORS di production**  
    Karena frontend dan backend sudah satu domain.

---

## Catatan 📝

- **CORS** hanya diperlukan saat development (karena port berbeda).
- **Session** belum digunakan, hanya autentikasi sederhana.
- Untuk proteksi halaman, tambahkan session/JWT sesuai kebutuhan.

---

## Database 🗄️

Contoh struktur tabel `users`:

```sql
CREATE TABLE users (
  id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Kontribusi 🤝

Silakan modifikasi dan kembangkan sesuai kebutuhan pembelajaran Anda!

---

## Author 👨‍💻

- Dimas
- GitHub Copilot

---

## Routing 🗺️

Aplikasi frontend menggunakan **React Router** untuk navigasi antar halaman:
- `/` atau `/login` untuk halaman login
- `/register` untuk halaman registrasi
- `/home` untuk halaman utama setelah login

Semua pengaturan routing terdapat di file `src/App.jsx`.

