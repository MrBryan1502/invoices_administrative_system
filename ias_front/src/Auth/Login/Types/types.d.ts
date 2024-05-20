export interface LoginReducerState {
  emailError?: string
  passwordError?: string
  emailValue?: string
  passwordValue?: string
  setInvalidEmailError?: (error: string) => void
  clearInvalidEmailError?: () => void
  setInvalidPasswordError?: (error: string) => void
  clearInvalidPasswordError?: () => void
  setEmailValue?: (value: string) => void
  setPasswordValue?: (value: string) => void
}

export interface LoginFetchSuccess {
  message: string,
  token: string
}

export interface LoginFetchError {
  error: string,
  code: number
}

export interface UseEmail {
  handleChange: (event: React.ChangeEvent<HTMLInputElement>) => void,
  handleBlur: (event: React.FocusEvent<HTMLInputElement>) => void,
  setError: React.Dispatch<React.SetStateAction<string>>,
  error: string,
  email: string
}

export interface UsePassword {
  handleChange: (event: React.ChangeEvent<HTMLInputElement>) => void,
  handleBlur: (event: React.FocusEvent<HTMLInputElement>) => void,
  setError: React.Dispatch<React.SetStateAction<string>>,
  error: string,
  password: string
}

interface Token {
  user: User,
  exp: number
}

interface User {
  idUsuario: number,
  Nombre: string,
  Email: string,
  Activo: bool
}