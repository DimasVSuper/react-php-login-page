import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import InputField from '../components/InputField'
import Button from '../components/Button'
import '../css/AuthForm.css'

export default function LoginPage() {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState('')
  const navigate = useNavigate()

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError('')
    const res = await fetch('/api/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username, password }),
    })
    const data = await res.json()
    if (data.success) {
      navigate('/home')
    } else {
      setError(data.message)
    }
  }

  return (
    <div className='auth-container'>
      <h2>Login</h2>
      <form onSubmit={handleSubmit}>
        <InputField
          type="text"
          value={username}
          onChange={e => setUsername(e.target.value)}
          placeholder="Username"
          required
        />
        <InputField
          type="password"
          value={password}
          onChange={e => setPassword(e.target.value)}
          placeholder="Password"
          required
        />
        <Button type="submit">Login</Button>
      </form>
      {error && <p style={{color:'red'}}>{error}</p>}
      <p>
        Belum punya akun? <Link to="/register">Register</Link>
      </p>
    </div>
  )
}