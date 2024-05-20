//import { useEmail, usePassword } from "../Hooks/LoginHooks"
import { useContext } from "react"
import EmailInput from "./Input/EmailInput"
import PasswordInput from "./Input/PasswordInput"
import { LoginContext } from "../Context/LoginContext"
import { isValidEmail, isValidPassword } from "../Validations/UserValidations"
import { VALIDATION_STATUS } from "../../Shared/consts"
//import PasswordInput from "./Input/PasswordInput"

export default function LoginForm(): React.JSX.Element {

  const {
    emailValue,
    passwordValue,
    setInvalidEmailError,
    clearInvalidEmailError,
    setInvalidPasswordError,
    clearInvalidPasswordError
  } = useContext(LoginContext)

  const handleClick = ({ preventDefault }: React.MouseEvent<HTMLButtonElement>) => {

    preventDefault()
    console.log('CLICKASO')

    const [
      emailValidationStatus,
      emailValidationError
    ] = isValidEmail(emailValue ?? '')
    const [
      passwordValidationStatus,
      passwordValidationError
    ] = isValidPassword(passwordValue ?? '')

    // EMAIL
    if (
      emailValidationStatus === VALIDATION_STATUS.ERROR
      &&
      setInvalidEmailError
      &&
      emailValidationError
    ) {
      setInvalidEmailError(emailValidationError)
    }

    if (
      emailValidationStatus === VALIDATION_STATUS.SUCCESS
      &&
      clearInvalidEmailError
    ) {

      clearInvalidEmailError()
    }

    // PASSWORD
    if (
      passwordValidationStatus === VALIDATION_STATUS.ERROR
      &&
      setInvalidPasswordError
      &&
      passwordValidationError
    ) {

      setInvalidPasswordError(passwordValidationError)
    }

    if (
      passwordValidationStatus === VALIDATION_STATUS.SUCCESS
      &&
      clearInvalidPasswordError
    ) {

      clearInvalidPasswordError()
    }

    if (
      emailValidationStatus === VALIDATION_STATUS.ERROR
      ||
      passwordValidationStatus === VALIDATION_STATUS.ERROR
    ) {
      return
    }

    if (!emailValue || !passwordValue) {
      return
    }
  }

  return (<>
    <section className="container">
      <form className="card p-3">
        <h2>Iniciar Sesión</h2>
        <div className="m-1">
          <EmailInput />
        </div>
        <div className="m-1">
          <PasswordInput />
        </div>
        <button className="btn btn-danger" onSubmit={handleClick}>Iniciar Sesión</button>
      </form>
    </section>
  </>)
}