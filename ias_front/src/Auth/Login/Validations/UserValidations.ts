import { VALIDATION_STATUS } from "../../Shared/consts";
import type { ValidationReturnType } from "../../Shared/types";


export function isValidEmail(email: string): ValidationReturnType {

  const REGEXP: RegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/

  if (!REGEXP.test(email)) {
    //throw new Error(`Este email <${email}> no es un email valido`);

    return [
      VALIDATION_STATUS.ERROR,
      `Este email <${email}> no es un email valido`
    ]
  }

  return [
    VALIDATION_STATUS.SUCCESS
  ]
}

export function isValidPassword(password: string): ValidationReturnType {

  const REGEXP: RegExp = /^(?=.*[A-Z])(?=.*[\W_])(?=.*\d).{9,}$/

  if (!REGEXP.test(password)) {
    //throw new Error(`Esta contraseña no es una contraseña valida`);
    return [
      VALIDATION_STATUS.ERROR,
      `Esta contraseña no es una contraseña valida`
    ]
  }

  return [
    VALIDATION_STATUS.SUCCESS
  ]
}