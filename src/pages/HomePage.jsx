import { Link } from 'react-router-dom'
import '../css/HomePage.css'

export default function HomePage() {
  return (
    <div className='home-container'>
      <h2>Selamat Datang di HomePage!</h2>
      <p>Ini adalah halaman utama setelah login.</p>
      <Link to="/">Logout</Link>
    </div>
  )
}