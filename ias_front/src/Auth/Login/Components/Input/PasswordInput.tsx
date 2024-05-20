import React, { useContext } from "react"
import { LoginContext } from "../../Context/LoginContext"
import { isValidPassword } from "../../Validations/UserValidations"
import { VALIDATION_STATUS } from "../../../Shared/consts"
import { Tooltip } from "react-tooltip"

export default function PasswordInput(): React.JSX.Element {

  const {
    passwordError,
    setInvalidPasswordError,
    clearInvalidPasswordError,
    setPasswordValue
  } = useContext(LoginContext)

  const handleBlur = (event: React.FocusEvent<HTMLInputElement>) => {

    const { value } = event.target

    const [status, error] = isValidPassword(value)

    if (status === VALIDATION_STATUS.ERROR && setInvalidPasswordError && error) {

      return setInvalidPasswordError(error)
    }

    if (status === VALIDATION_STATUS.SUCCESS && clearInvalidPasswordError) {

      clearInvalidPasswordError()
    }
  }

  const handleChange = ({ target }: React.ChangeEvent<HTMLInputElement>) => {

    const { value } = target

    if (setPasswordValue) {

      setPasswordValue(value)
    }
  }

  return (<>
    <div
      className="form-floating"
      data-tooltip-id="password-tooltip"
    >
      <input
        className={`form-control ${passwordError && 'is-invalid'}`}
        placeholder="Password-12345"
        id="password"
        type="password"
        onChange={handleChange}
        onBlur={handleBlur}
      />
      <label className="form-label" htmlFor="password">Password: </label>
    </div>
    <Tooltip id="password-tooltip">
      La contraseña debe tener las siguientes características:
      <ul>
        <li>8 Caracteres o más.</li>
        <li>Mayúsculas.</li>
        <li>Minúsculas.</li>
        <li>Caracteres especiales.</li>
      </ul>
    </Tooltip>
    {passwordError &&
      <div
        className="m-1 p-1 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3"
      >
        {passwordError}
      </div>}
  </>)
}