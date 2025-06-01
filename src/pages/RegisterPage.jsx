import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import InputField from '../components/InputField'
import Button from '../components/Button'
import '../css/AuthForm.css'

export default function RegisterPage() {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [email, setEmail] = useState('')
  const [error, setError] = useState('')
  const [success, setSuccess] = useState('')
  const navigate = useNavigate()

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError('')
    setSuccess('')
    const res = await fetch('/api/register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username, password, email }),
    })
    const data = await res.json()
    if (data.success) {
      setSuccess('Registrasi berhasil! Silakan login.')
      setTimeout(() => navigate('/'), 1500)
    } else {
      setError(data.message)
    }
  }

  return (
    <div className='auth-container'>
      <h2>Register</h2>
      <form onSubmit={handleSubmit}>
        <InputField
          type="text"
          placeholder="Username"
          value={username}
          onChange={e => setUsername(e.target.value)}
          required
        />
        <InputField
          type="email"
          placeholder="Email"
          value={email}
          onChange={e => setEmail(e.target.value)}
          required
        />
        <InputField
          type="password"
          placeholder="Password"
          value={password}
          onChange={e => setPassword(e.target.value)}
          required
        />
        <Button type="submit">Register</Button>
      </form>
      {error && <p style={{color:'red'}}>{error}</p>}
      {success && <p style={{color:'green'}}>{success}</p>}
      <p>
        Sudah punya akun? <Link to="/">Login</Link>
      </p>
    </div>
  )
}