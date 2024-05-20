import { createContext, useMemo, useReducer } from "react";
import { LoginActionType } from "../../Shared/types";
import { LOGIN_ACTION_TYPE } from "../../Shared/consts";
import { LoginReducerState } from "../Types/types";
import { ReducerParamsType } from "../../../Shared/Types/types";

interface LoginProviderProps {
  children: React.ReactNode
}

const initialLoginState: LoginReducerState = {
  emailError: undefined,
  passwordError: undefined,
  emailValue: undefined,
  passwordValue: undefined
}

const loginReducer = (state: LoginReducerState, { type, payload }: ReducerParamsType<LoginActionType, string | undefined>) => {
  switch (type) {
    case LOGIN_ACTION_TYPE.SET_EMAIL_ERROR:
      return { ...state, emailError: payload }
    case LOGIN_ACTION_TYPE.SET_PASSWORD_ERROR:
      return { ...state, passwordError: payload }
    case LOGIN_ACTION_TYPE.SET_EMAIL_VALUE:
      return { ...state, emailValue: payload }
    case LOGIN_ACTION_TYPE.SET_PASSWORD_VALUE:
      return { ...state, passwordValue: payload }
    default:
      return state
  }
}

export const LoginContext = createContext<LoginReducerState>(initialLoginState)

export function LoginProvider({ children }: LoginProviderProps) {

  const [state, distpatch] = useReducer(loginReducer, initialLoginState)

  const setInvalidEmailError = (error: string) => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_EMAIL_ERROR,
      payload: error
    })
  }

  const clearInvalidEmailError = () => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_EMAIL_ERROR,
      payload: undefined
    })
  }

  const setInvalidPasswordError = (error: string) => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_PASSWORD_ERROR,
      payload: error
    })
  }

  const clearInvalidPasswordError = () => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_PASSWORD_ERROR,
      payload: undefined
    })
  }

  const setEmailValue = (value: string) => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_EMAIL_VALUE,
      payload: value
    })
  }

  const setPasswordValue = (value: string) => {

    distpatch({
      type: LOGIN_ACTION_TYPE.SET_PASSWORD_VALUE,
      payload: value
    })
  }

  const contextValue = useMemo(
    () => ({
      emailError: state.emailError,
      passwordError: state.passwordError,
      emailValue: state.emailValue,
      passwordValue: state.passwordValue,
      setInvalidEmailError,
      clearInvalidEmailError,
      setInvalidPasswordError,
      clearInvalidPasswordError,
      setEmailValue,
      setPasswordValue
    }), [state.emailError, state.passwordError, state.emailValue, state.passwordValue]
  )

  return (<>
    <LoginContext.Provider
      value={contextValue}
    >
      {children}
    </LoginContext.Provider>
  </>)
}