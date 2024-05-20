import { useContext } from "react"
import { LoginContext } from "../../Context/LoginContext"
import { isValidEmail } from "../../Validations/UserValidations"
import { VALIDATION_STATUS } from "../../../Shared/consts"

export default function EmailInput(): React.JSX.Element {

  const {
    emailError,
    setInvalidEmailError,
    clearInvalidEmailError,
    setEmailValue
  } = useContext(LoginContext)

  const handleBlur = (event: React.FocusEvent<HTMLInputElement>) => {

    const { value } = event.target

    const [status, error] = isValidEmail(value)

    if (status === VALIDATION_STATUS.ERROR && setInvalidEmailError && error) {

      return setInvalidEmailError(error)
    }

    if (status === VALIDATION_STATUS.SUCCESS && clearInvalidEmailError) {

      clearInvalidEmailError()
    }
  }

  const handleChange = ({ target }: React.ChangeEvent<HTMLInputElement>) => {

    const { value } = target

    if (setEmailValue) {

      setEmailValue(value)
    }
  }

  return (<>
    <div className="form-floating">
      <input
        className={`form-control ${emailError && 'is-invalid'}`}
        placeholder="email@email.com"
        id="email"
        type="email"
        onChange={handleChange}
        onBlur={handleBlur}
      />
      <label
        htmlFor="email"
        className="form-label"
      >
        Email:
      </label>
    </div>
    {emailError &&
      <div
        className="m-1 p-1 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3"
      >
        {emailError}
      </div>}
  </>)
}