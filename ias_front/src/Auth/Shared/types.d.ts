import { LOGIN_ACTION_TYPE, VALIDATION_STATUS } from "./consts"

export type ValidationStatusType = typeof VALIDATION_STATUS[keyof typeof VALIDATION_STATUS]

export type ValidationReturnType = [
  status: ValidationStatusType,
  message?: string
]

export type LoginActionType = typeof LOGIN_ACTION_TYPE[keyof typeof LOGIN_ACTION_TYPE]

export interface AuthState {
  loggedIn: boolean
  login?: (user: UserLogin) => void
  logout?: () => void
  verifySession?: () => void
}

export interface UserLogin {
  Email: string,
  Password: string
}

export interface FetchLoginError {
  error: string,
  code: number
}

export interface FetchLoginResponse {
  message: string,
  token: string
}