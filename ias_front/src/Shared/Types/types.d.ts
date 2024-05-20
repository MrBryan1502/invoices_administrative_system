import { AUTH_ACTION_TYPE } from "../Constants/constants"

interface ReducerParamsType<T, S> {
  type: T,
  payload: S
}

export type AuthActionType = typeof AUTH_ACTION_TYPE[keyof typeof AUTH_ACTION_TYPE]

export interface UserResponse {
  idUsuario: number,
  NombreUsuario: string,
  Email: string
}

export interface JWT {
  user: UserResponse
  exp: number
}