const APP_ENV = 'dev'

const API_BASE = APP_ENV === 'dev' ? 'http://localhost:8000/public/api' : 'https://domain.com/api'

export const API_LOGIN = `${API_BASE}/login`

export const API_CONEXIONES = `${API_BASE}/conexiones`